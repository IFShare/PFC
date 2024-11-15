<?php
require_once(__DIR__ . "/../include/header.php");


if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM"): ?>

    <link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">

    <div class="container-fluid form-container h-100">
        <a class="voltar"
            href="http://localhost/PFC/app/controller/UsuarioController.php?action=list">
            <i class="fs-4 bi bi-arrow-left-square"
                data-bs-toggle="tooltip" data-bs-title="Default tooltip data-bs-title=" Voltar">
            </i>

        </a>
        <div class="row h-100 d-flex justify-content-center align-items-center"> <!-- 100% da altura da tela -->

            <div class="col-md-6 p-0 d-flex flex-column justify-content-center align-items-center info-container">
                <img src="/PFC/app/assets/logo.png" alt="">
                <h2 class="h4">
                    <?php
                    if (isset($msgErro["banco"])) {
                        echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro["banco"] . "</p>";
                    } else {
                        echo "Crie um novo usuário";
                    }
                    ?>
                </h2>

                <button type="submit" form="formUsuario" class="btn btn-custom">
                    <?php
                    if ($dados["id"] == 0) {
                        echo "CRIAR USUÁRIO";
                    } else {
                        echo "EDITAR USUÁRIO";
                    }
                    ?>
                </button>
            </div>


            <div class="col-md-6 p-0 d-flex justify-content-center align-items-center">
                <div class="row w-75 mt-5">
                    <!-- h2 class="mb-4 text-center">Cadastro</h2> -->

                    <form method="POST" id="formUsuario"
                        action="<?= BASEURL ?>/controller/UsuarioController.php?action=save">
                        <!-- Nome e sobrenome -->
                        <div class="form-group mb-3">
                            <label for="txtNomeSobrenome" class="form-label">
                                <?php
                                if (isset($msgErro['nomeSobrenome'])) {
                                    echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro['nomeSobrenome'] . "</p>";
                                } elseif ((isset($dados["usuario"]) ? $dados["usuario"]->getNomeSobrenome() : '')) {
                                    echo "<p class='mb-0 fw-bold form-label label-valid'>" . (isset($dados["usuario"]) ? "<i class='fa-solid fa-check'></i> Nome válido" : '') . "</p>";
                                } else {
                                    echo "<p class='mb-0 form-label'>Nome e sobrenome</p>";
                                }
                                ?>
                            </label>
                            <input
                                placeholder="Insira seu nome e sobrenome." onfocus="this.placeholder=''" ; onblur="this.placeholder='Insira seu nome e sobrenome.'" ;
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
                                } elseif ((isset($dados["usuario"]) ? $dados["usuario"]->getNomeUsuario() : '')) {
                                    echo "<p class='mb-0 fw-bold form-label label-valid'>" . (isset($dados["usuario"]) ? "<i class='fa-solid fa-check'></i> Nome de usuário válido" : '') . "</p>";
                                } else {
                                    echo "<p class='mb-0 form-label'>Nome de usuário</p>";
                                }
                                ?>
                            </label>
                            <input
                                placeholder="Insira seu nome de usuário." onfocus="this.placeholder=''" ; onblur="this.placeholder='Insira seu nome de usuário.'" ;
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
                                } elseif ((isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : '')) {
                                    echo "<p class='mb-0 fw-bold form-label label-valid'>" . (isset($dados["usuario"]) ? "<i class='fa-solid fa-check'></i> E-mail válido" : '') . "</p>";
                                } else {
                                    echo "<p class='mb-0 form-label'>E-mail</p>";
                                }
                                ?>
                            </label>
                            <input
                                placeholder="Insira seu e-mail." onfocus="this.placeholder=''" ; onblur="this.placeholder='Insira seu e-mail.'" ;
                                type="email"
                                class="form-control"
                                id="txtEmail"
                                name="email"
                                value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : ''); ?>" />
                        </div>

                        <?php
                        if ($dados["id"] == 0):
                        ?>
                            <!-- Senha -->
                            <div class="form-group mb-3">
                                <label for="txtSenha" class="form-label">
                                    <?php
                                    if (isset($msgErro['senha'])) {
                                        echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro['senha'] . "</p>";
                                    } elseif ((isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : '')) {
                                        echo "<p class='mb-0 fw-bold form-label label-valid'><i class='fa-solid fa-check'></i> Senha válida</p>";
                                    } else {
                                        echo "<p class='mb-0 form-label'>Senha</p>";
                                    }
                                    ?>
                                </label>
                                <input
                                    placeholder="Insira sua senha." onfocus="this.placeholder=''" ; onblur="this.placeholder='Insira sua senha.'" ;
                                    type="password"
                                    class="form-control"
                                    id="txtSenha"
                                    name="senha"
                                    value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : ''); ?>" />
                            </div>

                        <?php
                        endif;
                        ?>

                        <!-- Tipo de usuário -->
                        <div class="mb-3">
                            <label for="selTipoUsuario" class="form-label">
                                <?php
                                if (isset($msgErro['tipoUsuario'])) {
                                    echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro['tipoUsuario'] . "</p>";
                                } elseif ((isset($dados["usuario"]) ? $dados["usuario"]->getTipoUsuario() : '')) {
                                    echo "<p class='mb-0 fw-bold form-label label-valid'>" . (isset($dados["usuario"]) ? $dados["usuario"]->getTipoUsuario() : '') . "</p>";
                                } else {
                                    echo "<p class='mb-0 form-label'>Tipo de usuário</p>";
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

                        <div class="mb-3">
                            <label for="selStatus" class="form-label">
                                <?php
                                if (isset($msgErro['status'])) {
                                    echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro['status'] . "</p>";
                                } elseif ((isset($dados["usuario"]) ? $dados["usuario"]->getStatus() : '')) {
                                    echo "<p class='mb-0 fw-bold form-label label-valid'>" . (isset($dados["usuario"]) ? $dados["usuario"]->getStatus() : '') . "</p>";
                                } else {
                                    echo "<p class='mb-0 form-label'>Status do usuário</p>";
                                }
                                ?>
                            </label>
                            <select class="form-select" name="status" id="selStatus">
                                <option value="">Selecione o status do usuáro</option>
                                <?php foreach ($dados["status"] as $status) : ?>
                                    <option value="<?= $status ?>" <?php
                                                                        if (isset($dados["usuario"]) && $dados["usuario"]->getStatus() == $status)
                                                                            echo "selected";
                                                                        ?>>
                                        <?= $status ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="selIsEstudante" class="form-label">
                                <?php
                                if (isset($msgErro['isEstudante'])) {
                                    echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro['isEstudante'] . "</p>";
                                } elseif ((isset($dados["usuario"]) ? $dados["usuario"]->getIsEstudante() : '')) {
                                    echo "<p class='mb-0 fw-bold form-label label-valid'>" . (isset($dados["usuario"]) ? $dados["usuario"]->getIsEstudante() : '') . "</p>";
                                } else {
                                    echo "<p class='mb-0 form-label'>Status do usuário</p>";
                                }
                                ?>
                            </label>
                            <select class="form-select" name="isEstudante" id="selIsEstudante">
                                <option value="">Selecione se o usuário é estudante do IFPR</option>
                                <?php foreach ($dados["isEstudante"] as $isEstudante) : ?>
                                    <option value="<?= $isEstudante ?>" <?php
                                                                        if (isset($dados["usuario"]) && $dados["usuario"]->getIsEstudante() == $isEstudante)
                                                                            echo "selected";
                                                                        ?>>
                                        <?= $isEstudante ?>
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

<script src="<?= BASEURL ?>/view/js/form.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>