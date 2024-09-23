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
        <div class="offcanvas offcanvas-start text-bg-dark w-25" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
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
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL . '/controller/UsuarioController.php?action=list' ?>">Listagem</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/PFC/app/controller/UsuarioController.php?action=create">Inserir novo usuário</a>
                        </li>

                    <?php endif; ?>

                    <?php

                    if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM" || $_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ESTUDANTE"):

                    ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/PFC/app/controller/PostagemController.php?action=createPost">Adicionar postagem</a>
                        </li>

                    <?php endif; ?>


                    <li class="nav-item">
                        <a class="nav-link" href="<?= LOGOUT_PAGE ?>">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>