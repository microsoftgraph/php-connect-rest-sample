<!-- Copyright (c) Microsoft. All rights reserved. Licensed under the MIT license. See full license at the bottom of this file. -->

<?php
    //We store user name, id, and tokens in session variables
    session_start();
    require_once('RequestManager.php');
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
                    $emailContent = "<html><head> <meta http-equiv=\'Content-Type\' content=\'text/html; charset=us-ascii\'> <title></title> </head><body style=\'font-family:calibri\'> <p>Congratulations {$_SESSION['given_name']},</p> <p>This is a message from the Office 365 Connect sample. You are well on your way to incorporating Office 365 services in your apps. </p> <h3>What&#8217;s next?</h3> <ul><li>Check out <a href=\'http://dev.office.com\' target=\'_blank\'>dev.office.com</a> to start building Office 365 apps today with all the latest tools, templates, and guidance to get started quickly.</li><li>Head over to the <a href=\'https://msdn.microsoft.com/office/office365/howto/office-365-unified-api-reference\' target=\'blank\'>unified API reference on MSDN</a> to explore the rest of the APIs.</li><li>Browse other <a href=\'https://github.com/OfficeDev/\' target=\'_blank\'>samples on GitHub</a> to see more of the APIs in action.</li></ul> <h3>Give us feedback</h3> <ul><li>If you have any trouble running this sample, please <a href=\'\' target=\'_blank\'>log an issue</a>.</li><li>For general questions about the Office 365 APIs, post to <a href=\'http://stackoverflow.com/\' target=\'blank\'>Stack Overflow</a>. Make sure that your questions or comments are tagged with [office365].</li></ul><p>Thanks and happy coding!<br>Your Office 365 Development team </p> <div style=\'text-align:center; font-family:calibri\'> <table style=\'width:100%; font-family:calibri\'> <tbody> <tr> <td><a href=\'https://github.com/OfficeDev/O365-PHP-Unified-API-Connect\'>See on GitHub</a> </td> <td><a href=\'https://officespdev.uservoice.com/forums/224641-general/category/72301-documentation-guidance\'>Suggest on UserVoice</a> </td> <td><a href=\'http://twitter.com/share?text=I%20just%20started%20developing%20apps%20for%20%23PHP%20using%20the%20%23Office365%20Connect%20app%20%40OfficeDev&amp;url=https://github.com/OfficeDev/O365-PHP-Unified-API-Connect\'>Share on Twitter</a> </td> </tr> </tbody> </table> </div>  </body> </html>";
            
                    // Build the HTTP request payload (the Message object).
                    $email = "{
                        Message: {
                        Subject: 'Welcome to Office 365 development with PHP and the Office 365 Connect sample',
                        Body: {
                            ContentType: 'HTML',
                            Content: '{$emailContent}'
                        },
                        ToRecipients: [
                            {
                                EmailAddress: {
                                Address: '{$_POST['recipient']}'
                                }
                            }
                        ]
                        },
                        SaveToSentItems: true
                        }";
                        RequestManager::sendRequest(
                            Constants::SENDMAIL_ENDPOINT,
                            null,
                            true,
                            $email
                        );
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

<!--
O365-PHP-Unified-API-Connect, https://github.com/OfficeDev/O365-PHP-Unified-API-Connect
 
Copyright (c) Microsoft Corporation
All rights reserved. 
 
MIT License:
Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:
 
The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.
 
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.    
  
-->