<?php
require_once(__DIR__ . "/../include/header.php");

?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">

<div class="container-fluid form-container h-100">
    <a class="voltar"
        href="/PFC/app/controller/UsuarioController.php?action=perfilUsuario">
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
                    echo "Editar senha";
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

                <form method="POST" id="formUsuario"
                    action="<?= BASEURL ?>/controller/UsuarioController.php?action=saveSenha">
                    <!-- Campo de senha atual -->
                    <div class="form-group mb-3">
                        <label for="txtSenhaAtual" class="form-label">
                            <?php
                            if (isset($msgErro['senhaAtual'])) {
                                echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro['senhaAtual'] . "</p>";
                            } else {
                                echo "<p class='mb-0 form-label'>Senha atual</p>";
                            }
                            ?>
                        </label>
                        <input
                            placeholder="Insira sua senha atual."
                            type="password"
                            class="form-control"
                            id="txtSenhaAtual"
                            name="senhaAtual" />
                    </div>

                    <!-- Campo de nova senha -->
                    <div class="form-group mb-3">
                        <label for="txtSenhaNova" class="form-label">
                            <?php
                            if (isset($msgErro['senhaNova'])) {
                                echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro['senhaNova'] . "</p>";
                            } else {
                                echo "<p class='mb-0 form-label'>Nova senha</p>";
                            }
                            ?>
                        </label>
                        <input
                            value="<?php echo (isset($dados["senhaNova"]) ? $dados["senhaNova"] : ''); ?>"
                            placeholder="Insira sua nova senha."
                            type="password"
                            class="form-control"
                            id="txtSenhaNova"
                            name="senhaNova" />
                    </div>

                    <!-- Campo de confirmação da nova senha -->
                    <div class="form-group mb-3">
                        <label for="txtConfirmSenha" class="form-label">
                            <?php
                            if (isset($msgErro['confirmSenha'])) {
                                echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro['confirmSenha'] . "</p>";
                            } else {
                                echo "<p class='mb-0 form-label'>Confirmação de senha</p>";
                            }
                            ?>
                        </label>
                        <input
                            value="<?php echo (isset($dados["confirmSenha"]) ? $dados["confirmSenha"] : ''); ?>"
                            placeholder="Confirme sua nova senha."
                            type="password"
                            class="form-control"
                            id="txtConfirmSenha"
                            name="confirmSenha" />
                    </div>


                    <input type="hidden" id="hddId" name="id" value="<?= $dados['usuario']->getId(); ?>" />

                </form>
            </div>

        </div>

    </div>

</div>

<script src="<?= BASEURL ?>/view/js/form.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>