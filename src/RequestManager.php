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
 *  Sends POST requests to the specified endpoint.
 *  It's used by AuthenticationManager to get OAuth tokens and
 *  MailManager to contact the Office 365 unified endpoint.
 *
 *  @class    RequestManager
 *  @category Code_Sample
 *  @package  php-connect-rest-sample
 *  @author   Ricardo Loo <ricardol@microsoft.com>
 *  @license  MIT License
 *  @link     http://github.com/microsoftgraph/php-connect-rest-sample
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
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_FAILONERROR => false
            )
        );
        
        // The following curl options can be used in development to debug the code.
        // Option to disable certificate verification. Do not use on production env.
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // Option to set a proxy for curl to use.
        // Useful if you want to review traffic with a tool like Fiddler.
        // curl_setopt($curl, CURLOPT_PROXY, '127.0.0.1:8888');
        
        // Send the request & save response to a variable
        $response = curl_exec($curl);

        $info = curl_getinfo($curl);

        // Check for errors
        if (curl_errno($curl)) {
            throw new \RuntimeException(curl_error($curl));
        }

        // Check for errors
        if ($info['http_code'] >= 400) {
            $response = json_decode($response, true);

            if (!isset($response['error']['code'])) {
                throw new \RuntimeException(curl_error($curl));
            }

            $message = $response['error']['code'] . ": " . $response['error']['message'];

            throw new Exception($message);
        }
        
        // Close request and clear some resources
        curl_close($curl);
        
        return $response;
    }
}
