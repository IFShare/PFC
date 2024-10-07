<?php
#View para a home do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/post.css">


<div class="row mt-4 justify-content-center w-100">
    <div class="col-4 textCentral">
        <h1 class="text-center fw-bold">IFSHARE</h1>

    </div>

</div>

<div class="row justify-content-center align-items-center w-100">
    <div class="col-3 d-flex justify-content-center align-items-center">

        <?php
        if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM" || $_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ESTUDANTE"):

        ?>

            <button
                data-bs-target="#postModal"
                data-bs-toggle="modal"
                class="btn btn-custom justify-content-center mt-3">
                Inserir nova postagem
            </button>

        <?php endif; ?>

    </div>
</div>

<!-- Modal de Inserção de Postagem -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
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


<div class="container">

    <section class="postagens">

        <?php foreach ($dados['listPosts'] as $posts): ?>
            <div class="post">
                <a
                    href="<?= BASEURL ?>/controller/PostagemController.php?action=viewPost&id=<?= $posts->getId() ?>">
                    <img
                        class="imgPost"
                        src="/PFC/arquivos/<?= $posts->getImagem(); ?>"
                        alt="Imagem da postagem">
                </a>

            </div>

        <?php endforeach; ?>

    </section>

    <script src="<?= BASEURL ?>/view/js/scriptImg.js"></script>

    <?php
    require_once(__DIR__ . "/../include/footer.php");
    ?>