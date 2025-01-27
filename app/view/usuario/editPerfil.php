<?php
require_once(__DIR__ . "/../include/header.php");

$usuario = $dados['usuario'];
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">

<div class="container-fluid form-container h-100">
    <a class="voltar"
        href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?php echo $usuario->getId(); ?>">
        <i class="fs-4 bi bi-arrow-left-square"></i>

    </a>
    <div class="row h-100 d-flex justify-content-center align-items-center"> <!-- 100% da altura da tela -->

        <div class="col-md-6 p-0 d-flex flex-column justify-content-center align-items-center info-container">
            <img class="logo" src="/PFC/app/assets/logo.png" class="logo">
            <h2 class="h4">
                <?php
                if (isset($msgErro["banco"])) {
                    echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro["banco"] . "</p>";
                } else {
                    echo "Editar perfil";
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
                    action="<?= BASEURL ?>/controller/UsuarioController.php?action=savePerfil">
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

                    <div class="form-group mb-3">
                        <label for="txtBio" class="form-label">
                            <?php
                            if (isset($msgErro['bio'])) {
                                echo "<p class='mb-0 fw-bold label-invalid'>" . $msgErro['bio'] . "</p>";
                            } elseif ((isset($dados["usuario"]) ? $dados["usuario"]->getBio() : '')) {
                                echo "<p class='mb-0 fw-bold form-label label-valid'>" . (isset($dados["usuario"]) ? "<i class='fa-solid fa-check'></i> Biografia válida" : '') . "</p>";
                            } else {
                                echo "<p class='mb-0 form-label'>Biografia</p>";
                            }
                            ?>
                        </label>
                        <textarea
                            placeholder="Insira uma biografia para o seu perfil." 
                            onfocus="this.placeholder=''"; 
                            onblur="this.placeholder='Insira uma biografia para o seu perfil.'";
                            class="form-control"
                            id="txtBio"
                            name="bio">
                            <?php echo (isset($dados["usuario"]) ? htmlspecialchars($dados["usuario"]->getBio()) : ''); ?>
                        </textarea>
                    </div>

                    <input type="hidden" id="hddId" name="id" value="<?= $usuario->getId(); ?>" />

                </form>
            </div>

        </div>

    </div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>