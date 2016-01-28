<?php
/**
 *  Copyright (c) Microsoft. All rights reserved. Licensed under the MIT license.
 *  See LICENSE in the project root for license information.
 * 
 *  PHP version 5
 *
 *  @category Code_Sample
 *  @package  O365-PHP-Microsoft-Graph-Connect
 *  @author   Ricardo Loo <ricardol@microsoft.com>
 *  @license  MIT License
 *  @link     http://GitHub.com/OfficeDev/O365-PHP-Microsoft-Graph-Connect
 */
 
/*! 
    @abstract The page that the user will be redirected to after 
              Azure Active Directory (AD) finishes the authentication flow.
 */

namespace Microsoft\Office365\UnifiedAPI\Connect;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'AuthenticationManager.php';

// Get the authorization code and other parameters from the query string
// and store them in the session.
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['code'])) {
    if (isset($_GET['admin_consent'])) {
        $_SESSION['admin_consent'] = $_GET['admin_consent'];
    }
    if (isset($_GET['code'])) {
        $_SESSION['code'] =  $_GET['code'];
    }
    if (isset($_GET['session_state'])) {
        $_SESSION['session_state'] =  $_GET['session_state'];
    }
    if (isset($_GET['state'])) {
        $_SESSION['state'] =  $_GET['state'];
    }
    
    // With the authorization code, we can retrieve access tokens and other data.
    try 
    {
        AuthenticationManager::acquireToken();
        header('Location: sendmail.php');
        exit();
    } 
    catch (\RuntimeException $e)
    {
        echo 'Something went wrong, couldn\'t get tokens: ' . $e->getMessage();
    }
}
?>
