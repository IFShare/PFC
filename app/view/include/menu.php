<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

if (isset($_SESSION[SESSAO_USUARIO_NOME_USUARIO]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME_USUARIO];

$TipoUsuario = $_SESSION[SESSAO_USUARIO_TIPO_USUARIO];
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/menu.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=logout" />

<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <!-- Marca do site -->
        <a class="navbar-brand" href="#">IFSHARE</a>

        <!-- Botão "hambúrguer" para telas pequenas -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu principal -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Menu dropdown de ADM -->

                <?php
                if ($TipoUsuario == "ADM"):
                ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle position-relative" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ADM
                            <?php
                                if(isset($dados["countNaoVerificados"])  && $dados["countNaoVerificados"] >= 1):
                            ?>
                            <span class="notif translate-middle badge rounded-pill">
                                <?php
                                if (isset($dados["countNaoVerificados"]))
                                    echo $dados["countNaoVerificados"];
                                ?>
                            </span>

                            <?php
                                endif;
                            ?>
                            
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/PFC/app/controller/UsuarioController.php?action=create">Inserir novo usuário</a></li>

                            <li>
                                <a class="dropdown-item position-relative" href="<?= BASEURL . '/controller/UsuarioController.php?action=list' ?>">
                                    Listagem
                                    <?php
                                        if(isset($dados["countNaoVerificados"])  && $dados["countNaoVerificados"] >= 1):
                                    ?>
                                    <span class="notif translate-middle badge rounded-pill" id="notifList">
                                        <?php
                                        if (isset($dados["countNaoVerificados"]))
                                            echo $dados["countNaoVerificados"];
                                        ?>
                                    </span>
                                    
                                    <?php
                                        endif;
                                    ?>

                                </a>
                            </li>

                            <li><a class="dropdown-item" href="<?= BASEURL . '/controller/PostagemController.php?action=listPostsToDelete' ?>">Excluir postagem</a></li>
                        </ul>
                    </li>

                <?php
                endif;
                ?>
            </ul>

            <div class="log">
                <!-- Botão de sair -->
                <span id="nomeUsuario"><?= $nome ?></span>
                <a href="/PFC/app/controller/UsuarioController.php?action=perfil">
                    <i class="user bi bi-person-circle"></i>
                </a>
                <a class="nav-link" id="sair" href="<?= LOGOUT_PAGE ?>"><abbr title="Sair"><span class="material-symbols-outlined">
                            logout
                        </span></abbr></a>
            </div>
        </div>
    </div>
</nav>