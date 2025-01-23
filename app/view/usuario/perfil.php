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

    <div class="lightStatus">
        <svg id="svgLight" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightbulb" viewBox="0 0 16 16">
            <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a2 2 0 0 0-.453-.618A5.98 5.98 0 0 1 2 6m6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1" />
        </svg>
    </div>

    <div class="settings dropdown">
        <i class="bi bi-gear" data-bs-toggle="dropdown" aria-expanded="false"></i>

        <ul class="dropdown-menu settins-menu">
            <li><a class="dropdown-item" href="/PFC/app/controller/UsuarioController.php?action=editPerfil&id=<?= $idUsuario ?>"">Editar perfil</a></li>
            <li><a class=" dropdown-item" href="/PFC/app/controller/UsuarioController.php?action=editSenha&id=72">Alterar senha</a></li>
            <li><a class="dropdown-item" href="/PFC/app/controller/UsuarioController.php?action=editFotoPerfil&id=<?= $dados['usuario']->getId() ?>"">Alterar Foto de Perfil</a></li>
        </ul>
    </div>

    <div class="infoUser position-relative">


                    <div class="stats hidden stats-numberPosts text-center">
                        <span>28 Postagens</span>
                    </div>

                    <div class="stats hidden stats-numberComents">
                        <span>45 comentarios</span>
                    </div>

                    <div class="stats hidden stats-numberLikes">
                        <span>48 Curtidas</span>
                    </div>
                    <script>
                        document.querySelector('#svgLight').addEventListener('click', function() {
                            stats = document.querySelectorAll('.stats');
                            document.querySelector('.lightStatus').classList.toggle('active');

                            stats.forEach(stat => {
                                stat.classList.toggle('hidden');
                            })
                        });
                    </script>



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
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-view-list" viewBox="0 0 16 16">
                    <path d="M3 4.5h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM1 2a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 2m0 12a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 14" />
                </svg>
            </span>

        </a>


        <a class="curtidas <?= $isLikedPosts ?>" href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?= $dados['usuario']->getId(); ?>&likedPosts">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                </svg>
            </span>

        </a>



    </div>

    <?php
    if (isset($_GET['likedPosts'])):
    ?>

        <?php
        if (empty($dados['likedPosts'])) {
            echo "<h3 class='text-center w-100 mt-3'>Nenhuma postagem curtida.</h3>";
        }
        ?>

        <div class="postsUser">
            <section class="postagens" id="postagens">

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
        } else ?>
        <div class="postsUser">

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