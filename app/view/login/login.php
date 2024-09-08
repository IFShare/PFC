<?php
# Nome do arquivo: login.php
# Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/login.css">

<div class="container form-container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="form-content text-center">
        <!-- Título "IFSHARE" centralizado -->
        <h1 class="font-abril title-ifshare mb-2">IFSHARE</h1>

        <!-- Texto do formulário centralizado -->
        <h4 class="texto-login">Informe os dados para logar:</h4>

        <!-- Formulário de Login -->
        <form id="frmLogin" action="./LoginController.php?action=logon" method="POST" class="text-start">
        <div class="mb-3">
    <label for="txtEmail" class="form-label">
        <?php
        if (isset($msgErro['emailLogin'])) {
            echo "<p class='text-danger'>" . $msgErro['emailLogin'] . "</p>";
        } else {
            echo "Email:";
        }
        ?>
    </label>
    <input type="text" class="form-control <?php echo isset($msgErro['emailLogin']) ? 'error' : ''; ?>" name="email" id="txtEmail"
           placeholder="Informe o email"
           value="<?php echo isset($dados['email']) ? $dados['email'] : '' ?>" />        
</div>

<div class="mb-3">
    <label for="txtSenha" class="form-label">
        <?php
        if (isset($msgErro['senhaLogin'])) {
            echo "<p class='text-danger'>" . $msgErro['senhaLogin'] . "</p>";
        } else {
            echo "Senha:";
        }
        ?>
    </label>
    <input type="password" class="form-control <?php echo isset($msgErro['senhaLogin']) ? 'error' : ''; ?>" name="senha" id="txtSenha"
           placeholder="Informe a senha"
           value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>" />        
</div>

            <?php
    
            if(isset($msgErro['ambos'])) 
                echo $msgErro['ambos'];
            ?>

            <button type="submit" class="btn btn-custom w-100">Logar</button>
        </form>
    </div>
</div>

<?php
# Incluindo o footer
require_once(__DIR__ . "/../include/footer.php");
?>