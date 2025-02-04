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

        $sql = "SELECT postagem.*, usuario.nomeUsuario, usuario.nomeSobrenome, usuario.fotoPerfil 
        FROM postagem
        JOIN usuario ON postagem.idUsuario = usuario.id
        ORDER BY postagem.id DESC";
        $stm = $conn->prepare($sql);

        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapPostagens($result);
    }


    public function searchPost($data)
    {

        $conn = Connection::getConnection();

        $sql = "SELECT postagem.*, usuario.nomeUsuario, usuario.nomeSobrenome, usuario.fotoPerfil
        FROM postagem
        JOIN usuario ON postagem.idUsuario = usuario.id
        WHERE postagem.id LIKE :search
        OR postagem.idUsuario LIKE :search
        OR usuario.nomeUsuario LIKE :search
        OR usuario.nomeSobrenome LIKE :search
        ORDER BY postagem.id DESC";


        $stm = $conn->prepare($sql);
        $stm->bindValue(':search', "%$data%");

        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapPostagens($result);
    }

    public function searchOldestPosts()
    {

        $conn = Connection::getConnection();

        $sql = "SELECT postagem.*, usuario.nomeUsuario, usuario.nomeSobrenome, usuario.fotoPerfil
        FROM postagem
        JOIN usuario ON postagem.idUsuario = usuario.id
        ORDER BY postagem.id ASC";

        $stm = $conn->prepare($sql);

        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapPostagens($result);
    }

    public function searchMostLikedPosts()
    {

        $conn = Connection::getConnection();

        $sql = "SELECT postagem.*, usuario.nomeUsuario, usuario.nomeSobrenome, usuario.fotoPerfil, COUNT(curtida.idPostagem) as totalCurtidas
        FROM postagem
        JOIN usuario ON postagem.idUsuario = usuario.id
        LEFT JOIN curtida ON postagem.id = curtida.idPostagem
        GROUP BY postagem.id
        ORDER BY totalCurtidas DESC";

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

    public function count()
    {
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

        $sql = "SELECT p.*, u.nomeUsuario, u.nomeSobrenome
                FROM postagem p
                JOIN usuario u ON p.idUsuario = u.id
                WHERE p.id = ?";
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



    public function listPostByUserId(int $id)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT postagem.*, usuario.nomeUsuario, usuario.nomeSobrenome
        FROM postagem
        JOIN usuario ON postagem.idUsuario = usuario.id
        WHERE postagem.idUsuario = ?
        ORDER BY postagem.id DESC";
        $stm = $conn->prepare($sql);

        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $postagens = $this->mapPostagens($result);
        return $postagens;
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
            $usuario->setNomeUsuario($reg['nomeUsuario']);
            $usuario->setNomeSobrenome($reg['nomeSobrenome']);
            $post->setUsuario($usuario);


            array_push($postagens, $post);
        }

        return $postagens;
    }
}
