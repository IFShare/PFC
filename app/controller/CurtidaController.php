<?php
require_once(__DIR__ . "/../dao/PostagemDao.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Curtida.php");
require_once(__DIR__ . "/../dao/CurtidaDAO.php");

class CurtidaController extends Controller
{
    private CurtidaDAO $curtidaDao;

    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;

        $this->curtidaDao = new CurtidaDAO();

        $this->handleAction();
    }

    public function isLiked(): bool
    {
        $idPostagem = $_GET['id'] ?? $_GET['id'] ?? null;

        if (!$idPostagem) {
            return false;
        }

        $idUsuario = $_SESSION['usuarioLogadoId'] ?? null;

        if (!$idUsuario) {
            return false;
        }

        $likeExistente = $this->curtidaDao->isLiked($idPostagem, $idUsuario);

        return (bool) $likeExistente;
    }


    public function likeDislike()
    {

        header('Content-Type: application/json');
        // Captura o id da postagem via GET ou POST
        $idPostagem = $_POST['post'];
        $idUsuario = $_POST['user'];

        if (!$idPostagem) {
            echo "ID da postagem não fornecido!";
            exit;
        }

        // Verificar se já existe uma curtida para esta postagem e usuário
        $likeExistente = $this->curtidaDao->isLiked($idPostagem, $idUsuario);

        if ($likeExistente) {
            // Se já existe, remover a curtida
            $this->curtidaDao->delLike($likeExistente['id']);
            $status = 'dislike';
            $totalLikes = $this->curtidaDao->countLikes($idPostagem);
            echo json_encode([
                'status' => $status,
                'totalLikes' => $totalLikes
            ]);
            exit;
        } else {
            // Se não existe, inserir a curtida
            $curtida = new Curtida();
            $post = new Post();
            $usuario = new Usuario();
            $post->setId($idPostagem);

            $curtida->setPost($post);
            $curtida->setUsuario($usuario);

            $this->curtidaDao->insertLike($curtida);
            $status = 'like';
            $totalLikes = $this->curtidaDao->countLikes($idPostagem);
            echo json_encode([
                'status' => $status,
                'totalLikes' => $totalLikes
            ]);
            exit;
            // Atualizar o número total de curtidas

            // Retorna o estado atualizado da curtida e o número total de curtidas em JSON
            
        }
    }

}

new CurtidaController();
