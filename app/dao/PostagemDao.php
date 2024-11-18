<?php

#INCLUDES

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Post.php");
include_once(__DIR__ . "/../model/Usuario.php");
include_once(__DIR__ . "/../service/LoginService.php");

class PostagemDAO
{
    private LoginService $loginService;

    public function __construct()
    {
        $this->loginService = new LoginService();        
    }


    #LISTAGEM DE POSTAGENS

    public function listPosts()
    {

        $conn = Connection::getConnection();

        $sql = "SELECT * FROM postagem ORDER BY id DESC";
        $stm = $conn->prepare($sql);

        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapPostagens($result);
    }

    ####################################################################################

    #INSERÇÃO DE POSTAGEM

    public function insertPost(Post $post)
    {
        $conn = Connection::getConnection();

        $sql = "INSERT INTO postagem (imagem, legenda, dataPostagem, idUsuario)" .
            " VALUES (:imagem, :legenda, now(), :idUsuario)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("imagem", $post->getImagem());
        $stm->bindValue("legenda", $post->getLegenda());
        $stm->bindValue("idUsuario", $this->loginService->getIdUsuarioLogado());

        $stm->execute();
    }

    ####################################################################################

    #DELETA UMA POSTAGEM PELO ID

    public function deletePostById(int $id)
    {
        $conn = Connection::getConnection();

        $sql = "DELETE FROM postagem WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    ####################################################################################

    #CONTA O NÚMERO DE POSTAGENS DO SISTEMA

    public function count() {
        $conn = Connection::getConnection();

        $sql = "SELECT COUNT(*) total FROM postagem";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["total"];
    }

    ####################################################################################

    #BUSCA UMA POSTAGEM PELO ID

    public function findById(int $id)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM postagem p WHERE p.id = ?";
        $stm = $conn->prepare($sql);

        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $postagens = $this->mapPostagens($result);

        if (count($postagens) == 1)
            return $postagens[0];
        elseif (count($postagens) == 0)
            return null;

        die("UsuarioDAO.findById()" .
            " - Erro: mais de uma postagem encontrada.");
    }

    ####################################################################################

    #CONVERTE REGISTRO DA BASE EM OBJETO

    private function mapPostagens($result)
    {
        $postagens = array();
        foreach ($result as $reg) {
            $post = new Post();
            $post->setId($reg['id']);
            $post->setImagem($reg['imagem']);
            $post->setLegenda($reg['legenda']);
            $post->setDataPostagem($reg['dataPostagem']);

            $usuario = new Usuario();
            $usuario->setId($reg['idUsuario']);
            $post->setUsuario($usuario);


            array_push($postagens, $post);
        }

        return $postagens;
    }
}
