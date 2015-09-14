<?php
/*
 *  Copyright (c) Microsoft. All rights reserved. Licensed under the MIT license. See full license at the bottom of this file.
 */
    //We store user name, id, and tokens in session variables
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once('MailManager.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>O365 Connect sample</title>

  <!-- Third party dependencies. -->
  <link rel="stylesheet" href="https://appsforoffice.microsoft.com/fabric/1.0/fabric.css">
  <link rel="stylesheet" href="https://appsforoffice.microsoft.com/fabric/1.0/fabric.components.css">
  
  <!-- App code. -->
  <link rel="stylesheet" href="styles.css">
  
</head>

<body class="ms-Grid">
    <div class="ms-Grid-row">
    <!-- App navigation bar markup. -->
    <div class="ms-NavBar">
    <ul class="ms-NavBar-items">
        <li class="navbar-header">Office 365 Connect sample</li>
        <li class="ms-NavBar-item ms-NavBar-item--right" onclick="window.location.href='disconnect.php'"><i class="ms-Icon ms-Icon--x"></i> Disconnect</li>
    </ul>
    </div>

    <!-- App main content markup. -->
    <form action="" method="post">
    <div class="ms-Grid-col ms-u-mdPush1 ms-u-md9 ms-u-lgPush1 ms-u-lg6">
    <div>
        <h2 class="ms-font-xxl ms-fontWeight-semibold">Hi, <?=$_SESSION['given_name']?>!</h2>
        <p class="ms-font-xl">You're now connected to Office 365. Click the mail icon below to send a message from your account using the Office 365 unified API. </p>
        <div class="ms-TextField">
        <input class="ms-TextField-field" name="recipient" value="<?=$_SESSION['unique_name']?>">
        </div>
        <button class="ms-Button">
                <span class="ms-Button-label">Send mail</span>
        </button>
        <div>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recipient'])) {
                    MailManager::sendWelcomeMail($_POST['recipient']);
            ?>
                        <p class="ms-font-m ms-fontColor-green">Successfully sent an email to <?=$_POST['recipient']?>!</p>
            <?php
                }
            ?>
        
        </div>
        <div>
        <!--<p class="ms-font-m ms-fontColor-redDark">Something went wrong, couldn't send an email.</p>-->        
        </div>
    </div>
    </div>
    </form>
</div>
</body>

</html>
<?php
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