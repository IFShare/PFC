<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/PostagemDao.php");
require_once(__DIR__ . "/../dao/DenunciaDao.php");

class HomeController extends Controller {

    private UsuarioDAO $usuarioDao;
    private PostagemDAO $postagemDao;
    private DenunciaDAO $denunciaDao;

    public function __construct() {
        //Testar se o usuário está logado
        if(! $this->usuarioLogado()) {
            exit;
        }

        //Criar o objeto do UsuarioDAO
        $this->usuarioDao = new UsuarioDAO();
        $this->postagemDao = new PostagemDAO();
        $this->denunciaDao = new DenunciaDAO();

        $this->handleAction();       
    }

    protected function home() {
        $totalUsuarios = $this->usuarioDao->count();
        $listaUsuario = $this->usuarioDao->list();
        $listaPostagens = $this->postagemDao->listPosts();
        $countUsersNaoVerificados = $this->usuarioDao->countUsersNaoVerificados();    
        $countDenunciasNaoVerificados = $this->denunciaDao->countDenunciasNaoVerificados();    

        $dados["totalUsuarios"] = $totalUsuarios;
        $dados["listaUsuarios"] = $listaUsuario;
        $dados["listPosts"] = $listaPostagens;
        $dados["countUsersNaoVerificados"] = $countUsersNaoVerificados;
        $dados["countDenunciasNaoVerificados"] = $countDenunciasNaoVerificados;

        //echo "<pre>" . print_r($dados, true) . "</pre>";
        $this->loadView("home/home.php", $dados, []);
    }

}

//Criar o objeto da classe HomeController
new HomeController();