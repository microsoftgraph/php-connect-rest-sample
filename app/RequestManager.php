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

namespace Microsoft\Office365\UnifiedAPI\Connect;

require_once 'Constants.php';

/** 
 *  Sends POST requests to the specified endpoint. 
 *  It's used by AuthenticationManager to get OAuth tokens and 
 *  MailManager to contact the Office 365 unified endpoint.
 *
 *  @class    RequestManager
 *  @category Code_Sample
 *  @package  O365-PHP-Unified-API-Connect
 *  @author   Ricardo Loo <ricardol@microsoft.com>
 *  @license  MIT License
 *  @link     http://GitHub.com/OfficeDev/O365-PHP-Unified-API-Connect
 */
class RequestManager
{
    
    /**
     *  Helper method to send a POST request.
     *
     *  @param string $endpoint The endpoint to send the request to.
     *  @param array  $headers  Array of key-value pairs that form the header.
     *  @param array  $body     Array of key-value pairs that form the body.
     *
     *  @function sendPostRequest
     *  @return   string The raw response returned by the endpoint.
     */
    public static function sendPostRequest($endpoint, $headers, $body) 
    {
        $curl = curl_init();
        json_encode($body);
        
        curl_setopt_array(
            $curl, 
            array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $endpoint,
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_POSTFIELDS => $body
            )
        );
        
        // Option to disable certificate verification. Do not use on production env
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // Option to set a proxy for curl to use. 
        // Useful if you want to review traffic with a tool like Fiddler. 
        // curl_setopt($curl, CURLOPT_PROXY, '127.0.0.1:8888');
        
        // Enable error reporting on curl
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        
        // Send the request & save response to a variable
        $response = curl_exec($curl);
        // Check for errors
        if (curl_errno($curl)) {
            throw new \RuntimeException(curl_error($curl));
        }
        
        // Close request and clear some resources
        curl_close($curl);
        
        return $response;
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