<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFShare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=verified" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=send" />
    <link rel="shortcut icon" href="/PFC/app/assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/PFC/app/view/css/index.css">
</head>

<body>

    <link rel="stylesheet" href="<?= BASEURL ?>/view/css/form.css">

    <div class="container-fluid form-container h-100">
        <div class="row h-100 d-flex justify-content-center align-items-center"> <!-- 100% da altura da tela -->

            <div class="col-md-6 p-0 d-flex flex-column justify-content-center align-items-center info-container">
                <img class="mb-2" src="/PFC/app/assets/logo.png" alt="Foto logo IFSHARE" class="logo">

                <button type="submit" form="formUsuario" class="btn btn-custom">CRIAR CONTA</button>
                <div>
                    <a class="btn mt-2 voltar"
                        href="<?= HOME_PAGE ?>">
                        <i class="fs-4 bi bi-arrow-left-square"></i></a>
                </div>
            </div>


            <div class="col-md-6 p-0 d-flex justify-content-center align-items-center">
                <div class="row w-75 mt-5">
                    <!-- h2 class="mb-4 text-center">Cadastro</h2> -->

                    <form
                        method="POST"
                        id="formUsuario"
                        action="<?= BASEURL ?>/controller/LoginController.php?action=saveCadastro"
                        enctype="multipart/form-data">

                        <!-- Nome e sobrenome -->
                        <div class="form-group mb-3">
                            <label for="txtNomeSobrenome" class="form-label">
                                <?php
                                if (isset($msgErro['nomeSobrenome'])) {
                                    echo "<p class='mb-0 label-invalid fw-bold'>" . $msgErro['nomeSobrenome'] . "</p>";
                                } elseif ((isset($dados["usuario"]) ? $dados["usuario"]->getNomeSobrenome() : '')) {
                                    echo "<p class='mb-0 form-label label-valid'>" . (isset($dados["usuario"]) ? "<i class='fa-solid fa-check'></i> Nome válido" : '') . "</p>";
                                } else {
                                    echo "<p class='mb-0 form-label'>Nome e sobrenome</p>";
                                }
                                ?>
                            </label>
                            <input
                                placeholder="Insira seu nome e sobrenome." onfocus="this.placeholder=''" ; onblur="this.placeholder='Insira seu nome e sobrenome.'" ;
                                type="text"
                                class="form-control <?php echo isset($msgErro['nomeSobrenome']) ? 'error' : ''; ?>"
                                id="txtNomeSobrenome"
                                name="nomeSobrenome"
                                value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNomeSobrenome() : ''); ?>" />
                        </div>

                        <!-- Nome de usuário -->
                        <div class="form-group mb-3">
                            <label for="txtNomeUsuario" class="form-label">
                                <?php
                                if (isset($msgErro['nomeUsuario'])) {
                                    echo "<p class='mb-0 label-invalid fw-bold'>" . $msgErro['nomeUsuario'] . "</p>";
                                } elseif ((isset($dados["usuario"]) ? $dados["usuario"]->getNomeUsuario() : '')) {
                                    echo "<p class='mb-0 form-label label-valid'>" . (isset($dados["usuario"]) ? "<i class='fa-solid fa-check'></i> Nome de usuário válido" : '') . "</p>";
                                } else {
                                    echo "<p class='mb-0 form-label'>Nome de usuário</p>";
                                }
                                ?>
                            </label>
                            <input
                                placeholder="Insira seu nome de usuário." onfocus="this.placeholder=''" ; onblur="this.placeholder='Insira seu nome de usuário.'" ;
                                type="text"
                                class="form-control <?php echo isset($msgErro['nomeUsuario']) ? 'error' : ''; ?>"
                                id="txtNomeUsuario"
                                name="nomeUsuario"
                                value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNomeUsuario() : ''); ?>" />
                        </div>

                        <!-- E-mail -->
                        <div class="form-group mb-3">
                            <label for="txtEmail" class="form-label">
                                <?php
                                if (isset($msgErro['email'])) {
                                    echo "<p class='mb-0 label-invalid fw-bold'>" . $msgErro['email'] . "</p>";
                                } elseif ((isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : '')) {
                                    echo "<p class='mb-0 form-label label-valid'>" . (isset($dados["usuario"]) ? "<i class='fa-solid fa-check'></i> E-mail válido" : '') . "</p>";
                                } else {
                                    echo "<p class='mb-0 form-label'>E-mail</p>";
                                }
                                ?>
                            </label>
                            <input
                                placeholder="Insira seu e-mail." onfocus="this.placeholder=''" ; onblur="this.placeholder='Insira seu e-mail.'" ;
                                type="email"
                                class="form-control <?php echo isset($msgErro['email']) ? 'error' : ''; ?>"
                                id="txtEmail"
                                name="email"
                                value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : ''); ?>" />
                        </div>

                        <!-- Senha -->
                        <div class="form-group mb-3">
                            <label for="txtSenha" class="form-label">
                                <?php
                                if (isset($msgErro['senha'])) {
                                    echo "<p class='mb-0 label-invalid fw-bold'>" . $msgErro['senha'] . "</p>";
                                } elseif ((isset($dados["usuario"]) ? "<i class='fa-solid fa-check'></i>" : '')) {
                                    echo "<p class='mb-0 form-label label-valid'><i class='fa-solid fa-check'></i> Senha válida</p>";
                                } else {
                                    echo "<p class='mb-0 form-label'>Senha</p>";
                                }
                                ?>
                            </label>
                            <input
                                placeholder="Insira sua senha." onfocus="this.placeholder=''" ; onblur="this.placeholder='Insira sua senha.'" ;
                                type="password"
                                class="form-control <?php echo isset($msgErro['senha']) ? 'error' : ''; ?>"
                                id="txtSenha"
                                name="senha"
                                value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : ''); ?>" />

                        </div>

                        <!-- Senha -->
                        <div class="form-group mb-3">
                            <?php
                            if (isset($msgErro['isEstudante'])) {
                                echo "<h5 class='mb-2 label-invalid fw-bold'>" . $msgErro['isEstudante'] . "</h5>";
                            } else {
                                echo "<h5 class='mb-2 form-label'>Selecione uma das opções abaixo:</h5>";
                            }
                            ?>
                            <div class="studentRadio">
                                <input name="isEstudante" value="SIM" <?php echo (isset($dados["usuario"]) && $dados['usuario']->getIsEstudante() == 'SIM' ? 'checked' : ''); ?> type="radio" class="btn-check" id="isStudent" autocomplete="off">
                                <label onclick="ShowCompMatricula()" class="isStudent" for="isStudent">Sou estudante do IFPR</label>

                                <input name="isEstudante" value="NAO" <?php echo (isset($dados["usuario"]) && $dados['usuario']->getIsEstudante() == 'NAO' ? 'checked' : ''); ?> type="radio" class="btn-check" id="notStudent" autocomplete="off">
                                <label onclick="CloseCompMatricula()" class="notStudent" for="notStudent">Não sou estudante do IFPR</label>
                            </div>
                        </div>


                        <?php
                        if (isset($msgErro['compMatricula'])) {
                            echo "<h5 class='mb-2 label-invalid fw-bold'>" . $msgErro['compMatricula'] . "</h5>";
                        }
                        ?>
                        <div class="form-group mb-3">

                            <input accept=".pdf"
                                style="display: none;"
                                id="compMatricula"
                                type="file"
                                name="compMatricula"
                                onchange="showFileName()">

                            <label style="display: none;" id="compMatriculaLabel" for="compMatricula" class="custom-file-upload">
                                Comprovante de Matrícula
                            </label>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script src="/PFC/app/view/js/cadastro.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ece9031cab.js" crossorigin="anonymous"></script>
</body>

</html>