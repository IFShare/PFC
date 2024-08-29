<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

$nome = "(Sessão expirada)";
if (isset($_SESSION[SESSAO_USUARIO_NOME_USUARIO]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME_USUARIO];
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= HOME_PAGE ?>">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= BASEURL . '/controller/UsuarioController.php?action=list' ?>" id="navbarDropdown"
                        role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> Listagem</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="<?= LOGOUT_PAGE ?>">Sair</a>
                </li>
            </ul>

            <ul class="navbar-nav mr-left">
                <li class="nav-item active"><?= $nome ?></li>
            </ul>
        </div>
    </nav>

