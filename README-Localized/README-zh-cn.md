# 使用 Microsoft Graph 的 Office 365 PHP Connect 示例

[![Build Status](https://travis-ci.org/OfficeDev/O365-PHP-Microsoft-Graph-Connect.svg?branch=master)](https://travis-ci.org/OfficeDev/O365-PHP-Microsoft-Graph-Connect)

连接到 Office 365 是每个应用开始使用 Office 365 服务和数据必须采取的第一步。该示例演示如何通过 Microsoft Graph（旧称 Office 365 统一 API）连接并调用 API，以及如何使用 Office 结构 UI 创建 Office 365 体验。

尝试 [Office 365 API 入门](http://dev.office.com/getting-started/office365apis?platform=option-php#setup)页面，其简化了注册，使您可以更快地运行该示例。

![Office 365 PHP Connect 示例的屏幕截图](../readme-images/O365-PHP-Microsoft-Graph-Connect.png)

> 注意：要深入查看代码，请参阅 [PHP 应用中调用 Microsoft Graph] (http://graph.microsoft.io/docs/platform/php)。


## 先决条件

要使用 Office 365 PHP Connect 示例，您需要以下内容：

* [PHP](http://php.net/) 是在开发服务器上运行该示例所必需的。此示例中的说明使用 PHP 5.4 内置 Web 服务器。但还会在 Internet Information Services 和 Apache 服务器上测试该示例。
	* 客户端 URL (cURL) 模块。Web 应用程序使用 cURL 将请求发送到 REST 终结点。 
* Office 365 帐户。您可以注册 &lt;a herf="https://profile.microsoft.com/RegSysProfileCenter/wizardnp.aspx?wizid=14b845d0-938c-45af-b061-f798fbb4d170"&gt;Office 365 开发人员订阅&lt;/a&gt;，其中包含开始构建 Office 365 应用所需的资源。

     > **注意：**<br />
     如果您已经订阅，之前的链接会将您转至包含以下信息的页面：*抱歉，您无法将其添加到当前帐户*。在这种情况下，请使用当前 Office 365 订阅中的帐户。<br /><br />
     如果您已经登录了 Office 365，之前链接中的登录按钮将显示以下信息：*抱歉，我们无法处理您的请求*。在这种情况下，请注销同一页面中的 Office 365 并重新登录。
* 用于注册您的应用程序的 Microsoft Azure 租户。Azure Active Directory (AD) 为应用程序提供了用于进行身份验证和授权的标识服务。您还可在 [Microsoft Azure](https://account.windowsazure.com/SignUp) 获得试用订阅：

     > **重要信息：**<br />
     您还需要确保您的 Azure 订阅已绑定到 Office 365 租户。要执行这一操作，请参阅 Active Directory 团队的博客文章：[创建和管理多个 Microsoft Azure Active Directory](http://blogs.technet.com/b/ad/archive/2013/11/08/creating-and-managing-multiple-windows-azure-active-directories.aspx)。**添加新目录**一节将介绍如何执行此操作。您还可以参阅[设置 Office 365 开发环境](ht5ps://msdn.microsoft.com/office/office365/howto/setup-development-environment#bk_CreateAzureSubscription)和**关联您的 Office 365 帐户和 Azure AD 以创建并管理应用**一节获取详细信息。
* 在 Azure 中注册的应用程序的[```客户端 ID```](app/Constants.php#L29) 和[```密钥```](app/Constants.php#L30)值。必须向该示例应用程序授予**以用户身份发送邮件**权限以使用 **Microsoft Graph**。有关详细信息，请参阅[使用 Azure 管理门户注册 Web 应用](https://msdn.microsoft.com/office/office365/HowTo/add-common-consent-manually#bk_RegisterServerApp)和[向 Connect 应用程序授予适当的权限](https://github.com/OfficeDev/O365-PHP-Microsoft-Graph-Connect/wiki/Grant-permissions-to-the-Connect-application-in-Azure)。

     > **注意：**<br />
     在应用注册过程中，务必将 **http://localhost:8000/callback.php** 指定为**登录 URL**。

## 配置并运行应用

1. 使用最喜爱的 IDE 中，打开“应用”<b />文件夹中的 **Constants.php**。
2. 用所注册的 Azure 应用程序的客户端 ID 替换 *ENTER_YOUR_CLIENT_ID*。
3. 用所注册的 Azure 应用程序的客户端密码替换 *ENTER_YOUR_SECRET*。
4. 使用以下命令启动内置 Web 服务器：
    ```
    php -S 0.0.0.0:8000 -t app
    ```
    
5. 导航到 Web 浏览器中的 ```http://localhost:8000```。

## 疑难解答

### 错误：无法获取本地颁发者证书

在向登录页面提供您的凭据后会收到以下错误。
```
SSL certificate problem: unable to get local issuer certificate
```

当尝试发出请求调用以获取令牌时，cURL 无法验证 Microsoft 证书的有效性。在通过以下步骤发出 HTTPS 请求时，您必须将 cURL 配置为使用证书：  

1. 从 [cURL 网站](http://curl.haxx.se/docs/caextract.html)下载 cacert.pem 文件。 
2. 打开 php.ini 文件并添加下面的行

	```
	curl.cainfo = "path_to_cacert/cacert.pem"
	```

## 问题和意见

我们乐意倾听您有关 Office 365 PHP Connect 示例的反馈。您可以在该存储库中的[问题](https://github.com/OfficeDev/O365-PHP-Microsoft-Graph-Connect/issues)部分将问题和建议发送给我们。

与 Office 365 开发相关的问题一般应发布到[堆栈溢出](http://stackoverflow.com/questions/tagged/Office365+API)。确保您的问题或意见使用了 [Office365] 和 [API] 标记。
  
## 其他资源

* [Office 365 API 平台概述](https://msdn.microsoft.com/office/office365/howto/platform-development-overview)
* [Office 365 API 入门](http://dev.office.com/getting-started/office365apis)
* [Microsoft Graph 概述](http://graph.microsoft.io/)
* &lt;a herf="https://github.com/officedev?utf8=%E2%9C%93&amp;query=Microsoft-Graph-Connect"&gt;其他 Microsoft Graph Connect 示例&lt;/a&gt;
* [Office 365 API 初学者项目和代码示例](https://msdn.microsoft.com/office/office365/howto/starter-projects-and-code-samples)
* [Office UI 结构](https://github.com/OfficeDev/Office-UI-Fabric)

## 版权
版权所有 (c) 2016 Microsoft。保留所有权利。


