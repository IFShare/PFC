<?php

//Configurar essas variáveis de acordo com o seu ambiente
define("DB_HOST", "localhost");
define("DB_NAME", "ifshare");
define("DB_USER", "root");
define("DB_PASSWORD", "");

//Constante com a URL do sistema
define("BASEURL", "/PFC/app");

//Nome do sistema
define('APP_NAME', 'IfShare');

define('HOME_PAGE', BASEURL . '/controller/HomeController.php?action=home');

//Página de logout do sistema
define('LOGIN_PAGE', BASEURL . '/controller/LoginController.php?action=login');

//Página de login do sistema
define('LOGOUT_PAGE', BASEURL . '/controller/LoginController.php?action=logout');


define("PATH_ARQUIVOS", __DIR__ . "/../../arquivos");
define("URL_ARQUIVOS", BASEURL . "/../arquivos");

//Sessão do usuário
define('SESSAO_USUARIO_ID', "usuarioLogadoId");
define('SESSAO_USUARIO_NOME_USUARIO', "usuarioLogadoNomeUsuario");
define('SESSAO_USUARIO_TIPO_USUARIO', "usuarioLogadoTipoUsuario");
