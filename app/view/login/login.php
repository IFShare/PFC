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
</head>

<body>

    <link rel="stylesheet" href="<?= BASEURL ?>/view/css/login.css">

    <div class="container form-container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <a class="btn mt-2 voltar"
            href="<?= HOME_PAGE ?>">
            <i class="fs-4 bi bi-arrow-left-square"></i></a>

        <div class="form-content text-center">

            <!-- Título "IFSHARE" centralizado -->
            <img width="60%" src="/PFC/app/assets/logo.png" alt="Foto logo IFSHARE" class="logo">

            <?php
            // Exibe a mensagem de sucesso, se existir
            if (isset($_SESSION['mensagem_sucesso'])) {
                echo "<div class='alert alert-success'>" . $_SESSION['mensagem_sucesso'] . "</div>";
                unset($_SESSION['mensagem_sucesso']);
            } else {
                echo "<h4 class='texto-login'>Informe os dados para logar:</h4>";
            }
            ?>

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
                        placeholder="Informe seu email" onfocus="this.placeholder=''" ; onblur="this.placeholder='Insira seu email.'"
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
                    <div class="inp d-flex position-relative">
                        <input
                            type="password"
                            class="form-control <?php echo isset($msgErro['senhaLogin']) ? 'error' : ''; ?>"
                            name="senha"
                            id="txtSenha"
                            placeholder="Informe sua senha"
                            onfocus="this.placeholder=''" ;
                            onblur="this.placeholder='Insira sua senha.'"
                            value="" />
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                        </svg>
                        <svg id="eyeClose" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z" />
                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829" />
                            <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z" />
                        </svg>
                    </div>
                </div>

                <script>
                    const input = document.querySelector('#txtSenha');
                    const eyeOpen = document.querySelector('#eyeOpen');
                    const eyeClose = document.querySelector('#eyeClose');

                    eyeOpen.addEventListener('click', () => {
                        input.type = 'text';
                        eyeOpen.style.display = 'none';
                        eyeClose.style.display = 'block';
                    });

                    eyeClose.addEventListener('click', () => {
                        input.type = 'password';
                        eyeOpen.style.display = 'block';
                        eyeClose.style.display = 'none';
                    });
                </script>

                <?php

                if (isset($msgErro['emailSenhaErro']))
                    echo $msgErro['emailSenhaErro'];

                if (isset($msgErro['status']))
                    echo $msgErro['status'];
                ?>

                <button type="submit" class="btn btn-custom w-100">Logar</button>
            </form>

            <a href="<?= BASEURL ?>/controller/LoginController.php?action=createCadastro">Cadastrar-se</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ece9031cab.js" crossorigin="anonymous"></script>
</body>

</html>