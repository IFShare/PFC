<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class HomeController extends Controller {

    private UsuarioDAO $usuarioDao;

    public function __construct() {
        //Testar se o usuário está logado
        if(! $this->usuarioLogado()) {
            exit;
        }

        //Criar o objeto do UsuarioDAO
        $this->usuarioDao = new UsuarioDAO();

        $this->handleAction();       
    }

    protected function home() {
        $totalUsuarios = $this->usuarioDao->count();
        $listaUsuario = $this->usuarioDao->list();    

        $dados["totalUsuarios"] = $totalUsuarios;
        $dados["listaUsuarios"] = $listaUsuario;

        //echo "<pre>" . print_r($dados, true) . "</pre>";
        $this->loadView("home/home.php", $dados);
    }

}

//Criar o objeto da classe HomeController
new HomeController();