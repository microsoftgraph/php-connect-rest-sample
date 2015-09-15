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
 
/*! 
    @abstract The page that the user will be redirected to after Azure AD finishes the authentication flow.
 */
 
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
require_once 'AuthenticationManager.php';

// Get the authorization code and other parameters from the query string
// and store them in the session.
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['code'])) 
{
    if(isset($_GET['admin_consent']))
    {
        $_SESSION['admin_consent'] = $_GET['admin_consent'];
    }
    if(isset($_GET['code']))
    {
        $_SESSION['code'] =  $_GET['code'];
    }
    if(isset($_GET['session_state']))
    {
        $_SESSION['session_state'] =  $_GET['session_state'];
    }
    if(isset($_GET['state']))
    {
        $_SESSION['state'] =  $_GET['state'];
    }
    
    // With the authorization code, we can retrieve access tokens and other data.
    try 
    {
        AuthenticationManager::acquireToken();
        header('Location: SendMail.php');
        exit();
    } 
    catch (RuntimeException $e)
    {
        echo 'Something went wrong, couldn\'t get tokens: ' . $e->getMessage();
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