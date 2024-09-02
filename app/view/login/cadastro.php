<?php
require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">

<div class="container-fluid form-container">
    <div class="row h-100 d-flex flex-column justify-content-center align-items-center"> <!-- 100% da altura da tela -->

        <div class="col-md-4 d-flex flex-column justify-content-center align-items-center info-container">
            <h1 class="display-4 font-abril title-ifshare">IFSHARE</h1>
            <h2 class="h4">Crie sua conta</h2>
            <p class="lead">Conecte-se com todos os IF's</p>

            <button type="submit" form="formUsuario" class="btn btn-custom">Cadastrar</button>
            <div>
                <a class="btn btn-secondary mt-2"
                    href="<?= BASEURL ?>/controller/HomeController.php?action=home">Voltar</a>
            </div>
        </div>


        <div class="col-md-4 d-flex justify-content-center align-items-center">
            <div class="row w-75 mt-5">
                <!-- h2 class="mb-4 text-center">Cadastro</h2> -->

                <form method="POST" id="formUsuario"
                action="<?= BASEURL ?>/controller/UsuarioController.php?action=save">
                    <!-- Nome e sobrenome -->
                    <div class="mb-3">
                        <label for="txtNomeSobrenome" class="form-label">Nome e sobrenome</label>
                        <input type="text" class="form-control" id="txtNomeSobrenome" name="nomeSobrenome" value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNomeSobrenome() : ''); ?>" />
                    </div>

                    <!-- Nome de usuário -->
                    <div class="mb-3">
                        <label for="txtNomeUsuario" class="form-label">Nome de usuário</label>
                        <input type="text" class="form-control" id="txtNomeUsuario" name="nomeUsuario" value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNomeUsuario() : ''); ?>" />
                    </div>

                    <!-- E-mail -->
                    <div class="mb-3">
                        <label for="txtEmail" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="txtEmail" name="email" value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : ''); ?>" />
                    </div>

                    <!-- Senha -->
                    <div class="mb-3">
                        <label for="txtSenha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="txtSenha" name="senha" value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : ''); ?>" />
                    </div>

                    <input type="hidden" id="hddId" name="id" value="<?= $dados['id']; ?>" />

                </form>
            </div>

            </div>

            <div class="col-md-3 d-flex justify-content-center align-items-center">
                <?php require_once(__DIR__ . "/../include/msg.php"); ?>
            </div>

        

    </div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>