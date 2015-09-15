<?php
/**
 *  Copyright (c) Microsoft. All rights reserved. Licensed under the MIT license.
 *  See full license at the bottom of this file.
 * 
 *  PHP version 5
 *
 *  @category Code_Sample
 *  @package  O365-PHP-Unified-API-Connect
 *  @author   Ricardo Loo <ricardol@microsoft.com>
 *  @license  MIT License
 *  @link     http://GitHub.com/OfficeDev/O365-PHP-Unified-API-Connect
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Constants.php';
require_once 'RequestManager.php';

/** 
 *  Handles the creation of the email and sends the request 
 *  to the Office 365 unified endpoint
 *
 *  @class    MailManager
 *  @category Code_Sample
 *  @package  O365-PHP-Unified-API-Connect
 *  @author   Ricardo Loo <ricardol@microsoft.com>
 *  @license  MIT License
 *  @link     http://GitHub.com/OfficeDev/O365-PHP-Unified-API-Connect
 */
class MailManager
{
    
    /**
     *  Builds the email message and uses RequestManager to send a POST request 
     *  to the sendmail endpoint in the unified API.
     *
     *  @param string $recipient - The recipient of the email.
     *
     *  @function sendWelcomeMail
     *  @return   1 - success
     */
    public static function sendWelcomeMail($recipient)
    {
        $emailBody = file_get_contents('MailTemplate.html');
        $emailBody = str_replace(
            $emailBody,
            $_SESSION['given_name'],
            '{given_name}'
        );
        
        // Build the HTTP request payload (the Message object).
        $email = "{
            Message: {
            Subject: 'Welcome to Office 365 development with PHP',
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
        // https://graph.microsoft.com/beta/me/sendMail
        // Note that the access token is attached in the Authorization header
        RequestManager::sendPostRequest(
            Constants::RESOURCE_ID . Constants::SENDMAIL_ENDPOINT,
            array(
                'Authorization: Bearer ' . $_SESSION['access_token'],
                'Content-Type: application/json;' . 
                              'odata.metadata=minimal;' .
                              'odata.streaming=true'
            ),
            $email
        );
        
        return 1;
    }
}
    
// *********************************************************
//
// O365-PHP-Unified-API-Connect
// https://github.com/OfficeDev/O365-PHP-Unified-API-Connect
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