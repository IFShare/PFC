<?php
#Classe controller padrão

require_once(__DIR__ . "/../util/config.php");
require_once(__DIR__ . "/../model/Post.php");
require_once(__DIR__ . "/../model/Comentario.php");

class Controller
{
    //Método que efetua a chamada do ação conforme parâmetro GET recebido pela requisição
    protected function handleAction()
    {
        //Captura a ação do parâmetro GET
        $action = NULL;
        if (isset($_GET['action']))
            $action = $_GET['action'];

        //Chama a ação
        $this->callAction($action);
    }

    protected function callAction($methodName)
    {
        //Verifica se o método da action recebido por parâmetro existe na classe
        //Se sim, chama-o
        if ($methodName && method_exists($this, $methodName))
            $this->$methodName();

        else {
            echo "Ação não encontrada no controller.<br>";
            echo "Verifique com o administrador do sistema.";
        }
    }

    protected function loadView(string $path, array $dados, array $msgErro)
    {

        //Verificar os dados que estão sendo recebidos na função
        //echo "<pre>" . print_r($dados, true) . "</pre>";
        //exit;

        $caminho = __DIR__ . "/../view/" . $path;
        //echo $caminho;
        if (file_exists($caminho)) {
            //Inclui e exibe a view a partir do controller
            require $caminho;
        } else {
            echo "Erro ao carregar a view solicitada<br>";
            echo "Caminho: " . $caminho;
        }
    }

    //Método que verifica se o usuário está logado
    protected function usuarioLogado()
    {
        //Habilitar o recurso de sessão no PHP nesta página
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (! isset($_SESSION[SESSAO_USUARIO_ID])) {
            header("location: " . "/PFC");
            return false;
        }

        return true;
    }

    protected function usuarioIsAdmin()
    {
        //Habilitar o recurso de sessão no PHP nesta página
        if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == TipoUsuario::ADM)
            return true;

        return false;
    }

    protected function usuarioIsAdminStudent()
    {
        //Habilitar o recurso de sessão no PHP nesta página
        if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == TipoUsuario::ESTUDANTE || $_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == TipoUsuario::ADM)
            return true;

        return false;
    }


    protected function usuarioIsAdmPostOwner(Post $post)
    {
        if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == TipoUsuario::ADM)
            return true;

        if (
            $_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == TipoUsuario::ESTUDANTE
            && $post->getUsuario()->getId() == $_SESSION[SESSAO_USUARIO_ID]
        )
            return true;

        return false;
    }

    protected function usuarioIsAdmComentOwner(Comentario $coment)
    {
        if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == TipoUsuario::ADM)
            return true;

        if (
            $_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == TipoUsuario::ESTUDANTE
            && $coment->getUsuario()->getId() == $_SESSION[SESSAO_USUARIO_ID]
        )
            return true;

        return false;
    }
}
