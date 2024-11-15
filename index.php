<?php
require_once(__DIR__ . "/app/util/config.php");
// Iniciar sessão
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION[SESSAO_USUARIO_ID])) {
    // Redireciona para a página inicial (home)
    header("location: " . HOME_PAGE);
    exit();
}
require_once(__DIR__ . "/app/view/include/header.php");
?>

<link rel="stylesheet" href="/PFC/app/view/css/index.css">

<div class="container">
    <div class="leftCont">
        <img class="logo" src="/PFC/app/assets/logo.png" alt="">

        <a href="/PFC/app/controller/LoginController.php?action=createCadastro" class="btn-log mb-3">CADASTRAR</a>

        <a href="/PFC/app/controller/LoginController.php?action=login" class="btn-log">ENTRAR</a>

    </div>


    <div class="rightCont">

        <img src="/PFC/app/assets/imgIFSHARE.png" alt="">

    </div>


</div>

<?php
require_once(__DIR__ . "/app/view/include/footer.php");
?>