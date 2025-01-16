<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/createPost.php");

$idUsuario = isset($_SESSION[SESSAO_USUARIO_ID]) ? $_SESSION[SESSAO_USUARIO_ID] : NULL;
$usuario = $dados['usuario'];

$isLikedPosts = (isset($_GET['likedPosts'])) ? 'active' : '';
$isPostsList = (!isset($_GET['likedPosts'])) ? 'active' : '';

?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/perfil.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/formPost.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/theme-mode.css">

<div class="sidebar-open position-relative" id="container">

    <?php
    require_once(__DIR__ . "/../include/menu.php");
    ?>

    <div class="settings dropdown">
        <i class="bi bi-gear" data-bs-toggle="dropdown" aria-expanded="false"></i>

        <ul class="dropdown-menu settins-menu">
            <li><a class="dropdown-item" href="/PFC/app/controller/UsuarioController.php?action=editPerfil&id=<?= $idUsuario ?>"">Editar perfil</a></li>
            <li><a class=" dropdown-item" href="/PFC/app/controller/UsuarioController.php?action=editSenha&id=72">Alterar senha</a></li>
            <li><a class="dropdown-item" href="/PFC/app/controller/UsuarioController.php?action=editFotoPerfil&id=<?= $dados['usuario']->getId() ?>"">Alterar Foto de Perfil</a></li>
        </ul>
    </div>

    <div class=" infoUser">

                    <div class="fotoPerfil">
                        <img
                            data-bs-toggle="modal"
                            data-bs-target="#perfilModal"
                            style="cursor: pointer;"
                            class="fotoPerfil"
                            src="<?php echo $usuario->getFotoPerfil() != null
                                        ? "/PFC/arquivos/fotosPerfil/" . $usuario->getFotoPerfil()
                                        : "https://s3.amazonaws.com/37assets/svn/765-default-avatar.png"; ?>"
                            alt="Foto de Perfil">
                    </div>

                    <div class="nomePf">
                        <h5 class="mb-1"><?php echo $dados['usuario']->getNomeSobrenome(); ?></h5>
                        <div class="d-flex justify-content-center">
                            <p class="me-2 text-center text-body-secondary mb-0 fw-medium nomeUsuarioPf"><?php echo $dados['usuario']->getNomeUsuario(); ?></p>
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

    <!-- Modal para Foto de Perfil -->
    <div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="perfilModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btnOpt">
                        <a href="/PFC/app/controller/UsuarioController.php?action=editFotoPerfil&id=<?= $dados['usuario']->getId() ?>">
                            Alterar Foto de Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="selectTypeList">

        <a class="curtidas <?= $isPostsList ?>" href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?= $dados['usuario']->getId(); ?>">
            <span>
                Posts
            </span>

        </a>


        <a class="curtidas <?= $isLikedPosts ?>" href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?= $dados['usuario']->getId(); ?>&likedPosts">
            <span>
                Curtidas
            </span>

        </a>



    </div>

    <?php
    if (isset($_GET['likedPosts'])):
    ?>

        <?php
        if (empty($dados['postagens'])) {
            echo "<h3 class='text-center w-100 mt-3'>Nenhuma postagem curtida.</h3>";
        }
        ?>

        <div class="postsUser">
            <section class="postagens">

                <?php foreach ($dados['likedPosts'] as $curtidas): ?>
                    <div class="post" id="post-<?php echo $curtidas['idPostagem'] ?>">
                        <a href="<?= BASEURL ?>/controller/PostagemController.php?action=viewPost&id=<?= $curtidas['idPostagem'] ?>&idPerfil=<?= $dados['usuario']->getId() ?>">
                            <img
                                class="imgPost" id="imgPost"
                                src="/PFC/arquivos/imgs/<?= $curtidas['imagem'] ?>"
                                alt="Imagem da postagem">
                        </a>
                    </div>

                <?php endforeach; ?>

            </section>

        </div>

    <?php
    else:
    ?>

        <?php
        if (empty($dados['postagens'])) {
            echo "<h3 class='text-center w-100 mt-3'>Nenhuma postagem realizada.</h3>";
        }
        ?>
        <div class="postsUser">

            <?php if ($dados['postagens'] == NULL) {
                echo "<h4 class='mt-2 mb-2 textoSimples'>Nenhuma postagem encontrada!</h4>";
            } else ?>
            <section class="postagens">
                <?php foreach ($dados['postagens'] as $posts): ?>
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
        </div>

    <?php
    endif;
    ?>

</div>

<script src="<?= BASEURL ?>/view/js/postagens.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>