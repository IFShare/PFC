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

    <link rel="stylesheet" href="<?= BASEURL ?>/view/css/login.css">

    <div class="container form-container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <a class="btn mt-2 voltar"
            href="<?= HOME_PAGE ?>">
            <i class="fs-4 bi bi-arrow-left-square"></i></a>

        <div class="form-content text-center">
            <?php
            // Exibe a mensagem de sucesso, se existir
            if (isset($_SESSION['mensagem_sucesso']) && isset($_SESSION['nomeUsuario'])) {
                echo "<div class='alert alert-success'>" . $_SESSION['mensagem_sucesso'] . "</div>";
                unset($_SESSION['mensagem_sucesso']); // Remove a mensagem da sessão para exibir apenas uma vez
            }
            ?>
            <!-- Título "IFSHARE" centralizado -->
            <img width="60%" src="/PFC/app/assets/logo.png" alt="">

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
                    <input type="password" class="form-control <?php echo isset($msgErro['senhaLogin']) ? 'error' : ''; ?>" name="senha" id="txtSenha"
                        placeholder="Informe sua senha" onfocus="this.placeholder=''" ; onblur="this.placeholder='Insira sua senha.'"
                        value="" />
                </div>

                <?php

                if (isset($msgErro['ambos']))
                    echo $msgErro['ambos'];
                ?>

                <button type="submit" class="btn btn-custom w-100">Logar</button>
            </form>

            <a href="<?= BASEURL ?>/controller/LoginController.php?action=createCadastro">Cadastrar-se</a>
            <br>
            <a href="<?= BASEURL ?>/controller/LoginController.php?action=sendEmail">Esqueceu sua senha?</a>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ece9031cab.js" crossorigin="anonymous"></script>
</body>

</html>