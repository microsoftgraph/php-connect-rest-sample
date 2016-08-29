# Microsoft Graph を使った Office 365 PHP Connect サンプル

[![Build Status](https://travis-ci.org/microsoftgraph/php-connect-rest-sample.svg?branch=master)](https://travis-ci.org/microsoftgraph/php-connect-rest-sample)

各アプリで Office 365 のサービスとデータの操作を開始するため、最初に Office 365 に接続する必要があります。このサンプルでは、Microsoft Graph (以前は Office 365 統合 API と呼ばれていた) を介して 1 つの API に接続して呼び出す方法を示し、Office Fabric UI を使って Office 365 エクスペリエンスを作成します。

このサンプルをより迅速に実行するため、「[Office 365 API を使う](http://dev.office.com/getting-started/office365apis?platform=option-php#setup)」ページに記載された登録の簡略化をお試しください。

![Office 365 PHP Connect サンプルのスクリーンショット](../readme-images/php-connect-rest-sample.png)

> 注:コードについて詳しくは、「PHP アプリで Microsoft Graph を呼び出す」(http://graph.microsoft.io/docs/platform/php) をご覧ください。


## 前提条件

Office 365 PHP Connect サンプルを使うには、次が必要です。

* [PHP](http://php.net/) は、開発サーバー上でサンプルを実行するために必要です。このサンプルの手順では、PHP 5.4 組み込み Web サーバーを使います。ただし、サンプルは、インターネット インフォメーション サービスと Apache サーバーでもテストされています。
	* クライアント URL (cURL) モジュール。Web アプリケーションでは、cURL を使って REST エンドポイントに要求を発行します。 
* Office 365 アカウント。[Office 365 Developer](https://aka.ms/devprogramsignup)  サブスクリプションにサイン アップすることができます。ここには、Office 365 アプリのビルドを開始するために必要なリソースが含まれています。

     > **注:**<br />
     サブスクリプションが既に存在する場合、上記のリンクをクリックすると、*申し訳ありません、現在のアカウントに追加できません* と表示されたページに移動します。その場合は、現在使用している Office 365 サブスクリプションのアカウントをご利用いただけます。<br /><br />
     Office 365 にすでにサインインしている場合、上記のリンクの [サインイン] ボタンに、*申し訳ございません。お客様のリクエストを処理できません。* というメッセージが表示されます。その場合、その同じページで Office 365 からサインアウトし、その後もう一度サインインしてください。
* アプリケーションを登録する Microsoft Azure テナント。Azure Active Directory (AD) は、アプリケーションが認証と承認に使用する ID サービスを提供します。試用版サブスクリプションは、[Microsoft Azure](https://account.windowsazure.com/SignUp) で取得できます。

     > **重要事項:**<br />
     Azure サブスクリプションが Office 365 テナントにバインドされていることを確認する必要があります。確認するには、Active Directory チームのブログ投稿「[複数の Windows Azure Active Directory を作成および管理する](http://blogs.technet.com/b/ad/archive/2013/11/08/creating-and-managing-multiple-windows-azure-active-directories.aspx)」を参照してください。「**新しいディレクトリを追加する**」セクションで、この方法について説明しています。また、詳細については、「[Office 365 開発環境をセットアップする](ht5ps://msdn.microsoft.com/office/office365/howto/setup-development-environment#bk_CreateAzureSubscription)」や「**Office 365 アカウントを Azure AD と関連付けてアプリを作成および管理する**」セクションも参照してください。
* Azure に登録されたアプリケーションの[```クライアント ID```](app/Constants.php#L29) と[```キー```](app/Constants.php#L30)の値。このサンプル アプリケーションには、**Microsoft Graph** の**ユーザーとしてメールを送信する**アクセス許可を付与する必要があります。詳しくは、「[Azure 管理ポータルに Web サーバー アプリを登録する](https://msdn.microsoft.com/office/office365/HowTo/add-common-consent-manually#bk_RegisterServerApp)」と「[Connect アプリケーションに適切なアクセス許可を付与する](https://github.com/OfficeDev/php-connect-rest-sample/wiki/Grant-permissions-to-the-Connect-application-in-Azure)」をご覧ください。

     > **注:**<br />
     アプリ登録プロセス時に、**サインオン URL** として **http://localhost:8000/callback.php** を必ず指定します。

## アプリの構成と実行

1. 任意の IDE を使って、*アプリ* フォルダーで **Constants.php** を開きます。
2. *ENTER_YOUR_CLIENT_ID* を登録済みの Azure アプリケーションのクライアント ID と置き換えます。
3. *ENTER_YOUR_SECRET* を登録済みの Azure アプリケーションのクライアント シークレットと置き換えます。
4. 次のコマンドを使って、組み込み Web サーバーを起動します。
    ```
    php -S 0.0.0.0:8000 -t app
    ```
    
5. Web ブラウザーで ```http://localhost:8000``` に移動します。

## トラブルシューティング

### エラー:ローカル発行者証明書を取得できません。

サインイン ページに資格情報を入力すると、次のエラーが表示されます。
```
SSL certificate problem: unable to get local issuer certificate
```

cURL は、トークンを取得する要求の呼び出しを発行しようとするときに、Microsoft 証明書の有効性を確認できません。次の手順に従って、https 要求を発行する際に証明書を使うように cURL を構成する必要があります。  

1. [cURL Web サイト](http://curl.haxx.se/docs/caextract.html)から cacert.pem ファイルをダウンロードします。 
2. php.ini ファイルを開き、次の行を追加します。

	```
	curl.cainfo = "path_to_cacert/cacert.pem"
	```

## 質問とコメント

Office 365 PHP Connect サンプルについて、Microsoft にフィードバックをお寄せください。質問や提案につきましては、このリポジトリの「[問題](https://github.com/OfficeDev/php-connect-rest-sample/issues)」セクションに送信できます。

Office 365 開発全般の質問につきましては、「[スタック オーバーフロー](http://stackoverflow.com/questions/tagged/Office365+API)」に投稿してください。質問またはコメントには、必ず [Office365] および [API] のタグを付けてください。
  
## その他の技術情報

* [Office 365 API プラットフォームの概要](https://msdn.microsoft.com/office/office365/howto/platform-development-overview)
* [Office 365 API を使う](http://dev.office.com/getting-started/office365apis)
* [Microsoft Graph の概要](http://graph.microsoft.io/)
* &lt;a herf="https://github.com/officedev?utf8=%E2%9C%93&amp;query=Microsoft-Graph-Connect"&gt;その他の Microsoft Graph Connect サンプル&lt;/a&gt;
* [Office 365 API スタート プロジェクトおよびサンプル コード](https://msdn.microsoft.com/office/office365/howto/starter-projects-and-code-samples)
* [Office の UI ファブリック](https://github.com/OfficeDev/Office-UI-Fabric)

## 著作権
Copyright (c) 2016 Microsoft. All rights reserved.


