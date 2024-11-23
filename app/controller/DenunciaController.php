<?php

require_once(__DIR__ . "/../dao/DenunciaDAO.php");
require_once(__DIR__ . "/../dao/PostagemDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Denuncia.php");

class DenunciaController extends Controller
{

    private DenunciaDAO  $denunciaDao;
    private PostagemDao  $postagemDao;
    private UsuarioDAO  $usuarioDao;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;

        if (! $this->usuarioIsAdmin()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        $this->denunciaDao = new DenunciaDAO();
        $this->postagemDao = new PostagemDao();
        $this->usuarioDao = new UsuarioDAO();

        $this->handleAction();
    }

    protected function listDenuncias()
    {
        $data = isset($_GET['search']) ? $_GET['search'] : NULL;

        if (!empty($data)) {
            $denuncias = $this->denunciaDao->search($data);
        } else {
            $denuncias = $this->denunciaDao->list();
        }

        $naoVerifiacdos = $this->denunciaDao->countDenunciasNaoVerificados();

        //print_r($usuarios);
        $dados["data"] = $data;
        $dados["lista"] = $denuncias;
        $dados["naoVerificados"] = $naoVerifiacdos;

        $this->loadView("postagem/listDenuncias.php", $dados, []);
    }

    private function findDenunciaById()
    {
        $id = 0;
        if (isset($_GET['id']))
            $id = $_GET['id'];

        $comentario = $this->denunciaDao->findById($id);
        return $comentario;
    }

    protected function insertDenuncia()
    {

        if (! $this->usuarioIsAdminStudent()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        //Captura os dados do formulário
        $idPostagem = $_GET['id'] ?? null;  // Certifique-se de que o idPostagem está vindo corretamente
        $motivo = trim(($_POST['motivo'])) ? trim(($_POST['motivo'])) : null;

        $denuncia = new Denuncia();
        $denuncia->setMotivo($motivo); 
        $denuncia->setStatus(DenunciaStatus::NAOVERIFICADO); 

        $postagem = new Post();
        $postagem->setId($idPostagem); 
        $denuncia->setPost($postagem);
        $this->denunciaDao->insertDenuncia($denuncia);


        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["denuncia"] = $denuncia;
        header("location: " . "/PFC/app/controller/PostagemController.php?action=viewPost&id=" . $idPostagem);

        $this->loadView("postagem/postView.php", $dados, []);
    }

    protected function delDenuncia()
    {
        if (! $this->usuarioIsAdminStudent()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        $denuncia = $this->findDenunciaById();
        if ($denuncia) {
            //Excluir
            $this->denunciaDao->deleteById($denuncia->getId());
            header("location: /PFC/app/controller/DenunciaController.php?action=viewPost&id=" . $denuncia->getPostagem()->getId());
        }
    }
}

#Criar objeto da classe para assim executar o construtor
new DenunciaController();
