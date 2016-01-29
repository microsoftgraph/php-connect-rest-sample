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
    @abstract Users are redirected to this page to initiate the disconnect flow
 */

namespace Microsoft\Office365\UnifiedAPI\Connect;

require_once 'AuthenticationManager.php';

AuthenticationManager::disconnect();
?>
