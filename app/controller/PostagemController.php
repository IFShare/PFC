<?php

require_once(__DIR__ . "/../dao/PostagemDAO.php");
require_once(__DIR__ . "/../service/PostagemService.php");
require_once(__DIR__ . "/../service/ArquivoService.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Post.php");

class PostagemController extends Controller
{

    private PostagemDAO  $postDao;
    private PostagemService  $postService;
    private ArquivoService  $arqService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;

        if (! $this->usuarioIsAdminStudent()) {
            echo "Acesso negado!";
            exit;
        }

        $this->postDao = new PostagemDAO();
        $this->postService = new PostagemService();
        $this->arqService = new ArquivoService();

        $this->handleAction();
    }

    protected function listPosts()
    {
        $postagens = $this->postDao->listPosts();
        print_r($postagens);
        $dados["listPosts"] = $postagens;

        $this->loadView("home/home.php", $dados, []);
    }


    protected function save()
    {

        //Captura os dados do formulário
        $legenda = trim($_POST['legenda']) ? trim($_POST['legenda']) : null;
        $imagem = isset($_FILES['imagem']) ? $_FILES['imagem'] : null;



        /* echo $legenda . "<br>";
        print_r($imagem);
        */

        $post = new Post();
        $post->setLegenda($legenda);

        //Validar os dados
        $erros = $this->postService->validarDados($post, $imagem);
        if (empty($erros)) {
            $nomeArquivo = $this->arqService->salvarArquivo($imagem);
            if($nomeArquivo)
                $post->setImagem($nomeArquivo);
            else
                $erros = array("Erro ao salvar o arquivo da postagem.");

            if(empty($erros)) {
                //Persiste o objeto
                try {
                    $this->postDao->insertPost($post);

                    header("location: " . HOME_PAGE);
                    exit;
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    exit;
                    $erros = array("Erro ao salvar a postagem na base de dados." . $e);
                }
            }
        }
        //Se há erros, volta para o formulário

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["post"] = $post;
        exit;

        $this->loadView("postagem/postForm.php", $dados, $erros);
    }

    //Método create
    protected function createPost()
    {
        $dados["id"] = 0;
        $this->loadView("postagem/postForm.php", $dados, []);
    }
}

#Criar objeto da classe para assim executar o construtor
new PostagemController();
