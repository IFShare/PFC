<?php

require_once(__DIR__ . "/../dao/PostagemDao.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/ComentarioDAO.php");
require_once(__DIR__ . "/../dao/CurtidaDAO.php");
require_once(__DIR__ . "/../service/PostagemService.php");
require_once(__DIR__ . "/../service/ImgService.php");
require_once(__DIR__ . "/../model/Post.php");
require_once(__DIR__ . "/Controller.php");

class PostagemController extends Controller
{

    private PostagemDAO  $postDao;
    private CurtidaDAO  $curtidaDao;
    private ComentarioDAO  $comentarioDao;
    private UsuarioDAO  $usuarioDao;
    private PostagemService  $postService;
    private ImgService  $imgService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;

        $this->postDao = new PostagemDAO();
        $this->curtidaDao = new CurtidaDAO();
        $this->comentarioDao = new ComentarioDAO();
        $this->usuarioDao = new UsuarioDAO();
        $this->postService = new PostagemService();
        $this->imgService = new ImgService();

        $this->handleAction();
    }

    protected function listPosts()
    {

        $data = isset($_GET['search']) ? $_GET['search'] : NULL;

        $perfis = [];

        if (!empty($data)) {
            $postagens = $this->postDao->searchPost($data);
        } else {
            $postagens = $this->postDao->listPosts();
        }

        $dados["listPosts"] = $postagens;
        $dados["listPerfis"] = $perfis;

        $this->loadView("home/home.php", $dados, []);
    }

    protected function viewPost()
    {

        $postagem = $this->findPostById();

        if ($postagem) {


            $usuario = $this->usuarioDao->findById($postagem->getUsuario()->getId());
            $comentarios = $this->comentarioDao->listComentariosByPost($postagem->getId());
            $curtidas = $this->curtidaDao->countLikes($postagem->getId());
            $curtidaExistente = $this->curtidaDao->isLiked($postagem->getId(), $postagem->getUsuario()->getId());

            //Setar os dados
            $dados["id"] = $postagem->getId();
            $dados["usuario"] = $usuario;
            $dados["tipoUsuario"] = $usuario->getTipoUsuario();
            $dados["nomeUsuario"] = $usuario->getNomeUsuario();
            $dados["postagem"] = $postagem;
            $dados["listComentarios"] = $comentarios;
            $dados["countLikes"] = $curtidas;
            $dados["curtidaExistente"] = $curtidaExistente;
            $this->loadView("postagem/postView.php", $dados, []);
        } else
            echo "Postagem não encontrada.";
    }

    public function findPostById()
    {
        $id = 0;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } elseif (isset($_POST['id'])) {
            $id = $_POST['id'];
        }

        $postagem = $this->postDao->findById($id);
        return $postagem;
    }

    protected function save()
    {

        if (! $this->usuarioIsAdminStudent()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        //Captura os dados do formulário
        $legenda = trim(nl2br($_POST['legenda'])) ? trim(nl2br($_POST['legenda'])) : null;
        $imagem = isset($_FILES['imagem']) ? $_FILES['imagem'] : null;



        $post = new Post();
        $post->setLegenda($legenda);

        //Validar os dados
        $erros = $this->postService->validarDados($post, $imagem);
        if (empty($erros)) {
            $nomeArquivo = $this->imgService->salvarArquivo($imagem);
            if ($nomeArquivo)
                $post->setImagem($nomeArquivo);
            else
                $erros = array("Erro ao salvar o arquivo da postagem.");

            if (empty($erros)) {
                //Persiste o objeto
                try {
                    $this->postDao->insertPost($post);


                    // Determinar a view com base na action
                    $view = '';

                    if (isset($_GET['view']) && $_GET['view'] === 'perfilUsuario') {
                        $view = "/PFC/app/controller/UsuarioController.php?action=perfilUsuario";
                    } elseif (! isset($_GET['view'])){
                        $view = "/PFC/app/controller/HomeController.php?action=home";
                    }

                    header("location: " . $view);
                    exit;
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    exit;
                    $erros = array("Erro ao salvar a postagem na base de dados." . $e);
                }
            }
        }
    }


    protected function delPost()
    {

        // Obtém a postagem pelo ID
        $postagem = $this->findPostById();

        if (!$postagem) {
            print "<script>alert('Postagem não encontrada.');</script>";
            return;
        }

        //Validar se o usuário pode excluir a postagem
        if (! $this->usuarioIsAdmPostOwner($postagem)) {
            header("location: " . ACESSO_NEGADO);
            return;
        }

        // Caminho do arquivo da imagem associado à postagem
        $arquivoImg = $_SERVER['DOCUMENT_ROOT'] . "/PFC/arquivos/imgs/" . $postagem->getImagem();
        // Ajuste conforme o local onde as imagens estão armazenadas


        // Verifica se o arquivo existe
        if (file_exists($arquivoImg)) {
            // Tenta excluir o arquivo
            if (unlink($arquivoImg)) {
                // Se a exclusão do arquivo for bem-sucedida, exclui o registro da postagem no banco de dados
                $this->postDao->deletePostById($postagem->getId());
                header("Location: " . HOME_PAGE);
                exit;
            } else {
                // Caso o arquivo não possa ser excluído
                echo "<script>alert('Erro ao excluir o arquivo: $arquivoImg');</script>";
            }
        } else {
            // Arquivo não encontrado
            echo "<script>alert('Imagem da postagem não encontrada.');</script>";
        }

        // Exclui o registro da postagem mesmo que o arquivo não exista
        $this->postDao->deletePostById($postagem->getId());
        header("Location: " . HOME_PAGE);
        exit;
    }
}

#Criar objeto da classe para assim executar o construtor
new PostagemController();
