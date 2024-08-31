<?php
#Nome do arquivo: login/login.php
#Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/login.css">

<div class="container">
    <div class="row" style="margin-top: 20px;">
        <div class="col-12 coluna1">
            <h4>Fazer Login</h4>
            <br>

            <!-- Formulário de login -->
            <form id="frmLogin" action="./LoginController.php?action=logon" method="POST">
                <div class="form-group">
                    <label for="txtEmail">
                        <?php
                            if(isset($arrayMsg['emailLogin'])){
                                echo("<div class='alert alert-danger'>" . $arrayMsg['emailLogin'] . "</div>");
                            }else{
                                echo "Email:";
                            }
                        ?></label>
                    <input type="text" class="form-control" name="email" id="txtEmail"
                        placeholder="Informe o email"
                        value="<?php echo isset($dados['email']) ? $dados['email'] : '' ?>" />
                </div>

                <div class="form-group">
                    <label for="txtSenha"><?php
                            if(isset($arrayMsg['senhaLogin'])){
                                echo("<div class='alert alert-danger'>" . $arrayMsg['senhaLogin'] . "</div>");
                            }else{
                                echo "Email:";
                            }
                        ?></label>
                    <input type="password" class="form-control" name="senha" id="txtSenha"
                        placeholder="Informe a senha"
                        value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>" />
                </div>

                <button type="submit" class="btn btn-custom">Fazer login</button>

                <a href="/PFC/app/controller/UsuarioController.php?action=createCadastro" 
                   class="btn btn-custom">Cadastrar-se</a>
                
            </form>
            
        </div>

        <div class="row">

            <div class="col-12 coluna2">
                <?php include_once(__DIR__ . "/../include/msg.php") ?>
            </div>

        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>