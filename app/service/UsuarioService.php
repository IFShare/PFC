<?php

require_once(__DIR__ . "/../model/Usuario.php");

class UsuarioService
{

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Usuario $usuario)
    {
        $erros = array();

        //Validar campos vazios
        if (! $usuario->getNomeSobrenome())
            $erros['nomeSobrenome'] = "Preecnha seu nome e sobrenome";
        elseif (strlen($usuario->getNomeSobrenome()) <= 2)
            $erros['nomeSobrenome'] = "Isso é um nome?";

        if (! $usuario->getNomeUsuario())
            $erros['nomeUsuario'] = "Preecnha seu nome de usuário";

        if (! $usuario->getEmail())
            $erros['email'] = "Preecnha seu email";
        elseif (filter_var($usuario->getEmail(), FILTER_VALIDATE_EMAIL) === false) 
            $erros['email'] = "Formato de email inválido!";
                

        if (! $usuario->getSenha())
            $erros['senha'] = "Preecnha sua senha";

        if (! $usuario->getTipoUsuario())
            $erros['tipoUsuario'] = "Escolha o tipo de usuário";

        return $erros;
    }
}
