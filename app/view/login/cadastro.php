<?php
require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/cadastro.css">

<div class="container-fluid form-container h-100">
    <div class="row h-100 d-flex justify-content-center align-items-center"> <!-- 100% da altura da tela -->

        <div class="col-md-6 p-0 d-flex flex-column justify-content-center align-items-center info-container">
            <h1 class="display-4 font-abril title-ifshare">IFSHARE</h1>
            <h2 class="h4">Crie sua conta</h2>

            <button type="submit" form="formUsuario" class="btn btn-custom">Cadastrar</button>
            <div>
                <a class="btn btn-secondary mt-2"
                    href="<?= BASEURL ?>/controller/LoginController.php?action=login">Voltar</a>
            </div>
        </div>


        <div class="col-md-6 p-0 d-flex justify-content-center align-items-center">
            <div class="row w-75 mt-5">
                <!-- h2 class="mb-4 text-center">Cadastro</h2> -->

                <form method="POST" id="formUsuario"
                    action="<?= BASEURL ?>/controller/LoginController.php?action=saveCadastro">
                    <!-- Nome e sobrenome -->
                    <div class="form-group mb-3">
                        <label for="txtNomeSobrenome" class="form-label">
                            <?php
                            if (isset($msgErro['nomeSobrenome'])) {
                                echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro['nomeSobrenome'] . "</p>";
                            }
                            elseif((isset($dados["usuario"]) ? $dados["usuario"]->getNomeSobrenome() : '')){
                                echo "<p class='mb-0 fw-bold form-label label-valid'>" . (isset($dados["usuario"]) ? $dados["usuario"]->getNomeSobrenome() : '') . "</p>";
                            }
                             else {
                                echo "<p class='mb-0 form-label'>Nome e sobrenome</p>";
                            }
                            ?>
                        </label>
                        <input
                            placeholder="Insira seu nome e sobrenome." onfocus="this.placeholder=''"; onblur="this.placeholder='Insira seu nome e sobrenome.'";
                            type="text" 
                            class="form-control" 
                            id="txtNomeSobrenome" 
                            name="nomeSobrenome" 
                            value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNomeSobrenome() : ''); ?>" />
                    </div>

                    <!-- Nome de usuário -->
                    <div class="form-group mb-3">
                        <label for="txtNomeUsuario" class="form-label">
                        <?php
                            if (isset($msgErro['nomeUsuario'])) {
                                echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro['nomeUsuario'] . "</p>";
                            }
                            elseif((isset($dados["usuario"]) ? $dados["usuario"]->getNomeUsuario() : '')){
                                echo "<p class='mb-0 fw-bold form-label label-valid'>" . (isset($dados["usuario"]) ? $dados["usuario"]->getNomeUsuario() : '') . "</p>";
                            }
                             else {
                                echo "<p class='mb-0 form-label'>Nome de usuário</p>";
                            }
                            ?>
                        </label>
                        <input
                            placeholder="Insira seu nome de usuário." onfocus="this.placeholder=''"; onblur="this.placeholder='Insira seu nome de usuário.'";
                            type="text" 
                            class="form-control" 
                            id="txtNomeUsuario" 
                            name="nomeUsuario" 
                            value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNomeUsuario() : ''); ?>" />
                    </div>

                    <!-- E-mail -->
                    <div class="form-group mb-3">
                        <label for="txtEmail" class="form-label">
                        <?php
                            if (isset($msgErro['email'])) {
                                echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro['email'] . "</p>";
                            }
                            elseif((isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : '')){
                                echo "<p class='mb-0 fw-bold form-label label-valid'>" . (isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : '') . "</p>";
                            }
                             else {
                                echo "<p class='mb-0 form-label'>E-mail</p>";
                            }
                            ?>
                        </label>
                        <input
                            placeholder="Insira seu e-mail." onfocus="this.placeholder=''"; onblur="this.placeholder='Insira seu e-mail.'";
                            type="email" 
                            class="form-control" 
                            id="txtEmail" 
                            name="email" 
                            value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : ''); ?>" />
                    </div>

                    <!-- Senha -->
                    <div class="form-group mb-3">
                        <label for="txtSenha" class="form-label">
                        <?php
                            if (isset($msgErro['senha'])) {
                                echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro['senha'] . "</p>";
                            }
                            elseif((isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : '')){
                                echo "<p class='mb-0 fw-bold form-label label-valid'>Senha válida</p>";
                            }
                             else {
                                echo "<p class='mb-0 form-label'>Senha</p>";
                            }
                            ?>
                        </label>
                        <input
                            placeholder="Insira sua senha." onfocus="this.placeholder=''"; onblur="this.placeholder='Insira sua senha.'";
                            type="password" 
                            class="form-control" 
                            id="txtSenha" 
                            name="senha" 
                            value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : ''); ?>" />
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>