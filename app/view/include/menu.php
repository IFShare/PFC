<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

if (isset($_SESSION[SESSAO_USUARIO_NOME_USUARIO]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME_USUARIO];

$TipoUsuario = $_SESSION[SESSAO_USUARIO_TIPO_USUARIO];
$idUsuario = $_SESSION[SESSAO_USUARIO_ID];

$isPerfil = (isset($_GET['action']) && $_GET['action'] === 'perfil') ? 'active' : '';
$isHome = (isset($_GET['action']) && $_GET['action'] === 'home') ? 'active' : '';
$isList = (isset($_GET['action']) && $_GET['action'] === 'list') ? 'active' : '';
$isListDenuncia = (isset($_GET['action']) && $_GET['action'] === 'listTotalDenunciaForEachPost') ? 'active' : '';

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/menu.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=logout" />

<div class="sidebar open" id="sidebar">

    <!-- Marca do site -->
    <div class="brand text-center" id="toggleSidebar">
        <img class="logo" id="logo" width="75%" src="/PFC/app/assets/logo.png" alt="">
    </div>

    <script>
        const logos = document.querySelectorAll('.logo');
        logos.forEach(logo => {
            logo.src = "/PFC/app/assets/logo-dark.png";
        });
    </script>

    <!-- Itens do menu -->
    <ul class="menu-list">
        <li>
            <a href="<?= HOME_PAGE ?>" class="menu-item <?= $isHome ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                </svg> <span class="item-sidebar" id="">Início</span>
            </a>
        </li>
        <?php if ($TipoUsuario == "ADM" || $TipoUsuario == "ESTUDANTE") : ?>
            <li data-bs-target="#postModal"
                data-bs-toggle="modal" class="menu-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                </svg> <span class="item-sidebar" id="createPost">Criar Postagem</span>
            </li>
        <?php endif; ?>
        <?php if ($TipoUsuario == "ADM") : ?>
            <li class="position-relative">
                <a href="<?= BASEURL ?>/controller/UsuarioController.php?action=list" class="menu-item <?= $isList ?>">
                    <?php if (isset($_SESSION["countUsersNaoVerificados"]) && $_SESSION["countUsersNaoVerificados"] >= 1) : ?>
                        <span class="notif translate-middle badge rounded-pill">
                            <?= $_SESSION["countUsersNaoVerificados"] ?>
                        </span>
                    <?php endif; ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c1.8 0 3.5-.2 5.3-.5c-76.3-55.1-99.8-141-103.1-200.2c-16.1-4.8-33.1-7.3-50.7-7.3l-91.4 0zm308.8-78.3l-120 48C358 277.4 352 286.2 352 296c0 63.3 25.9 168.8 134.8 214.2c5.9 2.5 12.6 2.5 18.5 0C614.1 464.8 640 359.3 640 296c0-9.8-6-18.6-15.1-22.3l-120-48c-5.7-2.3-12.1-2.3-17.8 0zM591.4 312c-3.9 50.7-27.2 116.7-95.4 149.7l0-187.8L591.4 312z" />
                    </svg>
                    <span class="item-sidebar" id="">Gerenciar Usuários</span>
                </a>
            </li>
            <li class="position-relative">
                <a href="<?= BASEURL ?>/controller/DenunciaController.php?action=listTotalDenunciaForEachPost" class="menu-item <?= $isListDenuncia ?>">
                    <?php if (isset($_SESSION["countDenunciasNaoVerificados"]) && $_SESSION["countDenunciasNaoVerificados"] >= 1) : ?>
                        <span class="notif translate-middle badge rounded-pill">
                            <?= $_SESSION["countDenunciasNaoVerificados"] ?>
                        </span>
                    <?php endif; ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path d="M64 32C64 14.3 49.7 0 32 0S0 14.3 0 32L0 64 0 368 0 480c0 17.7 14.3 32 32 32s32-14.3 32-32l0-128 64.3-16.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30l0-247.7c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L64 48l0-16z" />
                    </svg>
                    <span class="item-sidebar" id="">Denúncias</span>
                </a>
            </li>
        <?php endif; ?>
        <li>
            <a href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?= $idUsuario ?>" class="menu-item <?= $isPerfil ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                </svg> <span class="item-sidebar" id="">Perfil</span>
            </a>
        </li>
        <li id="logout-item">
            <a href="<?= LOGOUT_PAGE ?>" class="menu-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                </svg> <span class="item-sidebar">Sair</span>
            </a>
        </li>
    </ul>

    <div id="theme-switch" class="">

        <svg id="light" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="undefined">
            <path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z" />
        </svg>

        <svg id="darkMode" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="undefined">
            <path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z" />
        </svg>


    </div>

</div>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const sidebar = document.getElementById("sidebar");
        const toggleButton = document.getElementById("toggleSidebar");
        const container = document.getElementById("container");

        toggleButton.addEventListener("click", () => {
            sidebar.classList.toggle("closed");
            const isClosed = sidebar.classList.contains("closed");

            if (isClosed) {
                container.classList.remove("sidebar-open");
                container.classList.add("sidebar-closed");
            } else {
                container.classList.remove("sidebar-closed");
                container.classList.add("sidebar-open");
            }
        });
    });
</script>