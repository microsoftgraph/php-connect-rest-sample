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

namespace Microsoft\Graph\Connect;

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Microsoft\Graph\Connect\Constants;
use Microsoft\Graph\Connect\MailManager;

/**
 *  Tests the app integration with Azure AD
 *
 *  @class    IntegrationTest
 *  @category Unit_Test
 *  @package  php-connect-rest-sample
 *  @author   Ricardo Loo <ricardol@microsoft.com>
 *  @license  MIT License
 *  @link     http://github.com/microsoftgraph/php-connect-rest-sample
 */
class IntegrationTest extends TestCase
{
    private $accessToken;
    private $clientId;
    private $clientSecret;
    private $username;
    private $password;

    function setUp ()
    {
        $this->getTestParameters();
        $this->getAccessToken();
    }

    function getTestParameters ()
    {
        $testConfigFile = file_get_contents(__DIR__ . '/testConfig.json');
        $testConfig = json_decode($testConfigFile, true);

        $this->clientId     = $testConfig['test_client_id_v1'];
        $this->clientSecret = $testConfig['test_client_secret_v1'];
        $this->username     = $testConfig['test_username'];
        $this->password     = $testConfig['test_password'];
    }

    function getAccessToken ()
    {
        $tokenEndpoint = Constants::AUTHORITY_URL . '/oauth2/token';
        $body = http_build_query(
            array(
                'grant_type'    => 'password',
                'resource'      => 'https://graph.microsoft.com',
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'username'      => $this->username,
                'password'      => $this->password
            ));
        $headers = array(
            'content-type' => 'application/x-www-form-urlencoded',
            'content-length' => strlen($body)
            );
        
        // Send a POST request to the token endpoint to retrieve tokens.
        // Token endpoint is:
        // https://login.microsoftonline.com/common/oauth2/token
        $response = RequestManager::sendPostRequest(
            $tokenEndpoint,
            $headers,
            $body
        );

        // Store the raw response in JSON format.
        $jsonResponse = json_decode($response, true);
        
        $this->accessToken = $jsonResponse['access_token'];
    }

    function testSendWelcomeMail() 
    {
        MailManager::sendWelcomeMailWithToken($this->username, $this->accessToken, $this->username, $this->username);
    }
}
