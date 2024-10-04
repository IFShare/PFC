<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ESTUDANTE" || $_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM"): ?>

    <link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">

    <div class="container-fluid form-container">
        <div class="row d-flex justify-content-center align-items-center text-center">
            <div class="form-content text-center">
                <h1 class="display-4 font-abril title-ifshare">IFSHARE</h1>
                <h2 class="h4 subtitle-ifshare">Compartilhe suas ideias</h2>

                <form method="POST" id="formPost" enctype="multipart/form-data"
                    action="<?= BASEURL ?>/controller/PostagemController.php?action=save">

                    <form method="POST" id="formPost" enctype="multipart/form-data" action="<?= BASEURL ?>/controller/PostagemController.php?action=save">

                        <!-- IMAGEM -->
                        <div class="mb-3 img-container">
                            <div class="img">
                                <img src="/PFC/app/assets/Clique.png" alt="" id="img">
                            </div>

                            <?php if (isset($msgErro['imagem'])) {
                                echo "<p class='mb-0 fw-bold text-danger'>" . $msgErro['imagem'] . "</p>";
                            } ?>

                            <input type="file" class="form-control img-input" id="fileImg" name="imagem" accept="image/*" hidden />
                        </div>

                        <!-- LEGENDA -->
                        <div class="legend-container mb-3">
                            <textarea class="form-control" id="txtLegenda" name="legenda" rows="1" placeholder="Escreva algo sobre esta imagem..."></textarea>

                        </div>

                        <!-- Formulário com os botões -->
                        <div class="form-actions">
                            <!-- Botão Publicar -->
                            <button type="submit" form="formPost" class="btn btn-custom">Publicar</button>

                            <!-- Botão Voltar -->
                            <a class="btn btn-secondary btn-voltar" href="<?= BASEURL ?>/controller/HomeController.php?action=home">Voltar</a>
                        </div>

                    </form>


                    <script>
                        const txtLegenda = document.getElementById('txtLegenda');

                        // Função para ajustar a altura do textarea dinamicamente
                        function autoResize() {
                            this.style.height = 'auto'; // Reseta a altura antes de ajustar
                            this.style.height = (this.scrollHeight) + 'px'; // Ajusta a altura ao conteúdo
                        }

                        // Adiciona o evento de input para ajustar a altura conforme o usuário digita
                        txtLegenda.addEventListener('input', autoResize);

                        // Ajusta a altura ao carregar a página, caso já haja texto
                        window.addEventListener('load', function() {
                            if (txtLegenda.value) {
                                txtLegenda.style.height = txtLegenda.scrollHeight + 'px';
                            }
                        });
                    </script>


            </div>
        </div>
    </div>

    <script src="<?= BASEURL ?>/view/js/scriptImg.js"></script>

<?php
else:
    echo "Você não tem acesso a esta página.<br>";
endif; ?>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>