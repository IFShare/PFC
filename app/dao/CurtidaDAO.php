<?php

#INCLUDES

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Curtida.php");
include_once(__DIR__ . "/../model/Post.php");
include_once(__DIR__ . "/../model/Usuario.php");
include_once(__DIR__ . "/../service/LoginService.php");

class CurtidaDAO
{
    private LoginService $loginService;

    public function __construct()
    {
        $this->loginService = new LoginService();
    }

    #REALIZAR CURTIDA

    public function insertLike(Curtida $curtida)
    {
        $conn = Connection::getConnection();

        // Se não existe, inserir curtida
        $sql = "INSERT INTO curtida (idPostagem, idUsuario) VALUES (:idPostagem, :idUsuario)";
        $stm = $conn->prepare($sql);
        $stm->bindValue("idPostagem", $curtida->getPost()->getId());
        $stm->bindValue("idUsuario", $this->loginService->getIdUsuarioLogado());
        $stm->execute();
        return "Curtida registrada (like)";
    }


    ####################################################################################

    public function isLiked(Curtida $curtida)
    {
        $conn = Connection::getConnection();

        // Verificar se já existe uma curtida para este usuário e postagem
        $sql = "SELECT * FROM curtida WHERE idPostagem = :idPostagem AND idUsuario = :idUsuario";
        $stm = $conn->prepare($sql);
        $stm->bindValue("idPostagem", $curtida->getPost()->getId());
        $stm->bindValue("idUsuario", $this->loginService->getIdUsuarioLogado());
        $stm->execute();

        $likeExistente =  $stm->fetch();

        return $likeExistente;
    }

    #DELETA UMA CURTIDA

    public function delLike(int $id)
    {        
        $conn = Connection::getConnection();
        // Se já existe curtida, remover
        $sql = "DELETE FROM curtida WHERE id = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    ####################################################################################

    #CONVERTE REGISTRO DA BASE EM OBJETO

    private function mapCurtida($result)
    {
        $curtidas = array();
        foreach ($result as $reg) {
            $curtida = new Curtida();
            $curtida->setId($reg['id']);

            $post = new Post();
            $post->setId($reg['idPostagem']);
            $curtida->setPost($post);

            $usuario = new Usuario();
            $usuario->setId($reg['idUsuario']);
            $curtida->setUsuario($usuario);

            array_push($curtidas, $curtida);
        }

        return $curtidas;
    }
}
