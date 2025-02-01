<?php
#View para a home do sistema

require_once(__DIR__ . "/../include/header.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/post.css">

<?php
$usuarioLogado = $_SESSION['usuarioLogado'];
require_once(__DIR__ . "/../include/menu.php");
?>
<div class="container-posts sidebar-open position-relative" id="container">


    <?php
    require_once(__DIR__ . "/../include/menuTop.php");
    require_once(__DIR__ . "/../include/createPost.php");
    ?>

    <?php
    if (
        $usuarioLogado->getTipoUsuario() == "USUARIO" &&
        $usuarioLogado->getStatus() == "NAOVERIFICADO" &&
        !empty($usuarioLogado->getCompMatricula()) &&
        $_SESSION['login_naoverificado'] == true
    ):
    ?>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="myToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">IFShare</strong>
                    <button type="button" class="btn-close btn-success" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Olá, <?= $usuarioLogado->getNomeUsuario() ?>! 😊Sua declaração de matrícula está em análise!
                </div>
                <div class="mb-2 me-2 text-end">
                    <button type="button" class="btn btn-success btn-sm msgToast" data-bs-dismiss="toast">Entendi!</button>
                </div>
            </div>
        </div>

        <script>
            // Exibir o toast ao carregar a página
            document.addEventListener('DOMContentLoaded', () => {
                const myToastElement = document.getElementById('myToast');
                const myToast = new bootstrap.Toast(myToastElement, {
                    autohide: false // Desativa o fechamento automático
                });
                myToast.show();
            });
        </script>

    <?php
        $_SESSION['login_naoverificado'] = false;
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
                <?php if ($dados['listPerfis'] == NULL) {
                    echo "<h4 class='mt-3 textoSimples'>Nenhum perfil encontrado!</h4>";
                } else ?>
                <h5 id="foundPfp" class="textoSimples">Perfis encontrados:</h5>
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