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
            array_push($erros, "O campo [Nome e Sobrenome] é obrigatório.");

        if (! $usuario->getNomeUsuario())
            array_push($erros, "O campo [Nome de usuário] é obrigatório.");

        if (! $usuario->getEmail())
            array_push($erros, "O campo [E-mail] é obrigatório.");

        if (! $usuario->getSenha())
            array_push($erros, "O campo [Senha] é obrigatório.");

        if (! $usuario->getTipoUsuario())
            array_push($erros, "O campo [Tipo Usuário] é obrigatório.");


        return $erros;
    }
}
