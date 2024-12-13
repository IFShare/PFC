<?php
require_once(__DIR__ . "/../include/header.php");

$usuario = $dados['usuario'];
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">

<div class="container-fluid form-container h-100">
    <a class="voltar"
        href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?php echo $usuario->getId(); ?>">
        <i class="fs-4 bi bi-arrow-left-square"></i>

    </a>
    <div class="row h-100 d-flex justify-content-center align-items-center"> <!-- 100% da altura da tela -->

        <div class="col-md-6 p-0 d-flex flex-column justify-content-center align-items-center info-container">
            <img src="/PFC/app/assets/logo.png" alt="">
            <h2 class="h4">
                <?php
                if (isset($msgErro["banco"])) {
                    echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro["banco"] . "</p>";
                } else {
                    echo "Editar perfil";
                }
                ?>
            </h2>

            <button type="submit" form="formUsuario" class="btn btn-custom">
                SALVAR
            </button>
        </div>


        <div class="col-md-6 p-0 d-flex justify-content-center align-items-center">
            <div class="row w-75 mt-5">
                <!-- h2 class="mb-4 text-center">Cadastro</h2> -->

                <form
                    id="formPost"
                    enctype="multipart/form-data" method="post"
                    action="<?= BASEURL ?>/controller/PostagemController.php?action=save">
                    <!-- Imagem -->
                    <div class="mb-2 preview">
                        <input hidden type="file" class="form-control" id="fileImg" name="imagem" accept="image/*" required>
                        <img id="imgPreview" src="" alt="Preview"">
                    </div>

                    <?php
                    if (isset($erros['imagem'])) {
                        echo $erros['imagem'];
                    }
                    ?>

                    <button type="submit" class="btn btn-custom">Publicar</button>

                    <input type="hidden" id="hddId" name="id" value="<?= $usuario->getId(); ?>" />

                </form>
            </div>

        </div>

    </div>

</div>

<script src="<?= BASEURL ?>/view/js/form.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>