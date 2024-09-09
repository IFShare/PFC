<?php

require_once(__DIR__ . "/../dao/PostagemDAO.php");
require_once(__DIR__ . "/../service/PostagemService.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Post.php");

class PostagemController extends Controller
{

    private PostagemDAO  $postDao;
    private PostagemService  $postService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;

        $this->postDao = new PostagemDAO();
        $this->postService = new PostagemService();

        $this->handleAction();
    }

    protected function listPosts()
    {
        $postagens = $this->postDao->listPosts();
        //print_r($usuarios);
        $dados["lista"] = $postagens;

        $this->loadView("postagem/list.php", $dados, []);
    }


    protected function save()
    {
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $imagem["id"] = isset($_FILES['imagem']) ? $_FILES['imagem'] : 0;

        
        $legenda["id"] = isset($_POST['legenda']) ? $_POST['legenda'] : 0;
        $dataPostagem = ($dados["id"] == 0) ? date('Y-m-d') : NULL;  // Captura a data de criação apenas para novos registros


        //Cria objeto Usuario
        $post = new Post();

        $post->setDataPostagem($dataPostagem);
        //Validar os dados
        $erros = $this->postService->validarDados($post);
        if (empty($erros)) {
            //Persiste o objeto
            try {

                if ($dados["id"] == 0)  //Inserindo
                    $this->postDao->insertPost($post);

                //TODO - Enviar mensagem de sucesso
                $msg = "Post salvo com sucesso.";
                $this->listPosts("", $msg);
                exit;
            } catch (PDOException $e) {
                //echo $e->getMessage();
                $erros = array("Erro ao salvar a postagem na base de dados.");
            }
        }

        //Se há erros, volta para o formulário

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["post"] = $post;

        $msgErro = $erros;
        //echo $msgsErro;
        //exit;
        $this->loadView("postagem/postForm.php", $dados, $msgErro);
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
