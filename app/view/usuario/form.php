<?php
require_once(__DIR__ . "/../include/header.php");



if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM"): ?>

    <link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">

    <div class="container-fluid form-container h-100">
        <div class="row h-100 d-flex justify-content-center align-items-center"> <!-- 100% da altura da tela -->

            <div class="col-md-6 p-0 d-flex flex-column justify-content-center align-items-center info-container">
                <h1 class="display-4 font-abril title-ifshare">IFSHARE</h1>
                <h2 class="h4">Crie sua conta</h2>
                <p class="lead">Conecte-se com todos os IF's</p>

                <button type="submit" form="formUsuario" class="btn btn-custom">Criar</button>
                <div>
                    <a class="btn btn-secondary mt-2"
                        href="<?= BASEURL ?>/controller/HomeController.php?action=home">Voltar</a>
                </div>
            </div>


            <div class="col-md-6 p-0 d-flex justify-content-center align-items-center">
                <div class="row w-75 mt-5">
                    <!-- h2 class="mb-4 text-center">Cadastro</h2> -->

                    <form method="POST" id="formUsuario"
                        action="<?= BASEURL ?>/controller/UsuarioController.php?action=save">
                        <!-- Nome e sobrenome -->
                        <div class="mb-3">
                            <label for="txtNomeSobrenome" class="form-label">
                                <?php
                                if (isset($msgErro['nomeSobrenome'])) {
                                    echo "<p class='mb-0 fw-bold text-danger'>" . $msgErro['nomeSobrenome'] . "</p>";
                                }else {
                                    echo "Nome e sobrenome";
                                }
                                ?>
                            </label>
                            <input placeholder="Insira o nome e sobrenome do usuário"
                                type="text" class="form-control" id="txtNomeSobrenome" name="nomeSobrenome" value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNomeSobrenome() : ''); ?>" />
                        </div>

                        <!-- Nome de usuário -->
                        <div class="mb-3">
                            <label for="txtNomeUsuario" class="form-label">
                                <?php
                                if (isset($msgErro['nomeUsuario'])) {
                                    echo "<p class='mb-0 fw-bold text-danger'>" . $msgErro['nomeUsuario'] . "</p>";
                                } else {
                                    echo "Nome de usuário";
                                }
                                ?>
                            </label>
                            <input placeholder="Insira o nome de usuário"
                                type="text" class="form-control" id="txtNomeUsuario" name="nomeUsuario" value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNomeUsuario() : ''); ?>" />
                        </div>

                        <!-- E-mail -->
                        <div class="mb-3">
                            <label for="txtEmail" class="form-label">
                                <?php
                                if (isset($msgErro['email'])) {
                                    echo "<p class='mb-0 fw-bold text-danger'>" . $msgErro['email'] . "</p>";
                                } else {
                                    echo "E-mail";
                                }
                                ?>

                            </label>
                            <input placeholder="Insira o email do usuário"
                                type="email" class="form-control" id="txtEmail" name="email" value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : ''); ?>" />
                        </div>

                        <!-- Senha -->
                        <div class="mb-3">
                            <label for="txtSenha" class="form-label">
                                <?php
                                if (isset($msgErro['senha'])) {
                                    echo "<p class='mb-0 fw-bold text-danger'>" . $msgErro['senha'] . "</p>";
                                } else {
                                    echo "Senha";
                                }
                                ?>
                            </label>
                            <input placeholder="Insira a senha do usuário"
                                type="password" class="form-control" id="txtSenha" name="senha" value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : ''); ?>" />
                        </div>

                        <!-- Tipo de usuário -->
                        <div class="mb-3">
                            <label for="selTipoUsuario" class="form-label">
                                <?php
                                if (isset($msgErro['tipoUsuario'])) {
                                    echo "<p class='mb-0 fw-bold text-danger'>" . $msgErro['tipoUsuario'] . "</p>";
                                } else {
                                    echo "Tipo de Usuário";
                                }
                                ?>
                            </label>
                            <select class="form-select" name="tipoUsuario" id="selTipoUsuario">
                                <option value="">Selecione o tipo de usuáro</option>
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

                        <input type="hidden" id="hddId" name="id" value="<?= $dados['id']; ?>" />

                    </form>
                </div>

            </div>

        </div>

    </div>

<?php
else:
    echo "Você não tem acesso a esta página.<br>";
?>
<?php endif; ?>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>