<?php
require_once(__DIR__ . "/../include/header.php");

?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/perfil.css">

<div class="container">

    <?php
    require_once(__DIR__ . "/../include/menu.php");
    ?>

    <div class="infoUser">

        <img src="/PFC/app/assets/ifsharePerfil.png" alt="">

        <div class="nomeUsuario">
            <h5 class="mb-1"><?php echo $dados['usuario']->getNomeSobrenome(); ?></h5>
            <p class="text-center text-body-secondary mb-0 fw-medium"><?php echo $dados['usuario']->getNomeUsuario(); ?></p>
        </div>

        <!--
         <div class="bio">
            <p><?php //echo $dados['usuario']->getBio(); 
                ?></p>
        </div>
        -->


    </div>



    <div class="postsUser">
        <section class="postagens">

            <div class="post">
                <button class="p-0">
                    <div class="addPost">
                        <span>+</span>
                    </div>
                </button>
            </div>

            <?php foreach ($dados['postagens'] as $posts): ?>
                <div class="post" id="post-<?php echo $posts->getId() ?>">
                    <a href="<?= BASEURL ?>/controller/PostagemController.php?action=viewPost&id=<?= $posts->getId() ?>">
                        <img
                            class="imgPost" id="imgPost"
                            src="/PFC/arquivos/imgs/<?= $posts->getImagem(); ?>"
                            alt="Imagem da postagem">
                    </a>
                </div>

            <?php endforeach; ?>

        </section>
    </div>

</div>


<?php
require_once(__DIR__ . "/../include/footer.php");
?>