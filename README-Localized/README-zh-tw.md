# 使用 Microsoft Graph 的 Office 365 PHP Connect 範例

[![Build Status](https://travis-ci.org/OfficeDev/O365-PHP-Microsoft-Graph-Connect.svg?branch=master)](https://travis-ci.org/OfficeDev/O365-PHP-Microsoft-Graph-Connect)

連接到 Office 365 是每個應用程式要開始使用 Office 365 服務和資料時必須採取的第一個步驟。此範例示範如何透過 Microsoft Graph (之前稱為 Office 365 統一 API) 連接而後呼叫一個 API，然後使用 Office Fabric UI 來打造 Office 365 經驗。

嘗試可簡化註冊的 [Office 365 API 入門](http://dev.office.com/getting-started/office365apis?platform=option-php#setup)頁面，以便您能更快速地執行這個範例。

![Office 365 PHP Connect 範例螢幕擷取畫面](../readme-images/O365-PHP-Microsoft-Graph-Connect.png)

> 附註：如需深入了解程式碼，請參閱 [在 PHP 應用程式中呼叫 Microsoft Graph] (http://graph.microsoft.io/docs/platform/php)。


## 必要條件

若要使用 Office 365 PHP Connect 範例，您需要下列各項：

* 
            需要 [PHP](http://php.net/) 以在開發伺服器上執行範例。此範例內的說明使用了 PHP 5.4 內建網頁伺服器。然而，該範例也已在網際網路資訊服務 (IIS) 及 Apache 伺服器上測試過。
	* 用戶端 URL (cURL) 模組。Web 應用程式使用 cURL 來發出要求至 REST 端點。 
* Office 365 帳戶。您可以註冊&lt;a herf="https://profile.microsoft.com/RegSysProfileCenter/wizardnp.aspx?wizid=14b845d0-938c-45af-b061-f798fbb4d170"&gt;Office 365 開發人員訂閱&lt;/a&gt;，其中包含在開始建置 Office 365 應用程式時，您所需的資源。

     > **附註：**<br />
     如果您已有訂用帳戶，則先前的連結會讓您連到顯示 *抱歉，您無法將之新增到您目前的帳戶* 訊息的頁面。在此情況下，請使用您目前的 Office 365 訂用帳戶所提供的帳戶。<br /><br />
     如果您已登入 Office 365，先前連結中的登入按鈕會顯示 *抱歉，我們無法處理您的要求* 訊息。在此情況下，在相同的頁面登出 Office 365，再重新登入。
* 用來註冊您的應用程式的 Microsoft Azure 租用戶。Azure Active Directory (AD) 會提供識別服務，以便應用程式用於驗證和授權。在 [Microsoft Azure](https://account.windowsazure.com/SignUp) 可以取得試用版的訂用帳戶。

     > **重要事項：**<br />
     您還需要確定您的 Azure 訂用帳戶已繫結至您的 Office 365 租用戶。若要執行這項操作，請參閱 Active Directory 小組的部落格文章：[建立和管理多個 Windows Azure Active Directory](http://blogs.technet.com/b/ad/archive/2013/11/08/creating-and-managing-multiple-windows-azure-active-directories.aspx)。**新增目錄**一節將說明如何執行這項操作。如需詳細資訊，也可以參閱[設定 Office 365 開發環境](ht5ps://msdn.microsoft.com/office/office365/howto/setup-development-environment#bk_CreateAzureSubscription)和**建立 Office 365 帳戶與 Azure AD 的關聯以便建立和管理應用程式**一節。
* 在 Azure 中註冊之應用程式的[```用戶端識別碼```](app/Constants.php#L29)和[```機碼```](app/Constants.php#L30)值。此範例應用程式必須取得 **Microsoft Graph** 的 [以使用者身分傳送郵件]<e /> 權限。如需詳細資訊，請參閱[在 Azure 管理入口網站中註冊您的 Web 應用程式](https://msdn.microsoft.com/office/office365/HowTo/add-common-consent-manually#bk_RegisterServerApp)及[授與適當的權限給 Connect 應用程式](https://github.com/OfficeDev/O365-PHP-Microsoft-Graph-Connect/wiki/Grant-permissions-to-the-Connect-application-in-Azure)。

     > **附註：**<br />
     在應用程式註冊過程中，請務必指定 **http://localhost:8000/callback.php** 做為 [登入 URL]<e />。

## 設定和執行應用程式

1. 使用您最愛的 IDE，開啟 *app* 資料夾中的 **Constants.php**。
2. 用已註冊之 Azure 應用程式的用戶端識別碼來取代 *ENTER_YOUR_CLIENT_ID*。
3. 用已註冊之 Azure 應用程式的用戶端密碼來取代 *ENTER_YOUR_SECRET*。
4. 使用下列命令來啟動內建網頁伺服器：
    ```
    php -S 0.0.0.0:8000 -t app
    ```
    
5. 在網頁瀏覽器中瀏覽至 ```http://localhost:8000```。

## 疑難排解

### 錯誤：無法取得本機發行者憑證

在登入頁面內提供您的認證後，您就會收到下列錯誤。
```
SSL certificate problem: unable to get local issuer certificate
```

當嘗試發出請求呼叫以取得權杖時，cURL 無法驗證 Microsoft 認證的有效性。在發出 https 請求時，您必須設定 cURL 以使用憑證，請依照下列步驟︰  

1. 從 [cURL 網站](http://curl.haxx.se/docs/caextract.html)下載 cacert.pem 檔案。 
2. 開啟您的 php.ini 檔案並新增下列幾行

	```
	curl.cainfo = "path_to_cacert/cacert.pem"
	```

## 問題與意見

我們很樂於收到您對於 Office 365 PHP Connect 範例的意見反應。您可以在此儲存機制的[問題](https://github.com/OfficeDev/O365-PHP-Microsoft-Graph-Connect/issues)區段中，將您的問題及建議傳送給我們。

請在 [Stack Overflow](http://stackoverflow.com/questions/tagged/Office365+API) 提出有關 Office 365 開發的一般問題。務必以 [Office365] 和 [API] 標記您的問題或意見。
  
## 其他資源

* [Office 365 API 平台概觀](https://msdn.microsoft.com/office/office365/howto/platform-development-overview)
* [Office 365 API 入門](http://dev.office.com/getting-started/office365apis)
* [Microsoft Graph 概觀](http://graph.microsoft.io/)
* &lt;a herf="https://github.com/officedev?utf8=%E2%9C%93&amp;query=Microsoft-Graph-Connect"&gt;其他 Microsoft Graph Connect 範例&lt;/a&gt;
* [Office 365 API 入門專案和程式碼範例](https://msdn.microsoft.com/office/office365/howto/starter-projects-and-code-samples)
* [Office UI 結構](https://github.com/OfficeDev/Office-UI-Fabric)

## 著作權
Copyright (c) 2016 Microsoft.著作權所有，並保留一切權利。


