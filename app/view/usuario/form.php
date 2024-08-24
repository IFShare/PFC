<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/formCSS.html");

?>


<div class="container-fluid form-container">
    <div class="row h-100"> <!-- 100% da altura da tela -->

        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center info-container">
            <h1 class="display-4 font-abril title-ifshare">IFSHARE</h1>
            <h2 class="h4">Crie sua conta</h2>
            <p class="lead">Conecte-se com todos os IF's</p>

            <form method="POST" id="formUsuario"
                action="<?= BASEURL ?>/controller/UsuarioController.php?action=save">

                <button type="submit" class="btn btn-custom">Criar</button>
                <div class="col-12">
                    <a class="btn btn-secondary"
                        href="<?= BASEURL ?>/controller/HomeController.php?action=home">Voltar</a>
                </div>
                <input type="hidden" id="hddId" name="id" value="<?= $dados['id']; ?>" />

        </div>


        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="w-75 mt-5">
                <!-- h2 class="mb-4 text-center">Cadastro</h2> -->
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

                <!-- Tipo de usuário -->
                <div class="mb-3">
                    <label for="selTipoUsuario" class="form-label">Tipo de usuário</label>
                    <select class="form-select" name="tipoUsuario" id="selTipoUsuario">
                        <option value="">Selecione o papel</option>
                        <?php foreach ($dados["tipoUsuario"] as $tipoUsuario) : ?>
                            <option value="<?= $tipoUsuario ?>" <?php
                                                                if (isset($dados["usuario"]) && $dados["usuario"]->getTipoUsuario() == $tipoUsuario)
                                                                    echo "selected";
                                                                ?>>
                                <?= $tipoUsuario ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                </form>
            </div>

            <div class="col-6">
                <?php require_once(__DIR__ . "/../include/msg.php"); ?>
            </div>

        </div>

    </div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>