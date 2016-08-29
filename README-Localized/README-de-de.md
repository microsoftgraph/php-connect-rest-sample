# Office 365 PHP Connect-Beispiel unter Verwendung von Microsoft Graph

[![Build Status](https://travis-ci.org/microsoftgraph/php-connect-rest-sample.svg?branch=master)](https://travis-ci.org/microsoftgraph/php-connect-rest-sample)

Für die Arbeit mit Office 365-Diensten und -Daten muss jede App zunächst eine Verbindung zu Office 365 herstellen. In diesem Beispiel wird gezeigt, wie die Verbindung zu und dann der Aufruf einer API über Microsoft Graph (wurde zuvor als vereinheitlichte Office 365-API bezeichnet) erfolgt. Ferner wird darin die Office Fabric-Benutzeroberfläche zum Erstellen einer Office 365-Erfahrung verwendet.

Rufen Sie die Seite [Erste Schritte mit Office 365-APIs](http://dev.office.com/getting-started/office365apis?platform=option-php#setup) auf. Auf dieser wird die Registrierung vereinfacht, damit Sie dieses Beispiel schneller ausführen können.

![Screenshot des Office 365 PHP Connect-Beispiels](../readme-images/php-connect-rest-sample.png)

> Hinweis: Einen umfassenden Einblick in den Code erhalten Sie unter [Aufrufen von Microsoft Graph in einer PHP-App] (http://graph.microsoft.io/docs/platform/php).


## Voraussetzungen

Zum Verwenden des 365 PHP Connect-Beispiels benötigen Sie Folgendes:

* 
            Für das Ausführen des Beispiels auf einem Entwicklungsservers ist [PHP](http://php.net/) erforderlich. In den Anweisungen dieses Beispiels wird der integrierte PHP 5.4-Webserver verwendet. Das Beispiel wurde jedoch auch auf Internet Information Services und Apache Server getestet.
	* Client-URL-Modul (cURL). Die Webanwendung verwendet cURL zum Ausstellen von Anfragen an REST-Endpunkte. 
* Ein Office 365-Konto. Sie können sich für ein [Office 365-Entwicklerabonnement](https://aka.ms/devprogramsignup) registrieren, das alle Ressourcen umfasst, die Sie zum Einstieg in die Entwicklung von Office 365-Apps benötigen.

     > **Hinweis:**<br />
     Wenn Sie bereits über ein Abonnement verfügen, gelangen Sie über den vorherigen Link zu einer Seite mit der Meldung „Leider können Sie Ihrem aktuellen Konto diesen Inhalt nicht hinzufügen“. Verwenden Sie in diesem Fall ein Konto aus Ihrem aktuellen Office 365-Abonnement.<br /><br />
     Wenn Sie bereits bei Office 365 angemeldet sind, wird auf der Anmeldeschaltfläche im vorherigen Link die Meldung „Ihre Anforderung konnte leider nicht verarbeitet werden“ angezeigt. Melden Sie sich in diesem Fall aus Office 365 auf derselben Seite ab, und melden Sie sich erneut an.
* Ein Microsoft Azure-Mandant zum Registrieren Ihrer Anwendung. Von Azure Active Directory (AD) werden Identitätsdienste bereitgestellt, die durch Anwendungen für die Authentifizierung und Autorisierung verwendet werden. Ein Testabonnement kann auf [Microsoft Azure](https://account.windowsazure.com/SignUp) erworben werden.

     > **Wichtig:**<br />
     Sie müssen zudem sicherstellen, dass Ihr Azure-Abonnement an Ihren Office 365-Mandanten gebunden ist. Rufen Sie dafür den Blogpost [Creating and Managing Multiple Windows Azure Active Directories](http://blogs.technet.com/b/ad/archive/2013/11/08/creating-and-managing-multiple-windows-azure-active-directories.aspx) des Active Directory-Teams auf. Im Abschnitt **Adding a new directory** finden Sie Informationen über die entsprechende Vorgehensweise. Weitere Informationen finden Sie zudem unter [Einrichten Ihrer Office 365-Entwicklungsumgebung](ht5ps://msdn.microsoft.com/office/office365/howto/setup-development-environment#bk_CreateAzureSubscription) im Abschnitt **Verknüpfen Ihres Office 365-Kontos mit Azure AD zum Erstellen und Verwalten von Apps**.
* Eine [```Client-ID```](app/Constants.php#L29) und [```Schlüsselwerte```](app/Constants.php#L30) einer in Azure registrierten Anwendung. Dieser Beispielanwendung muss die Berechtigung **E-Mails unter einem anderen Benutzernamen senden** für **Microsoft Graph** gewährt werden. Ausführliche Informationen finden Sie unter [Registrieren der Webserver-App mithilfe des Azure-Verwaltungsportals](https://msdn.microsoft.com/office/office365/HowTo/add-common-consent-manually#bk_RegisterServerApp) und im Thema über das [Gewähren entsprechender Berechtigungen zur Connect-Anwendung](https://github.com/microsoftgraph/php-connect-rest-sample/wiki/Grant-permissions-to-the-Connect-application-in-Azure).

     > **Hinweis:**<br />
     Stellen Sie während des App-Registrierungsvorgangs sicher, dass **http://localhost:8000/callback.php** als **Anmelde-URL** angegeben ist.

## Konfigurieren und Ausführen der App

1. Öffnen Sie unter Verwendung Ihrer bevorzugten IDE die Datei **Constants.php** im Ordner *app*.
2. Ersetzen Sie *IHRE_CLIENT_ID_EINGEBEN* durch die Client-ID Ihrer registrierten Azure-Anwendung.
3. Ersetzen Sie *IHR_GEHEIMNIS_EINGEBEN* durch das Clientgeheimnis Ihrer registrierten Azure-Anwendung.
4. Starten Sie den integrierten Webserver mit dem folgenden Befehl:
    ```
    php -S 0.0.0.0:8000 -t app
    ```
    
5. Navigieren Sie zu ```http://localhost:8000``` im Webbrowser.

## Problembehandlung

### Fehler: Zertifikat des lokalen Ausstellers kann nicht abgerufen werden

Nach dem Eingeben Ihrer Anmeldeinformationen auf der Anmeldeseite wird der folgende Fehler angezeigt.
```
SSL certificate problem: unable to get local issuer certificate
```

cURL kann die Gültigkeit des Microsoft-Zertifikats nicht überprüfen, wenn versucht wird, ein Anforderungsaufruf auszustellen, um Token abzurufen. Sie müssen unter Verwendung der folgenden cURL für die Verwendung eines Zertifikats konfigurieren, wenn HTTPS-Anforderungen ausgestellt werden:  

1. Laden Sie die Datei „cacert.pem“ auf der [cURL-Website](http://curl.haxx.se/docs/caextract.html) herunter. 
2. Öffnen Sie die Datei „php.ini“, und fügen Sie die folgende Zeile hinzu:

	```
	curl.cainfo = "path_to_cacert/cacert.pem"
	```

## Fragen und Kommentare

Wir schätzen Ihr Feedback hinsichtlich des Office 365 PHP Connect-Beispiels. Sie können uns Ihre Fragen und Vorschläge über den Abschnitt [Probleme](https://github.com/microsoftgraph/php-connect-rest-sample/issues) dieses Repositorys senden.

Allgemeine Fragen zur Office 365-Entwicklung sollten in [Stack Overflow](http://stackoverflow.com/questions/tagged/Office365+API) gestellt werden. Stellen Sie sicher, dass Ihre Fragen oder Kommentare mit [Office365] und [API] markiert sind.
  
## Zusätzliche Ressourcen

* [Office 365-APIs – Plattformübersicht](https://msdn.microsoft.com/office/office365/howto/platform-development-overview)
* [Erste Schritte mit Office 365-APIs](http://dev.office.com/getting-started/office365apis)
* [Übersicht über Microsoft Graph](http://graph.microsoft.io/)
* &lt;a herf="https://github.com/microsoftgraph?utf8=%E2%9C%93&amp;query=Microsoft-Graph-Connect"&gt;Weitere Microsoft Graph Connect-Beispiele&lt;/a&gt;
* [Office 365-APIs-Startprojekte und -Codebeispiele](https://msdn.microsoft.com/office/office365/howto/starter-projects-and-code-samples)
* [Office-Benutzeroberfläche Fabric](https://github.com/OfficeDev/Office-UI-Fabric)

## Copyright
Copyright (c) 2016 Microsoft. Alle Rechte vorbehalten.


