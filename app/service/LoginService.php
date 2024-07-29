<?php
    
require_once(__DIR__ . "/../model/Usuario.php");

class LoginService {

    public function validarCampos(?string $login, ?string $senha) {
        $arrayMsg = array();

        //Valida o campo nome
        if(! $login)
            array_push($arrayMsg, "O campo [Login] é obrigatório.");

        //Valida o campo login
        if(! $senha)
            array_push($arrayMsg, "O campo [Senha] é obrigatório.");

        return $arrayMsg;
    }

    public function salvarUsuarioSessao(Usuario $usuario) {
        //Habilitar o recurso de sessão no PHP nesta página
        session_start();

        //Setar usuário na sessão do PHP
        $_SESSION[SESSAO_USUARIO_ID]   = $usuario->getId();
        $_SESSION[SESSAO_USUARIO_NOME] = $usuario->getNomeUsuario();
        $_SESSION[SESSAO_USUARIO_TIPO] = $usuario->getTipoUsuario();
    }

    public function removerUsuarioSessao() {
        //Habilitar o recurso de sessão no PHP nesta página
        session_start();

        //Destroi a sessão 
        session_destroy();
    }

}