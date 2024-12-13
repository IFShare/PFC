<?php

require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class EditPerfilService
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
        elseif ($this->usuarioDAO->nomeUsuarioCadastrado($usuario->getNomeUsuario(), $usuario->getId())) // Verificação se o email já está cadastrado
            $erros['nomeUsuario'] = "Nome de usuário já em uso.";

        if (strlen($usuario->getBio()) > 45)
            $erros['bio'] = "Biografia muito grande";

        return $erros;
    }
}
