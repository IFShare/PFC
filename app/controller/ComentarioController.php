<?php

require_once(__DIR__ . "/../dao/ComentarioDAO.php");
require_once(__DIR__ . "/../dao/PostagemDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/ComentarioDAO.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Comentario.php");

class ComentarioController extends Controller
{

    private ComentarioDAO  $comentarioDao;
    private Comentario  $comentario;
    private PostagemDao  $postagemDao;
    private UsuarioDAO  $usuarioDao;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;

        if (! $this->usuarioIsAdminStudent()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        $this->comentarioDao = new ComentarioDAO();
        $this->comentario = new Comentario();
        $this->postagemDao = new PostagemDao();
        $this->usuarioDao = new UsuarioDAO();

        $this->handleAction();
    }

    private function findComentarioById()
    {
        $id = 0;
        if (isset($_GET['id']))
            $id = $_GET['id'];

        $comentario = $this->comentarioDao->findById($id);
        return $comentario;
    }

    protected function insertComentario()
    {

        if (! $this->usuarioIsAdminStudent()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        //Captura os dados do formulário
        $idPostagem = $_POST['idPostagem'] ?? null;  // Certifique-se de que o idPostagem está vindo corretamente
        $conteudo = trim(($_POST['comentario'])) ? trim(($_POST['comentario'])) : null;

        $comentario = new Comentario();
        $comentario->setConteudo($conteudo); // Conteúdo do comentário

        // Definir a postagem no comentário
        $postagem = new Post();
        $postagem->setId($idPostagem); // Aqui você define o ID da postagem

        $comentario->setPostagem($postagem); // Atribui a postagem ao comentário


        $this->comentarioDao->insert($comentario);


        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["comentario"] = $comentario;
        header("location: " . "/PFC/app/controller/PostagemController.php?action=viewPost&id=" . $idPostagem);

        $this->loadView("postagem/postView.php", $dados, []);
    }

    protected function delComentario()
    {
        $comentario = $this->findComentarioById();


        if (! $this->usuarioIsAdmComentOwner($comentario)) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        if ($comentario) {
            //Excluir
            $this->comentarioDao->deleteById($comentario->getId());
            header("location: /PFC/app/controller/PostagemController.php?action=viewPost&id=" . $comentario->getPostagem()->getId());
        }
    }
}

#Criar objeto da classe para assim executar o construtor
new ComentarioController();
