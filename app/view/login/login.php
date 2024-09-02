<?php
# Nome do arquivo: login.php
# Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../include/header.php");
?>

<div class="container form-container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="form-content text-center">
        <!-- Título "IFSHARE" centralizado -->
        <h1 class="font-abril title-ifshare mb-4">IFSHARE</h1>

        <!-- Texto do formulário centralizado -->
        <h4 class="mb-4">Informe os dados para logar:</h4>

        <!-- Formulário de Login -->
        <form id="frmLogin" action="./LoginController.php?action=logon" method="POST" class="text-start">
            <div class="mb-3">
                <label for="txtEmail" class="form-label">Email:</label>
                <input type="text" class="form-control" name="email" id="txtEmail"
                       placeholder="Informe o email"
                       value="<?php echo isset($dados['email']) ? $dados['email'] : '' ?>" />        
            </div>

            <div class="mb-3">
                <label for="txtSenha" class="form-label">Senha:</label>
                <input type="password" class="form-control" name="senha" id="txtSenha"
                       placeholder="Informe a senha"
                       value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>" />        
            </div>

            <button type="submit" class="btn btn-custom w-100">Logar</button>
        </form>
        <?php include_once(__DIR__ . "/../include/msg.php") ?>
    </div>
</div>

<?php
# Incluindo o footer
require_once(__DIR__ . "/../include/footer.php");
?>
