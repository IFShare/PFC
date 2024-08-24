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

//Sessão do usuário
define('SESSAO_USUARIO_ID', "usuarioLogadoId");
define('SESSAO_USUARIO_NOME', "usuarioLogadoNome");
define('SESSAO_USUARIO_TIPO', "usuarioLogadoTipo");

//Página de logout do sistema
define('LOGIN_PAGE', BASEURL . '/controller/LoginController.php?action=login');