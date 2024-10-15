<?php
require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/postView.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">


<div class="container">

    <a class="voltar"
        href="<?= HOME_PAGE ?>">
        <i class="fs-4 bi bi-arrow-left-square"
            data-bs-toggle="tooltip" data-bs-title="Default tooltip data-bs-title=" Voltar">
        </i>

    </a>

    <div class="postagem">

        <div class="postLeft">

            <div class="imgPost">

                <img
                    class="img"
                    src="/PFC/arquivos/<?= $dados["postagem"]->getImagem(); ?>"
                    alt="Imagem da postagem">



                <?php

                if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM"):

                ?>

                <?php
                endif
                ?>

            </div>

            <div class="heart">
                <a href="/PFC/app/controller/CurtidaController.php?action=likeDislike&idPostagem=<?= $dados["postagem"]->getId() ?>">
                    <i class="fa-solid fa-heart"></i>
                </a>
                <span id="likes">0 likes</span>
            </div>

        </div>

        <div class="postRight">

            <div class="nomeUsuario">
                <h6> <?php echo $dados["usuario"]; ?> </h6>
            </div>

            <p id="legenda">
                <?php
                echo $dados["postagem"]->getLegenda();
                ?>
            </p>

            <a class="excluir"
                onclick="return confirm('Confirma a exclusão da postagem?');"
                href="<?= BASEURL ?>/controller/PostagemController.php?action=delPost&id=<?= $dados["postagem"]->getId() ?>">
                Excluir
            </a>

        </div>

    </div>






</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var legenda = document.getElementById('legenda');

        // Verifica se o conteúdo da legenda é maior que a altura da div
        if (legenda.scrollHeight > legenda.clientHeight) {
            // Habilita o scroll e aplica os estilos
            legenda.style.overflowY = 'scroll';

            // Adiciona os estilos de barra de rolagem
            legenda.classList.add('scroll-styles');
        }
    });
</script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>