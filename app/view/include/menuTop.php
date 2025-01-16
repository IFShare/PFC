<?php
$usuarioLogado = $_SESSION['usuarioLogado'];
$isHome = (isset($_GET['action']) && $_GET['action'] === 'home' && !isset($_GET['search'])) ? 'active' : '';
$isMostLiked = (isset($_GET['search']) && $_GET['search'] === 'MOSTLIKEDPOSTS') ? 'active' : '';
$isOldestPosts = (isset($_GET['search']) && $_GET['search'] === 'OLDESTPOSTS') ? 'active' : '';

?>

<link rel="stylesheet" href="/PFC/app/view/css/menuTop.css">

<div class="topBar d-flex">
    <div class="boxTopBar">

        <div class="leftElements">
            <?php
            $action = $_GET['action'] ?? '';
            $naoVerificados = $dados['naoVerificados'] ?? 0;

            if ($action === 'list' || $action === 'listTotalDenunciaForEachPost'):
                if ($naoVerificados > 0):
                    $url = $action === 'list'
                        ? BASEURL . "/controller/UsuarioController.php?action=list&search=NAOVERIFICADO"
                        : BASEURL . "/controller/DenunciaController.php?action=listTotalDenunciaForEachPost&search=NAOVERIFICADO";
            ?>
                    <a class="naoVerificados" href="<?= $url ?>">
                        NÃO VERIFICADOS: <?= $naoVerificados ?>
                    </a>
                <?php
                endif;
            elseif ($action === 'home'):
                ?>
                <div class="filter-box">
                    <select id="selectFilter" class="selectFilter" aria-label="Default select example" onchange="filter(this.value)">
                        <option class="<?= $isHome ?>" value="<?= HOME_PAGE ?>">Mais recentes</option>
                        <option class="<?= $isOldestPosts ?>" value="<?= HOME_PAGE ?>&search=OLDESTPOSTS">Mais antigos</option>
                        <option class="<?= $isMostLiked ?>" value="<?= HOME_PAGE ?>&search=MOSTLIKEDPOSTS">Mais curtidos</option>
                    </select>
                </div>
                <script>
                    function filter(url) {
                        if (url) {
                            window.location.href = url;
                        }
                    }
                </script>
            <?php
            elseif ($action === 'listDenunciaByPost'):
            ?>
                <a class="voltar text-decoration-none gap-2" href="/PFC/app/controller/DenunciaController.php?action=listTotalDenunciaForEachPost">
                    <i class="fs-4 bi bi-arrow-left-square" data-bs-toggle="tooltip" data-bs-title="Voltar"></i>
                    Voltar
                </a>
            <?php
            endif;
            ?>
        </div>


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

        <div class="rightElements">

            <div id="theme-switch" class="">


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
    </div>
</div>