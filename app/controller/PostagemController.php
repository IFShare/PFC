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

        if (! $this->usuarioIsAdminStudent()) {
            echo "Acesso negado!";
            exit;
        }

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
        $legenda = trim($_POST['legenda']) ? trim($_POST['legenda']) : null;
        $imagem = isset($_FILES['imagem']) ? $_FILES['imagem'] : null;


        if ($imagem && isset($imagem['size']) && $imagem['size'] > 0) {
            $Nomeimagem = "../imgPosts/" . $_FILES['imagem']['name'];
            move_uploaded_file($_FILES['imagem']['tmp_name'], $Nomeimagem);
        } else {
            $Nomeimagem = "";
        }


        /* echo $legenda . "<br>";
        print_r($imagem);
        */

        $post = new Post();
        $post->setLegenda($legenda);
        $post->setImagem($Nomeimagem);

        //Validar os dados
        $erros = $this->postService->validarDados($post, $imagem);
        if (empty($erros)) {
            //Persiste o objeto
            try {

                $this->postDao->insertPost($post);

                //TODO - Enviar mensagem de sucesso
                $msg = "Post salvo com sucesso.";
                $this->listPosts("", $msg);
                exit;
            } catch (PDOException $e) {
                //echo $e->getMessage();
                $erros = array("Erro ao salvar a postagem na base de dados." . $e);
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
