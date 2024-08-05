<?php
    
    require_once(__DIR__ . "/../../connection/Connection.php");
    require_once(__DIR__ . "/../../controller/UsuarioController.php");

    $usuarioController = new UsuarioController();
    

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Form IFShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            background: linear-gradient(90deg, #81a880, #004f44);
        }
        .form-container {
            height: 100%; /* altr ctnr */
        }

        .font-abril {
            font-family: 'Abril Fatface', cursive; /* font */ 
        }

        .title-ifshare {
            font-size: 5rem; /* Tamanho da fonte maior */
            margin-bottom: 0; /* Espaçamento entre IFSHARE e Crie*/
            color: #000; /* Cor do ifshare */
        }
        
        .btn-custom {
            background-color: #004f44; /* cor de fundo*/
            color: black; /* cor do texto */
            border: none; /* remove borda padrao */
            border-radius: 30px; /* arredonda */
            padding: 5px 20px; /* espacamento interno */
            font-size: 18px; /* ajusta o tamanho e peso da fonte */
            font-weight: bold; /* II */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra pra dar porfundidade */
            transition: background-color 0.3s, transform 0.3s; /* transicao */
        }
        .btn-custom:hover {
            background-color: #81a880; /* cor com o mauser */
            transform: scale(1.05); /* aumenta o botao */
        }
        .form-control, .form-select {
            border-radius: 8px; /* Bordas arredondadas */
            border: 1px solid #000; /* Cor da borda */
            padding: 8px; /* Reduzir o padding interno para diminuir a altura */
            font-size: 14px; /* Diminuir o tamanho da fonte */
            line-height: 1.2; /* Reduzir o espaçamento entre linhas */
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1); /* Sombra interna */
            transition: border-color 0.3s, box-shadow 0.3s; /* Transição suave */
            height: 30px; /* Definir uma altura fixa */
            background-color: transparent; /* Cor de fundo para combinar com o site */
            color: #000; /* Cor do texto */
        }

        .form-control:focus, .form-select:focus {
            background-color: transparent; /* Manter o fundo transparente ao foco */
            border-color: #fff; /* Borda preta ao foco */
            outline: none; /* Remove o contorno padrão */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); /* Sombra externa ao foco */
        }

        .form-label {
            font-size: 16px; /* Tamanho da fonte */
            color: #000; /* Cor do texto */
            margin-bottom: 4px; /* Espaço abaixo do rótulo */
        }

    </style>


  </head>
 
  <body class="d-flex align-items-center">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <div class="container-fluid form-container">
        <div class="row h-100"> <!-- 100% da altura da tela -->

        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center info-container">
                <h1 class="display-4 font-abril title-ifshare">IFSHARE</h1>
                <h2 class="h4">Crie sua conta</h2>
                <p class="lead">Conecte-se com todos os IF's</p>
                <button type="submit" class="btn btn-custom">Criar</button>
                <!--button type="submit" class="btn btn-primary btn-block">Criar</button>
    -->
               
            </div>

           
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="w-75 mt-5">
                    <!-- h2 class="mb-4 text-center">Cadastro</h2> -->
                    <form action="" method="POST" id="formUsuario">
                        <!-- Nome e sobrenome -->
                        <div class="mb-3">
                            <label for="txtNomeSobrenome" class="form-label">Nome e sobrenome</label>
                            <input type="text" class="form-control" id="txtNomeSobrenome" name="nomeSobrenome">
                        </div>

                        <!-- Nome de usuário -->
                        <div class="mb-3">
                            <label for="txtNomeUsuario" class="form-label">Nome de usuário</label>
                            <input type="text" class="form-control" id="txtNomeUsuario" name="nomeUsuario">
                        </div>

                        <!-- E-mail -->
                        <div class="mb-3">
                            <label for="txtEmail" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="txtEmail" name="email">
                        </div>

                        <!-- Senha -->
                        <div class="mb-3">
                            <label for="txtSenha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="txtSenha" name="senha">
                        </div>

                        <!-- Tipo de usuário -->
                        <div class="mb-3">
                            <label for="selTipoUsuario" class="form-label">Tipo de usuário</label>
                            <select class="form-select" name="tipoUsuario" id="selTipoUsuario">
                                <option value=""></option>
                                <option value="USUARIO">USUARIO</option>
                                <option value="ESTUDANTE">ESTUDANTE</option>
                                <option value="ADM">ADM</option>
                            </select>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


        

    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        </div>
    </div>
</div>

</body>
</html>

*/
