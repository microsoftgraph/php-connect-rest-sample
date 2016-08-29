# Exemple de connexion de PHP à Office 365 avec Microsoft Graph

[![Build Status](https://travis-ci.org/microsoftgraph/php-connect-rest-sample.svg?branch=master)](https://travis-ci.org/microsoftgraph/php-connect-rest-sample)

La connexion à Office 365 est la première étape que chaque application doit suivre pour que vous puissiez commencer à travailler avec les données et services Office 365. Cet exemple explique comment connecter, puis appeler une API via Microsoft Graph (anciennement appelé API unifiée Office 365). Il utilise la structure d’interface utilisateur d’Office pour créer une expérience Office 365.

Consultez la page relative à la [prise en main des API Office 365](http://dev.office.com/getting-started/office365apis?platform=option-php#setup) pour enregistrer plus facilement votre application et exécuter plus rapidement cet exemple.

![Capture d’écran d’un exemple de connexion de PHP à Office 365](../readme-images/php-connect-rest-sample.png)

> Remarque : pour observer le code plus en détail, consultez l’article relatif à l’appel de Microsoft Graph dans une application PHP (http://graph.microsoft.io/docs/platform/php).


## Conditions requises

Pour utiliser l’exemple de connexion de PHP à Office 365, vous devez disposer des éléments suivants :

* [PHP](http://php.net/) est nécessaire pour exécuter l’exemple dans un serveur de développement. Les instructions de cet exemple utilisent le serveur web intégré PHP 5.4. Cependant, l’exemple a également été testé sur Internet Information Services et Apache Server.
	* Module URL client (cURL). L’application web utilise cURL pour envoyer des requêtes aux points de terminaison REST. 
* Un compte Office 365. Vous pouvez souscrire à [un abonnement Office 365 Développeur](https://aka.ms/devprogramsignup) comprenant les ressources dont vous avez besoin pour commencer à créer des applications Office 365.

     > **Remarque :**<br />
     si vous avez déjà un abonnement, le lien précédent vous renvoie vers une page avec le message suivant : « Désolé, vous ne pouvez pas ajouter ceci à votre compte existant ». Dans ce cas, utilisez un compte lié à votre abonnement Office 365 existant.<br /><br />
     Si vous êtes déjà connecté à Office 365, le bouton de connexion dans le lien précédent affiche le message suivant : « Désolé, nous ne pouvons pas traiter votre demande ». Dans ce cas, déconnectez-vous d’Office 365 sur cette même page et connectez-vous à nouveau.
* Un client Microsoft Azure pour enregistrer votre application. Azure Active Directory (AD) fournit des services d’identité que les applications utilisent à des fins d’authentification et d’autorisation. Un abonnement d’évaluation peut être demandé sur le site de [Microsoft Azure](https://account.windowsazure.com/SignUp).

     > **Important :**<br />
     vous devez également vous assurer que votre abonnement Azure est lié à votre client Office 365. Pour cela, consultez le billet du blog de l’équipe d’Active Directory relatif à la [création et la gestion de plusieurs fenêtres dans les répertoires Azure Active Directory](http://blogs.technet.com/b/ad/archive/2013/11/08/creating-and-managing-multiple-windows-azure-active-directories.aspx). La section sur l’**ajout d’un nouveau répertoire** vous explique comment procéder. Pour en savoir plus, vous pouvez également consulter la rubrique relative à la [configuration de votre environnement de développement Office 365](ht5ps://msdn.microsoft.com/office/office365/howto/setup-development-environment#bk_CreateAzureSubscription) et la section sur l’**association de votre compte Office 365 à Azure Active Directory pour créer et gérer des applications**.
* Un [```ID client```](app/Constants.php#L29) et des valeurs [```clés```](app/Constants.php#L30) d’une application enregistrée dans Azure. Cet exemple d’application doit obtenir l’autorisation **Envoyer un courrier électronique en tant qu’utilisateur** pour **Microsoft Graph**. Pour plus d’informations, consultez [Enregistrer une application de serveur web avec le portail de gestion Azure](https://msdn.microsoft.com/office/office365/HowTo/add-common-consent-manually#bk_RegisterServerApp) et [Accorder les autorisations appropriées à l’application de connexion](https://github.com/microsoftgraph/php-connect-rest-sample/wiki/Grant-permissions-to-the-Connect-application-in-Azure).

     > **Remarque :**<br />
     pendant le processus d’inscription de l’application, veillez à indiquer **http://localhost:8000/callback.php** en tant qu’**URL d’authentification**.

## Configuration et exécution de l’application

1. À l’aide de votre IDE favori, ouvrez **Constants.php** dans le dossier *app*.
2. Remplacez *ENTER_YOUR_CLIENT_ID* par l’ID client de votre application Azure inscrite.
3. Remplacez *ENTER_YOUR_SECRET* par la clé secrète client de votre application Azure enregistrée.
4. Lancez le serveur web intégré avec la commande suivante :
    ```
    php -S 0.0.0.0:8000 -t app
    ```
    
5. Accédez à ```http://localhost:8000``` dans votre navigateur web.

## Résolution des problèmes

### Erreur : Impossible d’obtenir le certificat de l’émetteur local

Vous recevez l’erreur suivante après avoir fourni vos informations d’identification sur la page de connexion.
```
SSL certificate problem: unable to get local issuer certificate
```

cURL ne peut pas vérifier la validité du certificat Microsoft quand vous tentez d’émettre un appel de requête pour obtenir des jetons. Vous devez configurer cURL pour utiliser un certificat pendant l’envoi des requêtes HTTPS en suivant les étapes ci-dessous :  

1. Téléchargez le fichier cacert.pem sur le [site web de cURL](http://curl.haxx.se/docs/caextract.html). 
2. Ouvrez votre fichier php.ini et ajoutez la ligne suivante.

	```
	curl.cainfo = "path_to_cacert/cacert.pem"
	```

## Questions et commentaires

Nous serions ravis de connaître votre opinion sur l’exemple de connexion de PHP à Microsoft Graph. Vous pouvez nous faire part de vos questions et suggestions dans la rubrique [Problèmes](https://github.com/microsoftgraph/php-connect-rest-sample/issues) de ce référentiel.

Si vous avez des questions sur le développement d’Office 365, envoyez-les sur [Stack Overflow](http://stackoverflow.com/questions/tagged/Office365+API). Posez vos questions avec les balises [API] et [Office365].
  
## Ressources supplémentaires

* [Présentation de la plateforme des API Office 365](https://msdn.microsoft.com/office/office365/howto/platform-development-overview)
* [Prise en main des API Office 365](http://dev.office.com/getting-started/office365apis)
* [Présentation de Microsoft Graph](http://graph.microsoft.io/)
* &lt;a herf="https://github.com/microsoftgraph?utf8=%E2%9C%93&amp;query=Microsoft-Graph-Connect"&gt;Autres exemples de connexion Microsoft Graph&lt;/a&gt;
* [Projets de démarrage et exemples de codes des API Office 365](https://msdn.microsoft.com/office/office365/howto/starter-projects-and-code-samples)
* [Structure de l’interface utilisateur Office](https://github.com/OfficeDev/Office-UI-Fabric)

## Copyright
Copyright (c) 2016 Microsoft. Tous droits réservés.


