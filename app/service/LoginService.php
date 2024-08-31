<?php
#Nome do arquivo: LoginService.php
#Objetivo: classe service para Login

require_once(__DIR__ . "/../model/Usuario.php");

class LoginService {

    public function validarCampos(?string $email, ?string $senha) {
        $arrayMsg = array();

        //Valida o campo email
        if(! $email)
            ($arrayMsg['emailLogin'] = "O campo [Email] é obrigatório.");

        //Valida o campo senha
        if(! $senha)
            ($arrayMsg['senhalLogin'] = "O campo [Senha] é obrigatório.");

        return $arrayMsg;
    }

    public function salvarUsuarioSessao(Usuario $usuario) {
        //Habilitar o recurso de sessão no PHP nesta página
        session_start();

        //Setar usuário na sessão do PHP
        $_SESSION[SESSAO_USUARIO_ID]   = $usuario->getId();
        $_SESSION[SESSAO_USUARIO_NOME_USUARIO] = $usuario->getNomeUsuario();
        $_SESSION[SESSAO_USUARIO_TIPO_USUARIO] = $usuario->getTipoUsuario();
    }

    public function removerUsuarioSessao() {
        //Habilitar o recurso de sessão no PHP nesta página
        session_start();

        //Destroi a sessão 
        session_destroy();
    }

}