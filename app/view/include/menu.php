<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

if (isset($_SESSION[SESSAO_USUARIO_NOME_USUARIO]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME_USUARIO];

$TipoUsuario = $_SESSION[SESSAO_USUARIO_TIPO_USUARIO];
$idUsuario = $_SESSION[SESSAO_USUARIO_ID];

$isPerfil = (isset($_GET['action']) && $_GET['action'] === 'perfil') ? 'active' : '';
$isHome = (isset($_GET['action']) && $_GET['action'] === 'home') ? 'active' : '';

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/menu.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=logout" />

<div class="sidebar closed" id="sidebar">

    <!-- Marca do site -->
    <div class="brand text-center" id="toggleSidebar">
        <img id="logo" width="75%" src="/PFC/app/assets/logo.png" alt="">
    </div>

    <!-- Itens do menu -->
    <ul class="menu-list">
        <li>
            <a href="<?= HOME_PAGE ?>" class="menu-item <?= $isHome ?>">
                <i class="fas fa-home"></i>
                <span class="item-sidebar" id="">Início</span>
            </a>
        </li>
        <li data-bs-target="#postModal"
            data-bs-toggle="modal" class="menu-item">
            <i class="fas fa-plus-circle"></i>
            <span class="item-sidebar" id="createPost">Criar Postagem</span>
        </li>
        <?php if ($TipoUsuario == "ADM") : ?>
            <li class="position-relative">
                <a href="<?= BASEURL ?>/controller/UsuarioController.php?action=list" class="menu-item">
                    <?php if (isset($dados["countUsersNaoVerificados"]) && $dados["countUsersNaoVerificados"] >= 1) : ?>
                        <span class="notif translate-middle badge rounded-pill">
                            <?= $dados["countUsersNaoVerificados"] ?>
                        </span>
                    <?php endif; ?>
                    <i class="fas fa-user-shield"></i>
                    <span class="item-sidebar" id="">Gerenciar Usuários</span>
                </a>
            </li>
            <li class="position-relative">
                <a href="<?= BASEURL ?>/controller/DenunciaController.php?action=listDenuncias" class="menu-item">
                    <?php if (isset($dados["countDenunciasNaoVerificados"]) && $dados["countDenunciasNaoVerificados"] >= 1) : ?>
                        <span class="notif translate-middle badge rounded-pill">
                            <?= $dados["countDenunciasNaoVerificados"] ?>
                        </span>
                    <?php endif; ?>
                    <i class="fas fa-flag"></i>
                    <span class="item-sidebar" id="">Denúncias</span>
                </a>
            </li>
        <?php endif; ?>
        <li>
            <a href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?= $idUsuario ?>" class="menu-item <?= $isPerfil ?>">
                <i class="fas fa-user"></i>
                <span class="item-sidebar" id="">Perfil</span>
            </a>
        </li>
        <li id="logout-item">
            <a href="<?= LOGOUT_PAGE ?>" class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                <span class="item-sidebar" id="">Sair</span>
            </a>
        </li>
    </ul>
</div>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const menuSidebar = document.getElementById("menuSidebar");
        const menuToggle = document.getElementById("menuToggle");

        menuToggle.addEventListener("click", () => {
            menuSidebar.classList.toggle("closed");
        });
    });

    document.addEventListener("DOMContentLoaded", () => {
        const sidebar = document.getElementById("sidebar");
        const toggleButton = document.getElementById("toggleSidebar");
        const postsContainer = document.getElementById("postsContainer");

        toggleButton.addEventListener("click", () => {
            sidebar.classList.toggle("closed");
            const isClosed = sidebar.classList.contains("closed");

            if (isClosed) {
                postsContainer.classList.remove("sidebar-open");
                postsContainer.classList.add("sidebar-closed");
            } else {
                postsContainer.classList.remove("sidebar-closed");
                postsContainer.classList.add("sidebar-open");
            }
        });
    });
</script>