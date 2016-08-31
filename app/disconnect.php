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
    @abstract Users are redirected to this page to destroy session and redirect
    to start page
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Microsoft\Graph\Connect\Constants;

// Destroy the session. Alternatively, we can remove the individual variables.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_destroy();
        
$connectUrl = 'http://localhost:8000/index.php';

header('Location: ' . $connectUrl);
exit();
