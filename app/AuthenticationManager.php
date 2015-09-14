<?php
/*
 *  Copyright (c) Microsoft. All rights reserved. Licensed under the MIT license. See full license at the bottom of this file.
 */
 
/*! @header Office 365 PHP Connect sample using unified API (preview)
    @abstract A PHP project that shows how to use the Office 365 unified API 
 */
 
    // We use the session to store tokens and data about the user. 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once('Constants.php');
    require_once('RequestManager.php');
    
    /*! @class AuthenticationManager
        @abstract Provides methods to authenticate to Azure AD and store tokens and user information
     */
    class AuthenticationManager{
        
        /*! @function connect
            @abstract Starts the authentication flow. At the end, the user should be redirected to callback.php 
         */
        public static function connect(){
            // Redirect the browser to the authorization endpoint. Auth endpoint is:
            // https://login.microsoftonline.com/common/oauth2/authorize
            $redirect = Constants::AUTHORITY_URL . Constants::AUTHORIZE_ENDPOINT . '?response_type=code&client_id=' . urlencode(Constants::CLIENT_ID) . '&redirect_uri=' . urlencode(Constants::REDIRECT_URI);
            header("Location: {$redirect}");
            exit();
        }
        
        /*! @function acquireToken
            @abstract Contacts the token endpoint to get OAuth tokens including an access token
            that can be used to send an authenticated request to the Office 365 unified API.
            It also stores user information, like given name, in session variables.  
         */
        public static function acquireToken(){
            $tokenEndpoint = Constants::AUTHORITY_URL . Constants::TOKEN_ENDPOINT;
            
            // Send a POST request to the token endpoint to retrieve tokens. Token endpoint is:
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
            foreach ($jsonResponse as $key=>$value) {
                $_SESSION[$key] = $value;
            }
            
            // The id token is a JWT token that contains information about the user
            // It's a base64 coded string that has a header and payload 
            $decodedAccessTokenPayload = base64_decode(explode('.', $_SESSION['id_token'])[1]);            
            $jsonAccessTokenPayload = json_decode($decodedAccessTokenPayload, true);
            
            // The id token payload has the following parameters:
            // aud - Audience of the token.
            // exp - Expiration time.
            // family_name - User’s last name or surname.
            // given_name - User’s first name.
            // iat - Issued at time.
            // iss - Identifies the token issuer.
            // nbf - Not before time. The time when the token becomes effective.
            // oid - Object identifier (ID) of the user object in Azure AD.
            // sub - Token subject identifier.
            // tid - Tenant identifier (ID) of the Azure AD tenant that issued the token.
            // unique_name - A unique identifier for that can be displayed to the user.
            // upn - User principal name of the user.
            // ver - Version.
            foreach ($jsonAccessTokenPayload as $key=>$value) {
                $_SESSION[$key] = $value;
            }
        }
        
        /*! @function disconnect
            @abstract Clear the session and redirect the browser to Azure's logout endpoint.
         */
        public static function disconnect(){
            session_destroy();
            
            $connectUrl = (@$_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
            $connectUrl .= $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
            
            // Get the full URL of the connect.php to send it to the logout endpoint
            $connectUrl = substr($connectUrl, 0, strrpos( $connectUrl, '/') ) . '/Connect.php';
 
            // Logout endpoint is in the form
            // https://login.microsoftonline.com/common/oauth2/logout?post_logout_redirect_uri=<full_url_of_your_start_page> 
            $redirect = Constants::AUTHORITY_URL . Constants::LOGOUT_ENDPOINT . '?post_logout_redirect_uri=' . urlencode($connectUrl);
            header("Location: " . $redirect);
            exit();
        }
    }
    
// *********************************************************
//
// O365-PHP-Unified-API-Connect, https://github.com/OfficeDev/O365-PHP-Unified-API-Connect
//
// Copyright (c) Microsoft Corporation
// All rights reserved.
//
// MIT License:
// Permission is hereby granted, free of charge, to any person obtaining
// a copy of this software and associated documentation files (the
// "Software"), to deal in the Software without restriction, including
// without limitation the rights to use, copy, modify, merge, publish,
// distribute, sublicense, and/or sell copies of the Software, and to
// permit persons to whom the Software is furnished to do so, subject to
// the following conditions:
//
// The above copyright notice and this permission notice shall be
// included in all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
// EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
// NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
// LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
// OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
// WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
//
// *********************************************************
?>