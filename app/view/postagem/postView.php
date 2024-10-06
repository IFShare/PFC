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
                    class="imgPost"
                    src="/PFC/arquivos/<?= $dados["postagem"]->getImagem(); ?>"
                    alt="Imagem da postagem">

                <a class="voltar"
                    href="<?= HOME_PAGE ?>">Voltar
                </a>


                <a class="excluir"
                    onclick="return confirm('Confirma a exclusão da postagem?');"
                    href="<?= BASEURL ?>/controller/PostagemController.php?action=delPost&id=<?= $dados["postagem"]->getId() ?>">
                    Excluir
                </a>

            </div>


            <p id="legenda">
                <?php
                echo $dados["postagem"]->getLegenda();
                ?>
            </p>

        </div>

        <div class="postRight">

            <div class="comentarios">

                <h3>Comentários</h3>

            </div>

        </div>

    </div>






</div>