<?php
require_once(__DIR__ . "/../include/header.php");

?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/baseCSS.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/perfil.css">

<div class="container">

    <a class="voltar"
        href="http://localhost/PFC/app/controller/HomeController.php?action=home">
        <i class="fs-4 bi bi-arrow-left-square"
            data-bs-toggle="tooltip" data-bs-title="Default tooltip data-bs-title=" Voltar">
        </i>

    </a>


    <div class="contLeft">

        <img src="/PFC/app/assets/ifsharePerfil.png" alt="">

        <div class="nomeUsuario">
            <h5>MEU NOME</h5>
        </div>

        <div class="bio">
            <p>Ai que eu não sei o que que eu não sei o que lá</p>
        </div>

        <div class="infos">
            <p>Postagens: 14</p>
        </div>

    </div>



    <div class="contRight">
        <h2 class="text-center">POSTAGENS DO USUÁRIO</h2>
    </div>



</div>


<?php
require_once(__DIR__ . "/../include/footer.php");
?>