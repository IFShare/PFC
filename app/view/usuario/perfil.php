<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/createPost.php");

$idUsuario = isset($_SESSION[SESSAO_USUARIO_ID]) ? $_SESSION[SESSAO_USUARIO_ID] : NULL;


?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/perfil.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/formPost.css">

<div class="sidebar-closed" id="container">

    <?php
    require_once(__DIR__ . "/../include/menu.php");
    ?>

    <div class="infoUser">

        <img src="https://s3.amazonaws.com/37assets/svn/765-default-avatar.png" alt="">

        <div class="nomeUsuario">
            <h5 class="mb-1"><?php echo $dados['usuario']->getNomeSobrenome(); ?></h5>
            <div class="d-flex justify-content-center">
                <p class="me-2 text-center text-body-secondary mb-0 fw-medium"><?php echo $dados['usuario']->getNomeUsuario(); ?></p>
                <a href="/PFC/app/controller/UsuarioController.php?action=editPerfil&id=<?= $idUsuario ?>">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </div>
        </div>

        <?php
        if (!empty($dados['usuario']->getBio())):
        ?>
            <div class="bio">
                <p class="mb-0">
                    <?php echo $dados['usuario']->getBio(); ?>
                </p>
            </div>

        <?php
        endif;
        ?>


    </div>



    <div class="postsUser">
        <section class="postagens">

            <?php foreach ($dados['postagens'] as $posts): ?>
                <div class="post" id="post-<?php echo $posts->getId() ?>">
                    <a href="<?= BASEURL ?>/controller/PostagemController.php?action=viewPost&id=<?= $posts->getId() ?>&idPerfil=<?= $dados['usuario']->getId() ?>">
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