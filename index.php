<?php
require_once(__DIR__ . "/app/util/config.php");
// Iniciar sessão
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Verifica se o usuário já está logado
if (isset($_SESSION[SESSAO_USUARIO_ID])) {
    // Redireciona para a página inicial (home)
    header("location: " . HOME_PAGE);
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFShare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=verified" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=send" />
    <link rel="shortcut icon" href="/PFC/app/assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/PFC/app/view/css/index.css">
</head>

<body>




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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ece9031cab.js" crossorigin="anonymous"></script>
</body>

</html>