<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/PostagemDao.php");

class HomeController extends Controller {

    private UsuarioDAO $usuarioDao;
    private PostagemDAO $postagemDao;

    public function __construct() {
        //Testar se o usuário está logado
        if(! $this->usuarioLogado()) {
            exit;
        }

        //Criar o objeto do UsuarioDAO
        $this->usuarioDao = new UsuarioDAO();
        $this->postagemDao = new PostagemDAO();

        $this->handleAction();       
    }

    protected function home() {
        $totalUsuarios = $this->usuarioDao->count();
        $listaUsuario = $this->usuarioDao->list();
        $listaPostagens = $this->postagemDao->listPosts();
        $countNaoVerificados = $this->usuarioDao->countNaoVerificados();    

        $dados["totalUsuarios"] = $totalUsuarios;
        $dados["listaUsuarios"] = $listaUsuario;
        $dados["listPosts"] = $listaPostagens;
        $dados["countNaoVerificados"] = $countNaoVerificados;

        //echo "<pre>" . print_r($dados, true) . "</pre>";
        $this->loadView("home/home.php", $dados, []);
    }

}

//Criar o objeto da classe HomeController
new HomeController();