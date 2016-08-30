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
    @abstract Users are redirected to this page to initiate the disconnect flow
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Microsoft\Graph\Connect\Constants;

// Destroy the session. Alternatively, we can remove the individual variables.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_destroy();
        
$connectUrl = 'http://localhost:8000/index.php';

// Logout endpoint is in the form
// https://login.microsoftonline.com/common/oauth2/logout
// ?post_logout_redirect_uri=<full_url_of_your_start_page>
$redirect = Constants::AUTHORITY_URL . Constants::LOGOUT_ENDPOINT .
            '?post_logout_redirect_uri=' . urlencode($connectUrl);
header('Location: ' . $redirect);
exit();
