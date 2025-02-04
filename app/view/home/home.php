<?php
#View para a home do sistema

require_once(__DIR__ . "/../include/header.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/post.css">

<?php
require_once(__DIR__ . "/../include/menu.php");
?>
<div class="container-posts sidebar-open position-relative" id="container">


    <?php
    require_once(__DIR__ . "/../include/menuTop.php");
    require_once(__DIR__ . "/../include/createPost.php");
    ?>

    <?php
    if (isset($_SESSION['login_naoverificado'])  && $_SESSION['login_naoverificado'] == true):
    ?>

        <?php
        require_once(__DIR__ . "/../include/msgToast.php");
        ?>

    <?php
        unset($_SESSION['login_naoverificado']);
    endif;
    ?>

    <?php
    if (
        isset($_GET['search']) && !empty($_GET['search'])
        && $_GET['search'] === "MOSTLIKEDPOSTS"
    ):
    ?>

        <h2 class="mt-2 mb-2 textoSimples">Postagens mais curtidas:</h2>

    <?php
    elseif (
        isset($_GET['search']) && !empty($_GET['search'])
        && $_GET['search'] === "OLDESTPOSTS"
    ):
    ?>

        <h2 class="mt-2 mb-2 textoSimples">Postagens mais antigas:</h2>

    <?php
    else:
    ?>


        <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
            <section class="perfis">
                <?php if ($dados['listPerfis'] == NULL):
                ?>
                    <h4 class='mt-3 textoSimples'>Nenhum perfil encontrado!</h4>
                <?php
                else: ?>
                    <h5 id="foundPfp" class="textoSimples">Perfis encontrados:</h5>
                <?php endif ?>
                <?php foreach ($dados['listPerfis'] as $perfil): ?>

                    <?php
                    if ($perfil->getId() == $_SESSION[SESSAO_USUARIO_ID]):
                    ?>
                        <a style="color: white;" class="text-decoration-none" href="/PFC/app/controller/UsuarioController.php?action=perfilUsuario">

                        <?php
                    else:
                        ?>

                            <a style="color: white;" class="text-decoration-none" href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?= $perfil->getId() ?>">

                            <?php
                        endif;
                            ?>

                            <div class="perfil d-flex">
                                <img
                                    class="fotoPerfilTop" id="fotoPerfil"
                                    src="/PFC/arquivos/fotosPerfil/<?= $perfil->getFotoPerfil(); ?>"
                                    alt="Imagem do perfil">
                                <span id="nomeUsuario"><?= $perfil->getNomeUsuario();
                                                        if ($perfil->getId() == $_SESSION[SESSAO_USUARIO_ID]) echo " (você)" ?> </span>
                            </div>
                            </a>
                        <?php endforeach; ?>
            </section>

        <?php endif; ?>
    <?php endif; ?>




    <?php if ($dados['listPosts'] == NULL) {
        echo "<h4 class='mt-2 mb-2 textoSimples'>Nenhuma postagem encontrada!</h4>";
    } else ?>
    <section class="postagens">
        <?php foreach ($dados['listPosts'] as $posts): ?>
            <div class="post placeholder" id="post-<?php echo $posts->getId() ?>">
                <a href="<?= BASEURL ?>/controller/PostagemController.php?action=viewPost&id=<?= $posts->getId() ?>">
                    <img
                        loading="lazy"
                        class="imgPost" id="imgPost"
                        src="/PFC/arquivos/imgs/<?= $posts->getImagem(); ?>"
                        alt="Imagem da postagem">
                </a>
            </div>

        <?php endforeach; ?>

    </section>

    <a href="#">
        <div class="arrow-up" id="arrowUp">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                <path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
            </svg>
        </div>
    </a>

</div>

<script src="<?= BASEURL ?>/view/js/home.js"></script>
<script src="<?= BASEURL ?>/view/js/postagens.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>