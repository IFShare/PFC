<?php

require_once(__DIR__ . "/../dao/PostagemDao.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Curtida.php");
require_once(__DIR__ . "/../dao/CurtidaDAO.php");

class CurtidaController extends Controller
{

    private CurtidaDAO  $curtidaDao;


    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;

        $this->curtidaDao = new CurtidaDAO();

        $this->handleAction();
    }

    public function likeDislike(Curtida $curtida)
{
    $likeExistente = $this->curtidaDao->isLiked($curtida);

    if ($likeExistente) {
        // Se já existe, remover a curtida
        $this->curtidaDao->delLike($curtida->getId());
        echo "Curtida removida (deslike)";
    } else {
        // Se não existe, inserir a curtida
        $this->curtidaDao->insertLike($curtida);
        echo "Curtida registrada (like)";
    }
}



}
#Criar objeto da classe para assim executar o construtor
new CurtidaController();
