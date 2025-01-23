<?php
require_once(__DIR__ . "/../include/header.php");

$usuario = $dados['usuario'];
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/perfil.css">

<div class="container-fluid form-container h-100">
    <a class="voltar"
        href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?php echo $usuario->getId(); ?>">
        <i class="fs-4 bi bi-arrow-left-square"></i>

    </a>
    <div class="row h-100 d-flex justify-content-center align-items-center"> <!-- 100% da altura da tela -->

        <div class="col-md-6 p-0 d-flex flex-column justify-content-center align-items-center info-container">
            <img src="/PFC/app/assets/logo.png" class="logo">
            <h2 class="h4">
                <?php
                if (isset($msgErro["banco"])) {
                    echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro["banco"] . "</p>";
                } else {
                    echo "Editar perfil";
                }
                ?>
            </h2>

            <button type="submit" form="formFotoPerfil" class="btn btn-custom">
                SALVAR
            </button>
        </div>


        <div class="col-md-6 p-0 d-flex justify-content-center align-items-center">
            <div class="row w-75 mt-5">
                <!-- h2 class="mb-4 text-center">Cadastro</h2> -->

                <form
                    id="formFotoPerfil"
                    enctype="multipart/form-data" method="post"
                    action="<?= BASEURL ?>/controller/UsuarioController.php?action=saveFotoPerfil">
                    <!-- Imagem -->
                    <div class="preview">
                        <input hidden type="file" class="form-control" id="fileImg" name="imagem" accept="image/*" required>
                        <img
                            id="imgPreview"
                            style="cursor: pointer;"
                            class="fotoPerfil-form"
                            src="<?php echo $usuario->getFotoPerfil() != null
                                        ? "/PFC/arquivos/fotosPerfil/" . $usuario->getFotoPerfil()
                                        : "https://s3.amazonaws.com/37assets/svn/765-default-avatar.png"; ?>"
                            alt="Foto de Perfil">
                    </div>

                    <input type="hidden" id="hddId" name="id" value="<?= $usuario->getId(); ?>" />

                </form>
            </div>

        </div>

    </div>

</div>

<script src="<?= BASEURL ?>/view/js/imgPreview.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>