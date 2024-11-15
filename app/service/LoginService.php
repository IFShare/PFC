<?php
#Nome do arquivo: LoginService.php
#Objetivo: classe service para Login

require_once(__DIR__ . "/../model/Usuario.php");

class LoginService {

    public function validarCampos(?string $email, ?string $senha) {
        $arrayMsg = array();

        //Valida o campo email
        if(! $email)
            $arrayMsg['emailLogin'] = "Preencha seu e-mail.";
        elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
            $arrayMsg['emailLogin'] = "Formato de email inválido!";

        //Valida o campo senha
        if(! $senha)
            $arrayMsg['senhaLogin'] = "Preencha sua senha";
        elseif (strlen($senha) < 5)
            $arrayMsg['senhaLogin'] = "A senha precisa ter pelo menos 5 caracteres";

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

    public function getIdUsuarioLogado() {
        //Habilitar o recurso de sessão no PHP nesta página
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if(isset($_SESSION[SESSAO_USUARIO_ID]))
            return $_SESSION[SESSAO_USUARIO_ID];

        die("Usuário não está logado!");
    }

    public function removerUsuarioSessao() {
        //Habilitar o recurso de sessão no PHP nesta página
        session_start();

        //Destroi a sessão 
        session_destroy();
    }

}