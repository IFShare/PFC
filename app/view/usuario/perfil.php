<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/createPost.php");

$idUsuario = isset($_SESSION[SESSAO_USUARIO_ID]) ? $_SESSION[SESSAO_USUARIO_ID] : NULL;
$usuario = $dados['usuario'];

$isLikedPosts = (isset($_GET['likedPosts'])) ? 'active' : '';
$isPostsList = (!isset($_GET['likedPosts'])) ? 'active' : '';

?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/perfil.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/editFotoPerfil.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/formPost.css">

<div class="sidebar-open position-relative" id="container">

    <?php
    require_once(__DIR__ . "/../include/menu.php");
    ?>

    <div class="lightStatus">
        <svg id="svgLight" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightbulb" viewBox="0 0 16 16">
            <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a2 2 0 0 0-.453-.618A5.98 5.98 0 0 1 2 6m6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1" />
        </svg>
    </div>

    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'perfilUsuario'):
    ?>
        <div class="settings dropdown">
            <svg
                data-bs-toggle="dropdown"
                aria-expanded="false"
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />
                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />
            </svg>

            <ul class="dropdown-menu settings-menu">
                <li><a class="dropdown-item" href="/PFC/app/controller/UsuarioController.php?action=editPerfil&id=<?= $idUsuario ?>"">Editar perfil</a></li>
            <li><a class=" dropdown-item" href="/PFC/app/controller/UsuarioController.php?action=editSenha&id=72">Alterar senha</a></li>
            </ul>
        </div>
    <?php
    endif;
    ?>

    <script>
        const settingsIcon = document.querySelector('.settings svg');
        const settingsContainer = document.querySelector('.settings');

        settingsIcon.addEventListener('mouseenter', function() {
            settingsContainer.classList.add('active'); // Adiciona a classe
        });

        settingsIcon.addEventListener('mouseleave', function() {
            settingsContainer.classList.remove('active'); // Remove a classe
        });
    </script>

    <div class=" infoUser position-relative">


        <div class="fotoPerfil" id="fotoPerfil">
            <img

                <?php
                if (isset($_GET['action']) && $_GET['action'] == 'perfilUsuario'):
                ?>
                data-bs-toggle="modal"
                data-bs-target="#perfilModal"
                style="cursor: pointer;"
                <?php
                endif;
                ?>
                class="fotoPerfil"
                src="<?php echo $usuario->getFotoPerfil() != null
                            ? "/PFC/arquivos/fotosPerfil/" . $usuario->getFotoPerfil()
                            : "/PFC/arquivos/fotosPerfil/defaultPfp.png"; ?>"
                alt="Foto de Perfil">
        </div>

        <script>
            document.querySelector('#svgLight').addEventListener("click", function() {

                document.querySelector('#fotoPerfil').classList.toggle('active');
                document.querySelector('#svgLight').classList.toggle('active');

            })
        </script>

        <div class="nomePf">
            <h5 class="mb-1 position-relative"><?php echo $dados['usuario']->getNomeSobrenome(); ?>
                <?php
                if ($dados["usuario"]->getTipoUsuario() == "ADM"):
                ?>
                    <i class="bi bi-patch-check verificado" title="Este usuário é um ADM do sistema"></i>
                <?php endif ?>
            </h5>
            <div class="d-flex justify-content-center">
                <p class="me-2 text-center text-body-secondary mb-0 fw-medium nomeUsuarioPf"><?php echo $dados['usuario']->getNomeUsuario(); ?></p>
            </div>
        </div>

        <?php
        if (!empty($dados['usuario']->getBioHTML())):
        ?>
            <div class="bio">
                <p class="mb-0">
                    <?php echo $dados['usuario']->getBioHTML(); ?>
                </p>
            </div>

        <?php
        endif;
        ?>

        <span class="totalPosts">
            <strong><?= $dados['totalPostagens'] . "</strong>" . " publicações | " ?> <strong><?= $dados['totalCurtidas'] . "</strong> curtidas" ?>
        </span>


    </div>

    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'perfilUsuario'):
    ?>
        <!-- Modal de edição de foto de perfil -->
        <div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="postModalLabelNew" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content editFotoPerfil">
                    <div class="modal-body editFotoPerfil">
                        <h3>Foto de perfil</h3>
                        <form
                            id="formFotoPerfil"
                            enctype="multipart/form-data" method="post"
                            action="<?= BASEURL ?>/controller/UsuarioController.php?action=saveFotoPerfil">
                            <!-- Imagem -->
                            <div class="previewEditFotoPerfil">
                                <img
                                    id="imgPreviewEdit"
                                    class="fotoPerfilEdit-form"
                                    src="<?php echo $usuario->getFotoPerfil() != null
                                                ? "/PFC/arquivos/fotosPerfil/" . $usuario->getFotoPerfil()
                                                : "/PFC/arquivos/fotosPerfil/defaultPfp.png"; ?>"
                                    alt="Foto de Perfil">
                            </div>

                            <div class="nomeArquivo">
                                <label id="labelFileImg" for="fileImg">Escolha uma foto de perfil</label>
                                <input
                                    onchange="showFileName()"
                                    hidden
                                    type="file"
                                    class="form-control"
                                    id="fileImg"
                                    name="imagem"
                                    accept="image/*">
                            </div>

                            <input type="hidden" id="hddId" name="id" value="<?= $usuario->getId(); ?>" />

                        </form>
                        <button type="submit" form="formFotoPerfil" class="form-btn">
                            SALVAR
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <?php
    endif;
    ?>

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
    elseif($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] !== "USUARIO"):
    ?>


        <?php
        if (empty($dados['postagens'])):
        ?>

            <div class="noPostYet mt-4">
                <?php
                if ($usuario->getId() == $_SESSION[SESSAO_USUARIO_ID]) {

                ?>
                    <svg
                        style="cursor: pointer;"
                        data-bs-target="#postModalNew"
                        data-bs-toggle="modal" class="menu-item"
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z" />
                        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                    </svg>

                <?php
                    echo
                    "<h2>Compartilhar fotos</h2>";
                    echo "<p>Quando você compartilhar fotos, elas aparecerão no seu perfil.</p>";
                } else {
                ?>
                    <svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z" />
                        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                    </svg>
                    <h2>Ainda não há nenhuma publicação.</h2>
                <?php } ?>

            </div>


        <?php else: ?>
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

<?php
    endif;
?>

</div>


<script src="<?= BASEURL ?>/view/js/postagens.js"></script>

<script>
    // Atualiza a imagem de preview e o nome do arquivo
    document.getElementById('fileImg').addEventListener('change', function() {
        const fileInput = this; // Input do arquivo
        const imgPreview = document.getElementById('imgPreviewEdit'); // Elemento de preview
        const fileNameLabel = document.getElementById('labelFileImg'); // Label do nome do arquivo

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const reader = new FileReader();

            // Atualiza o preview da imagem
            reader.onload = function() {
                imgPreview.src = reader.result;
            };
            reader.readAsDataURL(file);

            // Exibe o nome do arquivo no label
            fileNameLabel.textContent = file.name;
        } else {
            // Se nenhum arquivo foi selecionado, reseta o nome no label
            fileNameLabel.textContent = 'Escolha uma foto de perfil';
        }
    });
</script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>