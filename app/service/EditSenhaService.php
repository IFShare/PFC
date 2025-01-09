<?php

require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class EditSenhaService
{

    private $usuarioDAO;

    public function __construct()
    {
        $this->usuarioDAO = new UsuarioDAO();
    }

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Usuario $usuario, ?string $senhaNova, ?string $confirmSenha)
    {
        $erros = array();

        // Obter a senha do banco de dados
        $senhaBanco = $this->usuarioDAO->buscarSenhaPorId($usuario->getId());

        // Validar campos vazios
        if (!$usuario->getSenha()) {
            $erros['senhaAtual'] = "Preencha sua senha atual";
        } elseif (strlen($usuario->getSenha()) < 5) {
            $erros['senhaAtual'] = "A senha precisa ter pelo menos 5 caracteres";
        } elseif (!password_verify($usuario->getSenha(), $senhaBanco)) {
            $erros['senhaAtual'] = "Senha incorreta.";
        }

        if (! $senhaNova) {
            $erros['senhaNova'] = "Preencha sua nova senha";
        } elseif (strlen($senhaNova) < 5) {
            $erros['senhaNova'] = "A senha precisa ter pelo menos 5 caracteres";
        }

        if (! $confirmSenha) {
            $erros['confirmSenha'] = "Preencha a confirmação de senha";
        }

        if ($senhaNova && $confirmSenha && $senhaNova != $confirmSenha)
            $erros['confirmSenha'] = "A confirmação de senha não corresponde à nova senha. Por favor, verifique os campos.";

        return $erros;
    }
}
