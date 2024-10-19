<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

$nome = "(Sessão expirada)";
if (isset($_SESSION[SESSAO_USUARIO_NOME_USUARIO]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME_USUARIO];

$TipoUsuario = $_SESSION[SESSAO_USUARIO_TIPO_USUARIO];
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/menu.css">



<nav class="navbar navbar-dark fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><?= $nome . " - " . $TipoUsuario ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= HOME_PAGE ?>">Home</a>
                    </li>

                    <?php

                    if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM"):

                    ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ADM
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="/PFC/app/controller/UsuarioController.php?action=create">Inserir novo usuário</a></li>
                                <li><a class="dropdown-item" href="<?= BASEURL . '/controller/UsuarioController.php?action=list' ?>">Listagem</a></li>
                                <li><a class="dropdown-item" href="<?= BASEURL . '/controller/UsuarioController.php?action=delPost' ?>">Excluir postagem</a></li>
                            </ul>
                        </li>


                            <?php
                        endif;
                            ?>


                        <li class="nav-item">
                            <a class="nav-link" href="<?= LOGOUT_PAGE ?>">Sair</a>
                        </li>
            </div>
        </div>
    </div>
</nav>