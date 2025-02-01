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
    public function validarDados(Usuario $usuario, $compMatricula)
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

        if (! $usuario->getEmail())
            $erros['email'] = "Preecnha seu email";
        elseif (filter_var($usuario->getEmail(), FILTER_VALIDATE_EMAIL) === false)
            $erros['email'] = "Formato de email inválido!";
        elseif ($this->usuarioDAO->emailJaCadastrado($usuario->getEmail(), $usuario->getId())) // Verificação se o email já está cadastrado
            $erros['email'] = "Este e-mail já foi cadastrado.";



        if ($usuario->getId() == 0 && !$usuario->getSenha())
            $erros['senha'] = "Preecnha sua senha";
        elseif ($usuario->getId() == 0 && strlen($usuario->getSenha()) < 5)
            $erros['senha'] = "A senha precisa ter pelo menos 5 caracteres";

        if (strlen($usuario->getBio()) > 300) {
            $erros['bio'] = "Biografia muito grande";
        }


        if (! $usuario->getTipoUsuario())
            $erros['tipoUsuario'] = "Escolha o tipo de usuário";

        if (! $usuario && $usuario->getIsEstudante() == "SIM" && (!$compMatricula || !isset($compMatricula["size"]) || $compMatricula["size"] <= 0)) {
            $erros['compMatricula'] = "Escolha seu comprovante de matrícula";
        }

        if (! $usuario->getStatus()) {
            $erros['status'] = "Escolha um status para o usuário";
        }

        if (! $usuario->getIsEstudante())
            $erros['isEstudante'] = "Escolha uma das opções abaixo:";

        return $erros;
    }
}
