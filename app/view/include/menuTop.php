<?php
$usuarioLogado = $_SESSION['usuarioLogado'];
$isHome = (isset($_GET['action']) && $_GET['action'] === 'home' && !isset($_GET['search'])) ? 'active' : '';
$isMostLiked = (isset($_GET['search']) && $_GET['search'] === 'MOSTLIKEDPOSTS') ? 'active' : '';
$isOldestPosts = (isset($_GET['search']) && $_GET['search'] === 'OLDESTPOSTS') ? 'active' : '';

$isMostLikedSelected = (isset($_GET['search']) && $_GET['search'] === 'MOSTLIKEDPOSTS') ? 'selected' : '';
$isOldestPostsSelected = (isset($_GET['search']) && $_GET['search'] === 'OLDESTPOSTS') ? 'selected' : '';

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
                        <option <?= $isOldestPostsSelected ?> class="<?= $isOldestPosts ?>" value="<?= HOME_PAGE ?>&search=OLDESTPOSTS">Mais antigos</option>
                        <option <?= $isMostLikedSelected ?> class="<?= $isMostLiked ?>" value="<?= HOME_PAGE ?>&search=MOSTLIKEDPOSTS">Mais curtidos</option>
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
                value="<?php
                        if ($dados['dadoPesquisa'] == "OLDESTPOSTS" || "MOSTLIKEDPOSTS")
                            echo "";
                        else echo $dados['dadoPesquisa'] ?>"
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

            <a href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?= $usuarioLogado->getId() ?>">
                <img
                    style="cursor: pointer;"
                    class="fotoPerfil"
                    id="fotoPerfil"
                    src="<?php echo $usuarioLogado->getFotoPerfil() != null
                                ? "/PFC/arquivos/fotosPerfil/" . $usuarioLogado->getFotoPerfil()
                                : "https://s3.amazonaws.com/37assets/svn/765-default-avatar.png"; ?>"
                    alt="Foto de Perfil">

            </a>
        </div>
    </div>
</div>