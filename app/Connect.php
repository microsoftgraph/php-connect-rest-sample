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
    @abstract This is the start page. It should display minimal UI emphasizing 
              the "connect" button.
 */
 
require_once'AuthenticationManager.php';

// User has clicked the "connect" button. Start the authentication flow.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    AuthenticationManager::connect();
}

?>
      
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>O365 Connect sample</title>

  <!-- Third party dependencies. -->
  <link 
      rel="stylesheet" 
      href="https://appsforoffice.microsoft.com/fabric/1.0/fabric.css">
  <link 
      rel="stylesheet" 
      href="https://appsforoffice.microsoft.com/fabric/1.0/fabric.components.css">
  
  <!-- App code. -->
  <link rel="stylesheet" href="styles.css">
  
</head>

<body class="ms-Grid">
    <form action="" method="post">
    <div class="ms-Grid-row">
    <!-- App navigation bar markup. -->
        <div class="ms-NavBar">
            <ul class="ms-NavBar-items">
                <li class="navbar-header">Office 365 Connect sample</li>
            </ul>
        </div>

    <!-- App main content markup. -->
    <div class="ms-Grid-col ms-u-mdPush1 ms-u-md9 ms-u-lgPush1 ms-u-lg6">
        <div>
            <p class="ms-font-xl">Use the button below to connect to Office 365.</p>
            <button class="ms-Button">
                <span class="ms-Button-label">Connect to Office 365</span>
            </button>
        </div>
    </div>
    </div>
    </form>
</body>

</html>
<?php
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