<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");



if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ESTUDANTE" || $_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM"): ?>

    <link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">

    <div class="container-fluid form-container h-100">
        <div class="row h-100 d-flex justify-content-center align-items-center"> <!-- 100% da altura da tela -->

            <div class="col-md-6 p-0 d-flex flex-column justify-content-center align-items-center info-container">
                <h1 class="display-4 font-abril title-ifshare">IFSHARE</h1>
                <h2 class="h4">Realizar postagem</h2>

                <button type="submit" form="formPost" class="btn btn-custom">Publicar</button>
                <div>
                    <a class="btn btn-secondary mt-2"
                        href="<?= BASEURL ?>/controller/HomeController.php?action=home">Voltar</a>
                </div>
            </div>


            <div class="col-md-6 p-0 d-flex justify-content-center align-items-center">
                <div class="row w-75 mt-5">
                    <!-- h2 class="mb-4 text-center">Cadastro</h2> -->

                    <form class="" method="POST" id="formPost" enctype="multipart/form-data"
                        action="<?= BASEURL ?>/controller/PostagemController.php?action=save">
                        <!-- IMAGEM -->
                        <div class="mb-3">

                            <div class="img">
                                <img src="/PFC/app/assets/escolha.png" alt="" id="img">
                            </div>

                            <?php
                                if (isset($msgErro['imagem'])) {
                                    echo "<p class='mb-0 fw-bold text-danger'>" . $msgErro['imagem'] . "</p>";
                                }
                                ?>

                            <input type="file" class="form-control" id="fileImg" name="imagem" accept="image/*" hidden />
                        </div>

                        <!-- LEGENDA -->
                        <div class="mb-3 legenda">
                            <textarea class="form-control" id="txtLegenda" name="legenda" rows="9" cols="50"></textarea>                        
                        </div>

                    </form>
                </div>

            </div>

        </div>

    </div>

    <script src="<?= BASEURL ?>/view/js/scriptImg.js"></script>

<?php

else:
    echo "Você não tem acesso a esta página.<br>";
?>
<?php endif; ?>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>