<?php
#View para a home do sistema

require_once(__DIR__ . "/../include/header.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/post.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/pesquisaStyle.css">


<?php
require_once(__DIR__ . "/../include/menu.php");
$usuarioLogado = $dados['usuarioLogado'];
?>
<div class="container-posts sidebar-open" id="container">

    <?php
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

    <div class="topBar d-flex w-100">
        <div class="box-search d-flex">

            <input
                value="<?= $dados['dadoPesquisa'] ?>"
                id="pesquisar"
                placeholder="Pesquisar..."
                type="search"
                class="form-control">
            <button onclick="searchData();" class="btn btn-primary btn-search">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
            </button>

        </div>

        <div id="theme-switch" class="me-3">


            <svg id="light" xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 -960 960 960" width="35px" fill="undefined">
                <path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z" />
            </svg>

            <svg id="darkMode" xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 -960 960 960" width="35px" fill="undefined">
                <path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z" />
            </svg>


        </div>

        <a href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?= $usuarioLogado->getId() ?>">
            <img
                style="cursor: pointer;"
                class="fotoPerfil"
                src="<?php echo $usuarioLogado->getFotoPerfil() != null
                            ? "/PFC/arquivos/fotosPerfil/" . $usuarioLogado->getFotoPerfil()
                            : "https://s3.amazonaws.com/37assets/svn/765-default-avatar.png"; ?>"
                alt="Foto de Perfil">

        </a>

    </div>

    <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
        <section class="perfis">
            <?php if ($dados['listPerfis'] == NULL) {
                echo "<h4 class='mt-3'>Nenhum perfil encontrado!</h4>";
            } else ?>
            <h5 id="foundPfp">Perfis encontrados:</h5>
            <?php foreach ($dados['listPerfis'] as $perfil): ?>
                <div class="perfil d-flex">
                    <img
                        class="fotoPerfil" id="fotoPerfil"
                        src="/PFC/arquivos/fotosPerfil/<?= $perfil->getFotoPerfil(); ?>"
                        alt="Imagem do perfil">
                    <span id="nomeUsuario"><?= $perfil->getNomeUsuario();
                            if ($perfil->getId() == $_SESSION[SESSAO_USUARIO_ID]) echo " (você)" ?> </span>
                </div>
            <?php endforeach; ?>
        </section>

    <?php endif; ?>


    <?php if ($dados['listPosts'] == NULL) {
        echo "<h4 class='mt-2 mb-2'>Nenhuma postagem encontrada!</h4>";
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

    <script>
        const imgPost =
            document.querySelectorAll('.imgPost');

        imgPost.forEach((img) => {
            const setImageProperties = () => {
                img.style.opacity = 1;
                img.closest('.post').classList.remove('placeholder');
            };

            if (img.complete) {
                setImageProperties();
            } else {
                img.onload = setImageProperties();
            }

            img.onerror = function() {
                img.parentElement.style.backgroundColor = 'gray';
            };
        });
    </script>

    <a href="#">
        <div class="arrow-up" id="arrowUp">
            <i class="fa-solid fa-arrow-up"></i>
        </div>
    </a>

</div>

<script src="<?= BASEURL ?>/view/js/home.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>