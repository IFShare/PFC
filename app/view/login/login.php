<?php
#Nome do arquivo: login/login.php
#Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/login.css">

<div class="container">
    <div class="col-12 coluna">

        <h3>Login</h3>
        <!-- Formulário de login -->
        <form id="frmLogin" action="./LoginController.php?action=logon" method="POST">
            <div class="form-group">
                <label for="txtEmail">

                    <?php
                    if (isset($msgErro['emailLogin'])) {
                        echo ("<div class='alert alert-danger'>" . $msgErro['emailLogin'] . "</div>");
                    } elseif (isset($msgErro['ambos'])) {
                        echo $msgErro['ambos'];
                    } else {
                        echo "Email:";
                    }
                    ?></label>
                <input type="text" class="form-control" name="email" id="txtEmail"
                    placeholder="Informe o email"
                    value="<?php echo isset($dados['email']) ? $dados['email'] : '' ?>" />
            </div>

            <div class="form-group">
                <label for="txtSenha">
                    <?php
                    if (isset($msgErro['senhaLogin'])) {
                        echo ("<div class='alert alert-danger'>" . $msgErro['senhaLogin'] . "</div>");
                    } else {
                        echo "Email:";
                    }
                    ?>
                </label>
                <input type="password" class="form-control" name="senha" id="txtSenha"
                    placeholder="Informe a senha" />
            </div>

            <button type="submit" class="btn btn-custom">Fazer login</button>

            <a href="/PFC/app/controller/UsuarioController.php?action=createCadastro"
                class="btn btn-custom">Cadastrar-se</a>

        </form>

    </div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>