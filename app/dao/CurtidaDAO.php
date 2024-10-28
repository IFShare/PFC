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

    // Inserir curtida
    public function insertLike(Curtida $curtida)
    {
        $conn = Connection::getConnection();

        $sql = "INSERT INTO curtida (idPostagem, idUsuario) VALUES (:idPostagem, :idUsuario)";
        $stm = $conn->prepare($sql);
        $stm->bindValue(":idPostagem", $curtida->getPost()->getId());
        $stm->bindValue(":idUsuario", $this->loginService->getIdUsuarioLogado());
        $stm->execute();
    }

    // Verificar se já existe uma curtida
    public function isLiked($idPostagem, $idUsuario)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT id FROM curtida WHERE idPostagem = :idPostagem AND idUsuario = :idUsuario";
        $stm = $conn->prepare($sql);
        $stm->bindValue(":idPostagem", $idPostagem);
        $stm->bindValue(":idUsuario", $this->loginService->getIdUsuarioLogado());
        $stm->execute();

        return $stm->fetch();
    }

    // Deletar curtida
    public function delLike(int $id)
    {
        $conn = Connection::getConnection();

        $sql = "DELETE FROM curtida WHERE id = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue(":id", $id);
        $stm->execute();
    }

    public function countLikes(int $idPostagem)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT COUNT(*) total FROM curtida WHERE curtida.idPostagem = :idPostagem";
        $stm = $conn->prepare($sql);
        $stm->bindValue(':idPostagem', $idPostagem);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["total"];
    }

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
