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

namespace Microsoft\Office365\UnifiedAPI\Connect;
 
/** 
 *  Stores constant and configuration values used through the app 
 *
 *  @class    Constants
 *  @category Code_Sample
 *  @package  O365-PHP-Microsoft-Graph-Connect
 *  @author   Ricardo Loo <ricardol@microsoft.com>
 *  @license  MIT License
 *  @link     http://GitHub.com/OfficeDev/O365-PHP-Microsoft-Graph-Connect
 */
class Constants
{
    const CLIENT_ID = 'ENTER_YOUR_CLIENT_ID';
    const CLIENT_SECRET = 'ENTER_YOUR_SECRET';
    const REDIRECT_URI = 'http://localhost:8000/callback.php';
    const AUTHORITY_URL = 'https://login.microsoftonline.com/common';
    const AUTHORIZE_ENDPOINT = '/oauth2/authorize';
    const TOKEN_ENDPOINT = '/oauth2/token';
    const LOGOUT_ENDPOINT = '/oauth2/logout';
    const RESOURCE_ID = 'https://graph.microsoft.com';
    const SENDMAIL_ENDPOINT = '/v1.0/me/microsoft.graph.sendmail';
}
?>