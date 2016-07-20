# Пример приложения на PHP, подключающегося к Office 365 и использующего Microsoft Graph

[![Build Status](https://travis-ci.org/microsoftgraph/php-connect-rest-sample.svg?branch=master)](https://travis-ci.org/microsoftgraph/php-connect-rest-sample)

Подключение к Office 365 — это первый шаг, который должно выполнить каждое приложение, чтобы начать работу со службами и данными Office 365. В этом примере показано, как подключить и вызвать один API с помощью Microsoft Graph (прежнее название — единый API Office 365), а также использовать платформу Office UI Fabric для работы с Office 365.

Перейдите на страницу [Начало работы с API Office 365](http://dev.office.com/getting-started/office365apis?platform=option-php#setup) для упрощенной регистрации, чтобы ускорить запуск этого примера.

![Снимок экрана с примером приложения на PHP, подключающегося к Office 365](../readme-images/O365-PHP-Microsoft-Graph-Connect.png)

> Примечание. Подробное описание кода см. в статье [Вызов Microsoft Graph в приложении на PHP] (http://graph.microsoft.io/docs/platform/php).


## Необходимые условия

Чтобы воспользоваться примером приложения на PHP, подключающегося к Office 365, требуются следующие компоненты:

* 
            Для запуска приложения на сервере разработки требуется [PHP](http://php.net/). Инструкции для этого примера приложения приведены для встроенного веб-сервера PHP 5.4. Но этот пример также протестирован в службах IIS и на Apache Server.
	* Модуль URL-адреса клиента (cURL). Веб-приложение использует cURL для отправки запросов в конечные точки REST. 
* Учетная запись Office 365. Вы можете [подписаться на план Office 365 для разработчиков](https://aka.ms/devprogramsignup), включающий ресурсы, которые необходимы для создания приложений Office 365.

     > **Примечание.**<br />
     Если у вас уже есть подписка, при выборе приведенной выше ссылки откроется страница с сообщением *К сожалению, вы не можете добавить это к своей учетной записи*. В этом случае используйте учетную запись, сопоставленную с текущей подпиской на Office 365.<br /><br />
     Если вы уже вошли в систему Office 365, на кнопке входа, отображенной после выбора предыдущей ссылки, появится сообщение *Невозможно обработать ваш запрос*. В этом случае выйдите из Office 365 на этой же странице и повторно выполните вход.
* Клиент Microsoft Azure для регистрации приложения. В Azure Active Directory (AD) доступны службы идентификации, которые приложения используют для проверки подлинности и авторизации. Пробную подписку можно получить на сайте [Microsoft Azure](https://account.windowsazure.com/SignUp).

     > **Важно!**<br />
     Убедитесь, что ваша подписка на Azure привязана к клиенту Office 365. Для этого просмотрите запись в блоге команды Active Directory, посвященную [созданию нескольких каталогов Microsoft Azure AD и управлению ими](http://blogs.technet.com/b/ad/archive/2013/11/08/creating-and-managing-multiple-windows-azure-active-directories.aspx). Инструкции приведены в разделе о **добавлении нового каталога**. Дополнительные сведения см. в статье [Как настроить среду разработки для Office 365](ht5ps://msdn.microsoft.com/office/office365/howto/setup-development-environment#bk_CreateAzureSubscription) и, в частности, в разделе **Связывание Azure AD и учетной записи Office 365 для создания приложений и управления ими**.
* [```Ключ```](app/Constants.php#L29) и [```идентификатор клиента```](app/Constants.php#L30), указанные при регистрации приложения в Azure. Этому приложению необходимо предоставить разрешение **Отправка почты от имени пользователя** для **Microsoft Graph**. Дополнительные сведения см. в разделе [Как зарегистрировать приложение веб-сервера на портале управления Azure](https://msdn.microsoft.com/office/office365/HowTo/add-common-consent-manually#bk_RegisterServerApp) и [предоставьте подключающемуся приложению необходимые разрешения](https://github.com/OfficeDev/O365-PHP-Microsoft-Graph-Connect/wiki/Grant-permissions-to-the-Connect-application-in-Azure).

     > **Примечание.**<br />
     При регистрации приложения укажите **http://localhost:8000/callback.php** как значение параметра **URL-адрес входа**.

## Настройка и запуск приложения

1. С помощью любого интерфейса IDE откройте файл **Constants.php** в папке *app*.
2. Замените *ENTER_YOUR_CLIENT_ID* на идентификатор клиента для зарегистрированного в Azure приложения.
3. Замените *ENTER_YOUR_SECRET* на секрет клиента для зарегистрированного в Azure приложения.
4. Запустите встроенный веб-сервер с помощью следующей команды:
    ```
    php -S 0.0.0.0:8000 -t app
    ```
    
5. Введите адрес ```http://localhost:8000``` в веб-браузере.

## Устранение неполадок

### Ошибка: не удалось получить сертификат локального издателя.

После ввода учетных данных на странице входа отображается приведенное ниже сообщение об ошибке.
```
SSL certificate problem: unable to get local issuer certificate
```

cURL не удается проверить действительность сертификата Майкрософт при попытке вызова запроса для получения маркеров. cURL необходимо настроить на использование сертификата при https-запросах. Для этого выполните перечисленные ниже действия.  

1. Скачайте файл cacert.pem на [веб-сайте cURL](http://curl.haxx.se/docs/caextract.html). 
2. Откройте файл php.ini и добавьте приведенную ниже строку.

	```
	curl.cainfo = "path_to_cacert/cacert.pem"
	```

## Вопросы и комментарии

Мы будем рады получить от вас отзывы о примере приложения на PHP, подключающегося к Office 365. Вы можете отправлять нам вопросы и предложения в разделе [Issues](https://github.com/OfficeDev/O365-PHP-Microsoft-Graph-Connect/issues) этого репозитория.

Общие вопросы о разработке решений для Office 365 следует публиковать на сайте [Stack Overflow](http://stackoverflow.com/questions/tagged/Office365+API). Обязательно помечайте свои вопросы и комментарии тегами [Office365] и [API].
  
## Дополнительные ресурсы

* [Общие сведения о платформе API Office 365](https://msdn.microsoft.com/office/office365/howto/platform-development-overview)
* [Начало работы с API Office 365](http://dev.office.com/getting-started/office365apis)
* [Обзор Microsoft Graph](http://graph.microsoft.io/)
* &lt;a herf="https://github.com/officedev?utf8=%E2%9C%93&amp;query=Microsoft-Graph-Connect"&gt;Другие примеры приложений, подключающихся с использованием Microsoft Graph&lt;/a&gt;
* [Проекты API Office 365 и примеры кода для начинающих](https://msdn.microsoft.com/office/office365/howto/starter-projects-and-code-samples)
* [Office UI Fabric](https://github.com/OfficeDev/Office-UI-Fabric)

## Авторское право
(c) Корпорация Майкрософт (Microsoft Corporation), 2016. Все права защищены.


