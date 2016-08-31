# PHP Connect sample using Microsoft Graph

[![Build Status](https://travis-ci.org/microsoftgraph/php-connect-rest-sample.svg?branch=master)](https://travis-ci.org/microsoftgraph/php-connect-rest-sample)

Connecting to Microsoft Graph is the first step every app must take to start working with Office 365 services and data. This sample shows how to connect and then call one API through Microsoft Graph (previously called Office 365 unified API), and uses the Office Fabric UI to create an Office 365 experience.

Try out the [Get started with Office 365 APIs](http://dev.office.com/getting-started/office365apis?platform=option-php#setup) page which simplifies registration so you can get this sample running faster.

![PHP Connect sample screenshot](/readme-images/php-connect-rest-sample.png)

> Note: For an in-depth look at the code, see [Call Microsoft Graph in a PHP app] (http://graph.microsoft.io/docs/platform/php).


## Prerequisites

To use the PHP Connect sample, you need the following:

* [PHP](http://php.net/) is required to run the sample on a development server. The instructions in this sample use the PHP 5.4 built-in web server. However, the sample has also been tested on Internet Information Services and Apache Server.
	* Client URL (cURL) module. The web application uses cURL to issue requests to REST endpoints.
    * [Composer](https://getcomposer.org/), dependency manager for PHP

<a name="register"></a>
##Register and configure the app

1. Sign into the [App Registration Portal](https://apps.dev.microsoft.com/) using either your personal or work or school account.
2. Select **Add an app**.
3. Enter a name for the app, and select **Create application**.
	
	The registration page displays, listing the properties of your app.
 
4. Under **Platforms**, select **Add platform**.
5. Select **Web**.
6. Add the following to the list of **Redirect URIs**:

    ```
    http://localhost:8000/oauth.php
    ```    
    
7. Under **Application Secrets** click **Generate New Password**.
8. Copy the **New password generated** and **Application Id**, you'll need them in the next section.
9. Click **Save**.

## Configure and run the app

1. Using your favorite IDE, open **Constants.php** in the *app* folder.
2. Replace *ENTER_YOUR_CLIENT_ID* with the client ID of your application id.
3. Replace *ENTER_YOUR_SECRET* with the client secret of your password.
4. Install the dependencies with the following command:
    ```
    composer install
    ```
    
5. Start the built-in web server with the following command:
    ```
    php -S 0.0.0.0:8000 -t app
    ```
    
6. Navigate to ```http://localhost:8000``` in your web browser.

## Troubleshooting

### Error: Unable to get local issuer certificate

You receive the following error after providing your credentials to the sign in page.
```
SSL certificate problem: unable to get local issuer certificate
```

cURL can't verify the validity of the Microsoft certificate when trying to issue a request call to get tokens. You must configure cURL to use a certificate when issuing https requests by following these steps:  

1. Download the cacert.pem file from [cURL website](http://curl.haxx.se/docs/caextract.html). 
2. Open your php.ini file and add the following line

	```
	curl.cainfo = "path_to_cacert/cacert.pem"
	```

<a name="contributing"></a>
## Contributing ##

If you'd like to contribute to this sample, see [CONTRIBUTING.MD](/CONTRIBUTING.md).

This project has adopted the [Microsoft Open Source Code of Conduct](https://opensource.microsoft.com/codeofconduct/). For more information see the [Code of Conduct FAQ](https://opensource.microsoft.com/codeofconduct/faq/) or contact [opencode@microsoft.com](mailto:opencode@microsoft.com) with any additional questions or comments.

## Questions and comments

We'd love to get your feedback about the PHP Connect sample. You can send your questions and suggestions to us in the [Issues](https://github.com/microsoftgraph/php-connect-rest-sample/issues) section of this repository.

Questions about Microsoft Graph development in general should be posted to [Stack Overflow](http://stackoverflow.com/questions/tagged/Office365+API). Make sure that your questions or comments are tagged with [MicrosoftGraph] and [API].
  
## Additional resources

* [Microsoft Graph](http://graph.microsoft.io/)
* [Office 365 APIs platform overview](https://msdn.microsoft.com/office/office365/howto/platform-development-overview)
* [Getting started with Office 365 APIs](http://dev.office.com/getting-started/office365apis)
* [Office UI Fabric](https://github.com/OfficeDev/Office-UI-Fabric)

## Copyright
Copyright (c) 2016 Microsoft. All rights reserved.
