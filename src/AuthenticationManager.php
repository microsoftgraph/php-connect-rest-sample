<?php
/**
 *  Copyright (c) Microsoft. All rights reserved. Licensed under the MIT license.
 *  See LICENSE in the project root for license information.
 *
 *  PHP version 5
 *
 *  @category Code_Sample
 *  @package  php-connect-rest-sample
 *  @author   Ricardo Loo <ricardol@microsoft.com>
 *  @license  MIT License
 *  @link     http://github.com/microsoftgraph/php-connect-rest-sample
 */
 
/*! @header PHP Connect sample using the Microsoft Graph
    @abstract A PHP project that shows how to use the Microsoft Graph 
 */
 
namespace Microsoft\Graph\Connect;

/**
 *  Provides methods to authenticate to Azure AD and
 *  store tokens and user information
 *
 *  @class    AuthenticationManager
 *  @category Code_Sample
 *  @package  php-connect-rest-sample
 *  @author   Ricardo Loo <ricardol@microsoft.com>
 *  @license  MIT License
 *  @link     http://github.com/microsoftgraph/php-connect-rest-sample
 */
class AuthenticationManager
{
    /**
     *  Starts the authentication flow. At the end,
     *  the user should be redirected to callback.php
     *
     *  @function connect
     *  @return   Nothing, redirects browser to authorize endpoint
     */
    public static function connect()
    {
        // Redirect the browser to the authorization endpoint. Auth endpoint is
        // https://login.microsoftonline.com/common/oauth2/authorize
        $redirect = Constants::AUTHORITY_URL . Constants::AUTHORIZE_ENDPOINT .
                    '?response_type=code' .
                    '&client_id=' . urlencode(Constants::CLIENT_ID) .
                    '&redirect_uri=' . urlencode(Constants::REDIRECT_URI);
        header("Location: {$redirect}");
        exit();
    }
    
    /**
     *  Contacts the token endpoint to get OAuth tokens including an access token
     *  that can be used to send an authenticated request to the
     *  Microsoft Graph.
     *  It also stores user information, like given name, in session variables.
     *
     *  @function acquireToken
     *  @return   Nothing, stores tokens in session variables.
     */
    public static function acquireToken()
    {
        $tokenEndpoint = Constants::AUTHORITY_URL . Constants::TOKEN_ENDPOINT;
        
        // Send a POST request to the token endpoint to retrieve tokens.
        // Token endpoint is:
        // https://login.microsoftonline.com/common/oauth2/token
        $response = RequestManager::sendPostRequest(
            $tokenEndpoint,
            array(),
            array(
                'client_id' => Constants::CLIENT_ID,
                'client_secret' => Constants::CLIENT_SECRET,
                'code' => $_SESSION['code'],
                'grant_type' => 'authorization_code',
                'redirect_uri' => Constants::REDIRECT_URI,
                'resource' => Constants::RESOURCE_ID
            )
        );

        // Store the raw response in JSON format.
        $jsonResponse = json_decode($response, true);
        
        // The access token response has the following parameters:
        // access_token - The requested access token.
        // expires_in - How long the access token is valid.
        // expires_on - The time when the access token expires.
        // id_token - An unsigned JSON Web Token (JWT).
        // refresh_token - An OAuth 2.0 refresh token.
        // resource - The App ID URI of the web API (secured resource).
        // scope - Impersonation permissions granted to the client application.
        // token_type - Indicates the token type value.
        foreach ($jsonResponse as $key => $value) {
            $_SESSION[$key] = $value;
        }
        
        // The id token is a JWT token that contains information about the user
        // It's a base64 coded string that has a header and payload
        $decodedAccessTokenPayload = base64_decode(
            explode('.', $_SESSION['id_token'])[1]
        );
        $jsonAccessTokenPayload = json_decode($decodedAccessTokenPayload, true);
        
        // The id token payload has the following parameters:
        // aud - Audience of the token.
        // exp - Expiration time.
        // family_name - User’s last name or surname.
        // given_name - User’s first name.
        // iat - Issued at time.
        // iss - Identifies the token issuer.
        // nbf - Not before time. The time when the token becomes effective.
        // oid - Object identifier (ID) of the user object
        //       in Azure Active Directory (AD).
        // sub - Token subject identifier.
        // tid - Tenant identifier of the Azure AD tenant that issued the token.
        // unique_name - A unique identifier that can be displayed to the user.
        // upn - User principal name.
        // ver - Version.
        foreach ($jsonAccessTokenPayload as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }
    
    /**
     *  Clear the session and redirect the browser to Azure logout endpoint.
     *
     *  @function disconnect
     *  @return   Nothing, redirects browser to Connect.php page.
     */
    public static function disconnect()
    {
        session_destroy();
        
        $connectUrl = (@$_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
        $connectUrl .= $_SERVER['SERVER_NAME'] . ':' .
            $_SERVER['SERVER_PORT'] .
            $_SERVER['REQUEST_URI'];
        
        // Get the full URL of the index.php page to send it to the logout endpoint
        $connectUrl = substr(
            $connectUrl,
            0,
            strrpos($connectUrl, '/')
        ) . '/index.php';

        // Logout endpoint is in the form
        // https://login.microsoftonline.com/common/oauth2/logout
        // ?post_logout_redirect_uri=<full_url_of_your_start_page>
        $redirect = Constants::AUTHORITY_URL . Constants::LOGOUT_ENDPOINT .
                    '?post_logout_redirect_uri=' . urlencode($connectUrl);
        header("Location: " . $redirect);
        exit();
    }
}
