<?php
require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/postView.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">


<div class="container">

    <div class="postagem">

        <div class="postLeft">

            <div class="imgPost">

                <img
                    class="img"
                    src="/PFC/arquivos/<?= $dados["postagem"]->getImagem(); ?>"
                    alt="Imagem da postagem">


                <a class="voltar"
                    href="<?= HOME_PAGE ?>">
                    <i class="fs-4 bi bi-arrow-left-square"
                        data-bs-toggle="tooltip" data-bs-title="Default tooltip data-bs-title="Voltar">
                    </i>
                    
                </a>

                <?php

                if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM"):

                ?>



                    <a class="excluir"
                        onclick="return confirm('Confirma a exclusão da postagem?');"
                        href="<?= BASEURL ?>/controller/PostagemController.php?action=delPost&id=<?= $dados["postagem"]->getId() ?>">
                        Excluir
                    </a>

                <?php
                endif
                ?>

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

            <div class="comentarios">

                <h3>Comentários</h3>

            </div>

        </div>

    </div>






</div>