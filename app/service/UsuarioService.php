<?php

require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class UsuarioService
{

    private $usuarioDAO;

    public function __construct()
    {
        $this->usuarioDAO = new UsuarioDAO();
    }

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
        elseif (strpos($usuario->getNomeUsuario(), ' ') !== false)
            $erros['nomeUsuario'] = "O nome de usuário não pode conter espaços.";
        elseif ($this->usuarioDAO->nomeUsuarioCadastrado($usuario->getNomeUsuario(), 
                                                         $usuario->getId())) // Verificação se o email já está cadastrado
            $erros['nomeUsuario'] = "Nome de usuário já em uso.";

        if (! $usuario->getEmail())
            $erros['email'] = "Preecnha seu email";
        elseif (filter_var($usuario->getEmail(), FILTER_VALIDATE_EMAIL) === false)
            $erros['email'] = "Formato de email inválido!";
        elseif ($this->usuarioDAO->emailJaCadastrado($usuario->getEmail())) // Verificação se o email já está cadastrado
            $erros['email'] = "Este e-mail já foi cadastrado.";


        if (! $usuario->getSenha())
            $erros['senha'] = "Preecnha sua senha";
        elseif (strlen($usuario->getSenha()) <= 5)
            $erros['senhaCarac'] = "A senha precisa ter mais de 5 caracteres";

        if (! $usuario->getTipoUsuario())
            $erros['tipoUsuario'] = "Escolha o tipo de usuário";

        return $erros;
    }
}
