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
        $usuarioLogado = $this->usuarioDao->findById($_SESSION[SESSAO_USUARIO_ID]);

        $data = isset($_GET['search']) ? $_GET['search'] : NULL;
        $perfis = [];


        if (!empty($data) && $data === "OLDESTPOSTS") {
            $postagens = $this->postagemDao->searchOldestPosts();
        }elseif (!empty($data) && $data === "MOSTLIKEDPOSTS") {
            $postagens = $this->postagemDao->searchMostLikedPosts();
        } 
        elseif (!empty($data)) {
            $postagens = $this->postagemDao->searchPost($data);
            $perfis = $this->usuarioDao->searchPerfis($data);
        } else {
            $postagens = $this->postagemDao->listPosts();
        }

        $countUsersNaoVerificados = $this->usuarioDao->countUsersNaoVerificados();    
        $countDenunciasNaoVerificados = $this->denunciaDao->countDenunciasNaoVerificados();    

        $_SESSION["usuarioLogado"] = $usuarioLogado;
        $dados["totalUsuarios"] = $totalUsuarios;
        $dados["listPosts"] = $postagens;
        $dados["listPerfis"] = $perfis;
        $dados['dadoPesquisa'] = $data;
        $_SESSION['countUsersNaoVerificados'] = $countUsersNaoVerificados;
        $_SESSION["countDenunciasNaoVerificados"] = $countDenunciasNaoVerificados;

        //echo "<pre>" . print_r($dados, true) . "</pre>";
        $this->loadView("home/home.php", $dados, []);
    }

}

//Criar o objeto da classe HomeController
new HomeController();