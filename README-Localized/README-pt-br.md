# Exemplo de conexão com o Office 365 para PHP usando o Microsoft Graph

[![Build Status](https://travis-ci.org/microsoftgraph/php-connect-rest-sample.svg?branch=master)](https://travis-ci.org/microsoftgraph/php-connect-rest-sample)

A primeira etapa para que os aplicativos comecem a funcionar com dados e serviços do Office 365 é estabelecer uma conexão com essa plataforma. Este exemplo mostra como conectar e chamar uma API através do Microsoft Graph (antiga API unificada do Office 365) e usa o Office Fabric UI para criar uma experiência do Office 365.

Experimente a página [Introdução às APIs do Office 365](http://dev.office.com/getting-started/office365apis?platform=option-php#setup), que simplifica o registro para que você possa executar esse exemplo com mais rapidez.

![Captura de tela do exemplo de conexão com o Office 365 para PHP](../readme-images/php-connect-rest-sample.png)

> Observação: Para ter uma visão detalhada do código, confira [Chamar o Microsoft Graph em um aplicativo PHP] (http://graph.microsoft.io/docs/platform/php).


## Pré-requisitos

Para usar o exemplo de conexão com o Office 365 para PHP, é necessário o seguinte:

* 
            É necessário [PHP](http://php.net/) para executar o exemplo em um servidor de desenvolvimento. As instruções deste exemplo usam o servidor Web interno do PHP 5.4. No entanto, o exemplo também foi testado nos Serviços de Informações da Internet e no servidor Apache.
	* Módulo de cURL (URL do Cliente). O aplicativo Web usa a cURL para emitir solicitações para pontos de extremidade REST. 
* Uma conta do Office 365. Você pode se inscrever para [uma assinatura do Office 365 Developer](https://aka.ms/devprogramsignup), que inclui os recursos de que você precisa para começar a criar aplicativos do Office 365.

     > **Observação:**<br />
     Caso já tenha uma assinatura, o link anterior direciona você para uma página com a mensagem *Não é possível adicioná-la à sua conta atual*. Nesse caso, use uma conta de sua assinatura atual do Office 365.<br /><br />
     Se você já entrou no Office 365, o botão Entrar no link anterior mostra a mensagem *Não é possível processar sua solicitação*. Nesse caso, saia do Office 365 nessa mesma página e entre novamente.
* Um locatário do Microsoft Azure para registrar o seu aplicativo. O Azure Active Directory (AD) fornece serviços de identidade que os aplicativos usam para autenticação e autorização. Você pode adquirir uma assinatura de avaliação no [Microsoft Azure](https://account.windowsazure.com/SignUp).

     > **Importante:**<br />
     Você também deve assegurar que a sua assinatura do Azure esteja vinculada ao seu locatário do Office 365. Para saber como fazer isso, confira a postagem de blog da equipe do Active Directory: [Criar e gerenciar vários Microsoft Azure Active Directory](http://blogs.technet.com/b/ad/archive/2013/11/08/creating-and-managing-multiple-windows-azure-active-directories.aspx). A seção **Adicionar um novo diretório** explica como fazer isso. Para saber mais, confira o artigo [Configurar o seu ambiente de desenvolvimento do Office 365](ht5ps://msdn.microsoft.com/office/office365/howto/setup-development-environment#bk_CreateAzureSubscription) e a seção **Associar a sua conta do Office 365 ao Azure AD para criar e gerenciar aplicativos**.
* Valores de [```ID do cliente```](app/Constants.php#L29) e de [```chave```](app/Constants.php#L30) de um aplicativo registrado no Azure. Este exemplo de aplicativo deve receber permissão para **Enviar email como um usuário** para o **Microsoft Graph**. Para obter informações detalhadas, confira o artigo [Registrar o aplicativo do servidor Web com o Portal de Gerenciamento do Azure](https://msdn.microsoft.com/office/office365/HowTo/add-common-consent-manually#bk_RegisterServerApp) e [conceda as permissões adequadas para o aplicativo de conexão](https://github.com/microsoftgraph/php-connect-rest-sample/wiki/Grant-permissions-to-the-Connect-application-in-Azure).

     > **Observação:**<br />
     Durante o processo de registro do aplicativo, não deixe de especificar **http://localhost:8000/callback.php** como a **URL de Entrada**.

## Configurar e executar o aplicativo

1. Abra **Constants.php** na pasta *app* usando seu IDE favorito.
2. Substitua *ENTER_YOUR_CLIENT_ID* pela ID do cliente do aplicativo Azure registrado.
3. Substitua *ENTER_YOUR_SECRET* pelo segredo do cliente do aplicativo Azure registrado.
4. Inicie o servidor Web interno com o seguinte comando:
    ```
    php -S 0.0.0.0:8000 -t app
    ```
    
5. Acesse ```http://localhost:8000``` no navegador da Web.

## Solução de problemas

### Erro: Não é possível obter o certificado do emissor local

Quando você fornece as credenciais para entrar na página, recebe a seguinte mensagem de erro.
```
SSL certificate problem: unable to get local issuer certificate
```

O cURL não pode verificar a validade do certificado da Microsoft ao tentar emitir uma chamada de solicitação para obter tokens. Você deve configurar o cURL para usar um certificado ao emitir solicitações https da seguinte maneira:  

1. Baixe o arquivo cacert.pem a partir do [site do cURL](http://curl.haxx.se/docs/caextract.html). 
2. Abra o arquivo php.ini e adicione a seguinte linha

	```
	curl.cainfo = "path_to_cacert/cacert.pem"
	```

## Perguntas e comentários

Gostaríamos de saber sua opinião sobre o exemplo de conexão com o Office 365 para PHP. Você pode enviar perguntas e sugestões na seção [Problemas](https://github.com/microsoftgraph/php-connect-rest-sample/issues) deste repositório.

As perguntas sobre o desenvolvimento do Office 365 em geral devem ser postadas no [Stack Overflow](http://stackoverflow.com/questions/tagged/Office365+API). Não deixe de marcar as perguntas ou comentários com [Office365] e [API].
  
## Recursos adicionais

* [Visão geral da plataforma de APIs do Office 365](https://msdn.microsoft.com/office/office365/howto/platform-development-overview)
* [Introdução às APIs do Office 365](http://dev.office.com/getting-started/office365apis)
* [Visão geral do Microsoft Graph](http://graph.microsoft.io/)
* &lt;a herf="https://github.com/microsoftgraph?utf8=%E2%9C%93&amp;query=Microsoft-Graph-Connect"&gt;Outros exemplos do Microsoft Graph Connect&lt;/a&gt;
* [Exemplos de código e projetos iniciais de APIs do Office 365](https://msdn.microsoft.com/office/office365/howto/starter-projects-and-code-samples)
* [Office UI Fabric](https://github.com/OfficeDev/Office-UI-Fabric)

## Direitos autorais
Copyright © 2016 Microsoft. Todos os direitos reservados.


