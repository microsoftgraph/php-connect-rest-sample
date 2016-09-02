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

/**
 *  Handles the creation of the email and sends the request
 *  to Microsoft Graph
 *
 *  @class    MailManager
 *  @category Code_Sample
 *  @package  php-connect-rest-sample
 *  @author   Ricardo Loo <ricardol@microsoft.com>
 *  @license  MIT License
 *  @link     http://github.com/microsoftgraph/php-connect-rest-sample
 */
class MailManager
{
    
    /**
     *  Builds the email message and uses RequestManager to send a POST request
     *  to the sendmail endpoint in the Microsoft Graph.
     *
     *  @param string $recipient The recipient of the email.
     *
     *  @function sendWelcomeMail
     *  @return   Nothing, passes RuntimeException from RequestManager on error
     */
    public static function sendWelcomeMail($recipient)
    {
        MailManager::sendWelcomeMailWithToken(
            $recipient,
            $_SESSION['access_token'],
            $_SESSION['given_name'],
            $_SESSION['preferred_username']
        );
    }

    public static function sendWelcomeMailWithToken($recipient, $accessToken, $givenName, $preferredUsername)
    {
        $emailBody = file_get_contents(__DIR__ . '/../app/MailTemplate.html');
        
        // Use the given name if it exists, otherwise, use the alias
        $greetingName = isset($givenName)
                        ? $givenName
                        : explode('@', $preferredUsername)[0];

        $emailBody = str_replace(
            '{given_name}',
            $greetingName,
            $emailBody
        );
        
        // Build the HTTP request payload (the Message object).
        $email = "{
            Message: {
            Subject: 'Welcome to Microsoft Graph development with PHP',
            Body: {
                ContentType: 'HTML',
                Content: '{$emailBody}'
            },
            ToRecipients: [
                {
                    EmailAddress: {
                    Address: '{$recipient}'
                    }
                }
            ]
            },
            SaveToSentItems: true
            }";
            
        // Send the email request to the sendmail endpoint,
        // which is in the following URI:
        // https://graph.microsoft.com/v1.0/me/sendmail
        // Note that the access token is attached in the Authorization header
        RequestManager::sendPostRequest(
            Constants::RESOURCE_ID . Constants::SENDMAIL_ENDPOINT,
            array(
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json;' .
                              'odata.metadata=minimal;' .
                              'odata.streaming=true'
            ),
            $email
        );
    }
}
