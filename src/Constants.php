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
 *  Stores constant and configuration values used through the app
 *
 *  @class    Constants
 *  @category Code_Sample
 *  @package  php-connect-rest-sample
 *  @author   Ricardo Loo <ricardol@microsoft.com>
 *  @license  MIT License
 *  @link     http://github.com/microsoftgraph/php-connect-rest-sample
 */
class Constants
{
    const CLIENT_ID = 'ENTER_YOUR_CLIENT_ID';
    const CLIENT_SECRET = 'ENTER_YOUR_SECRET';
    const REDIRECT_URI = 'http://localhost:8000/oauth.php';
    const AUTHORITY_URL = 'https://login.microsoftonline.com/common';
    const AUTHORIZE_ENDPOINT = '/oauth2/v2.0/authorize';
    const TOKEN_ENDPOINT = '/oauth2/v2.0/token';
    const LOGOUT_ENDPOINT = '/oauth2/logout';
    const RESOURCE_ID = 'https://graph.microsoft.com';
    const SENDMAIL_ENDPOINT = '/v1.0/me/sendmail';
    const RESOURCE_OWNER_DETAILS_ENDPOINT = '/v1.0/me';
    const SCOPES='openid offline_access user.read mail.send';
}
