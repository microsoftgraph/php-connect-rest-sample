<!-- Copyright (c) Microsoft. All rights reserved. Licensed under the MIT license. See full license at the bottom of this file. -->

<?php
    require_once('Constants.php');

    class RequestManager{
        public static function sendMail($recipient){
            // This is the content of the email that's about to be sent.
      $emailContent = "<html><head> <meta http-equiv=\'Content-Type\' content=\'text/html; charset=us-ascii\'> <title></title> </head><body style=\'font-family:calibri\'> <p>Congratulations " . $_SESSION['given_name'] . ",</p> <p>This is a message from the Office 365 Connect sample. You are well on your way to incorporating Office 365 services in your apps. </p> <h3>What&#8217;s next?</h3> <ul><li>Check out <a href=\'http://dev.office.com\' target=\'_blank\'>dev.office.com</a> to start building Office 365 apps today with all the latest tools, templates, and guidance to get started quickly.</li><li>Head over to the <a href=\'https://msdn.microsoft.com/office/office365/howto/office-365-unified-api-reference\' target=\'blank\'>unified API reference on MSDN</a> to explore the rest of the APIs.</li><li>Browse other <a href=\'https://github.com/OfficeDev/\' target=\'_blank\'>samples on GitHub</a> to see more of the APIs in action.</li></ul> <h3>Give us feedback</h3> <ul><li>If you have any trouble running this sample, please <a href=\'\' target=\'_blank\'>log an issue</a>.</li><li>For general questions about the Office 365 APIs, post to <a href=\'http://stackoverflow.com/\' target=\'blank\'>Stack Overflow</a>. Make sure that your questions or comments are tagged with [office365].</li></ul><p>Thanks and happy coding!<br>Your Office 365 Development team </p> <div style=\'text-align:center; font-family:calibri\'> <table style=\'width:100%; font-family:calibri\'> <tbody> <tr> <td><a href=\'https://github.com/OfficeDev/O365-PHP-Unified-API-Connect\'>See on GitHub</a> </td> <td><a href=\'https://officespdev.uservoice.com/forums/224641-general/category/72301-documentation-guidance\'>Suggest on UserVoice</a> </td> <td><a href=\'http://twitter.com/share?text=I%20just%20started%20developing%20apps%20for%20%23PHP%20using%20the%20%23Office365%20Connect%20app%20%40OfficeDev&amp;url=https://github.com/OfficeDev/O365-PHP-Unified-API-Connect\'>Share on Twitter</a> </td> </tr> </tbody> </table> </div>  </body> </html>";
      
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
                Address: '{$recipient}'
              }
            }
          ]
        },
        SaveToSentItems: true
      }";
            
            $curl = curl_init();
            json_encode($email);
            
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://graph.microsoft.com/beta/me/sendMail',
                CURLOPT_POST => 1,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $_SESSION['access_token'],
                    'Content-Type: application/json;odata.metadata=minimal;odata.streaming=true'
                ),
                CURLOPT_POSTFIELDS => $email
            ));
            
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            
            var_dump($resp);
            
            if(!curl_exec($curl)){
                print('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
            }
            // Close request to clear up some resources
            curl_close($curl);
        }
    }
?>

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