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
 
/*! 
    @abstract The page that the user will be redirected to after 
              Azure Active Directory (AD) finishes the authentication flow.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Microsoft\Graph\Connect\Constants;

//We store user name, id, and tokens in session variables
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => Constants::CLIENT_ID,
    'clientSecret'            => Constants::CLIENT_SECRET,
    'redirectUri'             => Constants::REDIRECT_URI,
    'urlAuthorize'            => Constants::AUTHORITY_URL . Constants::AUTHORIZE_ENDPOINT,
    'urlAccessToken'          => Constants::AUTHORITY_URL . Constants::TOKEN_ENDPOINT,
    'urlResourceOwnerDetails' => '',
    'scopes'                  => Constants::SCOPES
]);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['code']) && !isset($_GET['error'])) {
    $authorizationUrl = $provider->getAuthorizationUrl();

    // The OAuth library automaticaly generates a state value that we can
    // validate later. We just save it for now.
    $_SESSION['state'] = $provider->getState();

    header('Location: ' . $authorizationUrl);
    exit();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['error'])) {
    // Answer from the authentication service contains an error.
    printf('Something went wrong while authenticating: [%s] %s', $_GET['error'], $_GET['error_description']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['code'])) {
    // Validate the OAuth state parameter
    if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['state'])) {
        unset($_SESSION['state']);
        exit('State value does not match the one initially sent');
    }

    // With the authorization code, we can retrieve access tokens and other data.
    try {
        // Get an access token using the authorization code grant
        $accessToken = $provider->getAccessToken('authorization_code', [
            code     => $_GET['code']
        ]);
        $_SESSION['access_token'] = $accessToken->getToken();
        
        // The id token is a JWT token that contains information about the user
        // It's a base64 coded string that has a header, payload and signature
        $idToken = $accessToken->getValues()['id_token'];
        $decodedAccessTokenPayload = base64_decode(
            explode('.', $idToken)[1]
        );
        $jsonAccessTokenPayload = json_decode($decodedAccessTokenPayload, true);

        // The following user properties are needed in the next page
        $_SESSION['preferred_username'] = $jsonAccessTokenPayload['preferred_username'];
        $_SESSION['given_name'] = $jsonAccessTokenPayload['name'];

        header('Location: sendmail.php');
        exit();
    } catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        printf('Something went wrong, couldn\'t get tokens: %s', $e->getMessage());
    }
}
