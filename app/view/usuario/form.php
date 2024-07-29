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
</head>
<body>

    <form action="" method="POST" id="formUsuario">

    <!-- Nome e sobrenome -->
    
        <label for="txtNomeSobrenome">Nome e sobrenome</label>
        <br>
        <input 
        type="text" 
        id="txtNomeSobrenome" 
        name="nomeSobrenome">

        <br><br>
    
        
    <!-- Nome de usuário -->

        <label for="txtNomeUsuario">Nome de usuário</label>
        <br>
        <input type="text"
        id="txtNomeUsuario"
        name="nomeUsuario">

        <br><br>


    <!-- E-mail -->

        <label for="txtEmail">E-mail</label>
        <br>
        <input type="email"
        id="txtEmail"
        name="email">

        <br><br>


    <!-- Senha -->

        <label for="txtSenha">Senha</label>
        <br>
        <input type="password"
        id="txtSenha"
        name="senha">

        <br><br>

    <!-- Tipo de usuário -->

        <label for="txtTipoUsuario">Tipo de usuário</label>
        <br>
        <select name="tipoUsuario" id="selTipoUsuario">

            <option value=""></option>
            <option value="USUARIO">USUARIO</option>
            <option value="ESTUDANTE">ESTUDANTE</option>
            <option value="ADM">ADM</option>

        </select>

        <br><br>



        

    </form>
    
</body>
</html>