<?php
#View para a home do sistema

require_once(__DIR__ . "/../include/header.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/post.css">

<!--
<div class="row justify-content-center align-items-center w-100">
    <div class="col-3 d-flex justify-content-center align-items-center">

        <?php
        if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM" || $_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ESTUDANTE"):

        ?>


            <button
                data-bs-target="#postModal"
                data-bs-toggle="modal"
                class="justify-content-center btnInsert">
                <i class="bi bi-plus-circle"></i>
            </button>
            <span class="msgInsert">Realizar postagem</span>

        <?php endif; ?>

    </div>
</div>
        -->

<!-- Modal de Inserção de Postagem -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form
                    id="formPost"
                    enctype="multipart/form-data" method="post"
                    action="<?= BASEURL ?>/controller/PostagemController.php?action=save">
                    <!-- Imagem -->
                    <div class="mb-2 preview">
                        <input hidden type="file" class="form-control" id="fileImg" name="imagem" accept="image/*" required>
                        <img id="imgPreview" src="/PFC/app/assets/Clique.png" alt="Preview"">
                    </div>

                    <!-- Legenda -->
                    <div class=" mb-1">
                        <label id="labelLegenda" for="txtLegenda" class="mb-1">Legenda</label>
                        <textarea class="form-control" id="txtLegenda" name="legenda" rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn btn-custom">Publicar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/menu.php");
?>
<div class="container-posts sidebar-closed" id="postsContainer">
    <div class="box-search d-flex">

        <input
            value=""
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
    <section class="postagens">

        <?php foreach ($dados['listPosts'] as $posts): ?>
            <div class="post" id="post-<?php echo $posts->getId() ?>">
                    <a href="<?= BASEURL ?>/controller/PostagemController.php?action=viewPost&id=<?= $posts->getId() ?>">
                        <img
                            class="imgPost" id="imgPost"
                            src="/PFC/arquivos/imgs/<?= $posts->getImagem(); ?>"
                            alt="Imagem da postagem">
                    </a>
            </div>

        <?php endforeach; ?>

    </section>

</div>


<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="<?= BASEURL ?>/view/js/home.js"></script>
<?php
require_once(__DIR__ . "/../include/footer.php");
?>