# Ejemplo Connect de PHP para Office 365 con Microsoft Graph

[![Build Status](https://travis-ci.org/microsoftgraph/php-connect-rest-sample.svg?branch=master)](https://travis-ci.org/microsoftgraph/php-connect-rest-sample)

Conectarse a Office 365 es el primer paso que debe realizar cada aplicación para empezar a trabajar con los datos y servicios de Office 365. Este ejemplo muestra cómo conectar y cómo llamar después a una API mediante Microsoft Graph (anteriormente denominada API unificada de Office 365), y usa la interfaz de usuario Fabric de Office para crear una experiencia de Office 365.

Consulte [Introducción a las API de Office 365](http://dev.office.com/getting-started/office365apis?platform=option-php#setup), que simplifica el registro para que este ejemplo se ejecute más rápidamente.

![Captura de pantalla del ejemplo Connect de PHP para Office 365](../readme-images/php-connect-rest-sample.png)

> Nota: Para realizar un análisis exhaustivo del código, consulte [Llamar a Microsoft Graph en una aplicación PHP] (http://graph.microsoft.io/docs/platform/php).


## Requisitos previos

Para usar el ejemplo Connect de PHP para Office 365, necesita lo siguiente:

* 
            Se requiere [PHP](http://php.net/) para ejecutar el ejemplo en un servidor de desarrollo. Las instrucciones de este ejemplo usan el servidor web integrado PHP 5.4. Sin embargo, el ejemplo también se probó en Internet Information Services y en el servidor Apache.
	* Módulo de la dirección URL del cliente(cURL). La aplicación web usa cURL para emitir solicitudes a los puntos de conexión REST. 
* Una cuenta de Office 365. Puede registrarse para obtener [una suscripción a Office 365 Developer](https://aka.ms/devprogramsignup), que incluye los recursos que necesita para empezar a compilar aplicaciones de Office 365.

     > **Nota:**<br />
     Si ya dispone de una suscripción, el vínculo anterior le dirige a una página con el mensaje *No se puede agregar a su cuenta actual*. En ese caso, use una cuenta de su suscripción actual a Office 365.<br /><br />
     Si ya inició sesión en Office 365, el botón de inicio de sesión del vínculo anterior muestra el mensaje *No podemos procesar su solicitud*. En ese caso, cierre sesión en Office 365 en esa misma página y vuelva a iniciarla.
* Un inquilino de Microsoft Azure para registrar la aplicación. Azure Active Directory (AD) proporciona servicios de identidad que las aplicaciones usan para autenticación y autorización. Se puede adquirir una suscripción de prueba en [Microsoft Azure](https://account.windowsazure.com/SignUp).

     > **Importante:**<br />
     También necesita asegurarse de que su suscripción de Azure está enlazada a su inquilino de Office 365. Para ello, consulte la publicación del blog del equipo de Active Directory, [Crear y administrar varios directorios de Windows Azure Active Directory](http://blogs.technet.com/b/ad/archive/2013/11/08/creating-and-managing-multiple-windows-azure-active-directories.aspx). La sección **Agregar un nuevo directorio** le explicará cómo hacerlo. Para obtener más información, también puede consultar [Configurar el entorno de desarrollo de Office 365](ht5ps://msdn.microsoft.com/office/office365/howto/setup-development-environment#bk_CreateAzureSubscription) y la sección **Asociar su cuenta de Office 365 con Azure AD para crear y administrar aplicaciones**.
* Un [```ID de cliente```](app/Constants.php#L29) i los valores [```de calve```](app/Constants.php#L30) de una aplicación registrada en Azure. A esta aplicación de ejemplo se le debe conceder el permiso **Enviar correo como usuario** para **Microsoft Graph**. Para obtener información detallada, consulte [Registrar su aplicación de servidor web con el Portal de administración de Azure](https://msdn.microsoft.com/office/office365/HowTo/add-common-consent-manually#bk_RegisterServerApp) y [Conceder los permisos adecuados a la aplicación Connect](https://github.com/OfficeDev/php-connect-rest-sample/wiki/Grant-permissions-to-the-Connect-application-in-Azure).

     > **Nota:**<br />
     Durante el proceso de registro de la aplicación, asegúrese de especificar **http://localhost:8000/callback.php** como **Dirección URL de inicio de sesión**.

## Configurar y ejecutar la aplicación

1. Con su IDE favorito, abra **Constants.php** en la carpeta *aplicación*.
2. Reemplace *ENTER_YOUR_CLIENT_ID* por el identificador de cliente de la aplicación registrada en Azure.
3. Reemplace *ENTER_YOUR_SECRET* con el secreto de cliente de la aplicación registrada en Azure.
4. Inicie el servidor web integrado con el siguiente comando:
    ```
    php -S 0.0.0.0:8000 -t app
    ```
    
5. Vaya a ```http://localhost:8000``` en el explorador web.

## Solución de problemas

### Error: No se puede obtener el certificado del emisor local

Recibirá el siguiente error después de proporcionar sus credenciales en la página de inicio de sesión.
```
SSL certificate problem: unable to get local issuer certificate
```

cURL no puede comprobar la validez del certificado de Microsoft al intentar emitir una llamada de solicitud para obtener tokens. Debe configurar cURL para usar un certificado al emitir solicitudes https siguiendo estos pasos:  

1. Descargue el archivo cacert.pem del [sitio web de cURL](http://curl.haxx.se/docs/caextract.html). 
2. Abra el archivo php.ini y agregue la siguiente línea

	```
	curl.cainfo = "path_to_cacert/cacert.pem"
	```

## Preguntas y comentarios

Nos encantaría recibir sus comentarios acerca del ejemplo Connect de PHP para Office 365. Puede enviarnos sus preguntas y sugerencias a través de la sección [Problemas](https://github.com/OfficeDev/php-connect-rest-sample/issues) de este repositorio.

Las preguntas generales sobre desarrollo en Office 365 deben publicarse en [Stack Overflow](http://stackoverflow.com/questions/tagged/Office365+API). Asegúrese de que sus preguntas o comentarios se etiquetan con [Office365] y [API].
  
## Recursos adicionales

* [Información general sobre la plataforma de las API de Office 365](https://msdn.microsoft.com/office/office365/howto/platform-development-overview)
* [Introducción a las API de Office 365](http://dev.office.com/getting-started/office365apis)
* [Información general de Microsoft Graph](http://graph.microsoft.io/)
* &lt;a herf="https://github.com/officedev?utf8=%E2%9C%93&amp;query=Microsoft-Graph-Connect"&gt;Otros ejemplos Connect para Microsoft Graph&lt;/a&gt;
* [Proyectos de inicio de las API de Office 365 y ejemplos de código](https://msdn.microsoft.com/office/office365/howto/starter-projects-and-code-samples)
* [Office UI Fabric](https://github.com/OfficeDev/Office-UI-Fabric)

## Copyright
Copyright (c) 2016 Microsoft. Todos los derechos reservados.


