<?php

#INCLUDES

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Denuncia.php");
include_once(__DIR__ . "/../model/Post.php");
include_once(__DIR__ . "/../model/Usuario.php");
include_once(__DIR__ . "/../service/LoginService.php");

class DenunciaDAO
{

    private LoginService $loginService;

    public function __construct()
    {
        $this->loginService = new LoginService();
    }

    #LISTAGEM DE USUÁRIOS

    public function listDenunciaByPost($idPostagem)
    {

        $conn = Connection::getConnection();

        $sql = "SELECT d.*, u.nomeUsuario FROM denuncia d
                    JOIN usuario u ON (u.id = d.idUsuario)
                WHERE d.idPostagem = :idPostagem
                ORDER BY d.id DESC";
        $stm = $conn->prepare($sql);
        $stm->bindValue(':idPostagem', $idPostagem);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapDenuncias($result);
    }

    public function listTotalDenunciaForEachPost()
    {

        $conn = Connection::getConnection();

        $sql = "SELECT p.id AS idPostagem, u.id idUsuario, u.nomeUsuario, 
                    COUNT(d.id) AS totalDenuncias
                FROM postagem p
                    JOIN denuncia d ON p.id = d.idPostagem
                    JOIN usuario u ON (u.id = p.idUsuario)
                GROUP BY p.id 
                ORDER BY totalDenuncias DESC";
        $stm = $conn->prepare($sql);

        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapDenunciasPostagem($result);
    }

    public function listTotalDenunciaForEachPostNaoVerificado()
    {

        $conn = Connection::getConnection();

        $sql = "SELECT p.id AS idPostagem, u.id idUsuario, u.nomeUsuario, 
                    COUNT(d.id) AS totalDenuncias
                FROM postagem p
                    JOIN denuncia d ON p.id = d.idPostagem
                    JOIN usuario u ON (u.id = p.idUsuario)
                WHERE d.status = 'NAOVERIFICADO'
                GROUP BY p.id 
                ORDER BY totalDenuncias DESC";
        $stm = $conn->prepare($sql);

        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapDenunciasPostagem($result);
    }

    public function countDenunciasNaoVerificados()
    {

        $conn = Connection::getConnection();

        $sql = "SELECT COUNT(*) total FROM denuncia d WHERE d.status = 'NAOVERIFICADO'";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["total"];
    }


    #INSERÇÃO DE DENUNCIA

    public function insertDenuncia(Denuncia $denuncia)
    {
        $conn = Connection::getConnection();

        $sql = "INSERT INTO denuncia (motivo, status, idUsuario, idPostagem)" .

            " VALUES (:motivo, :status, :idUsuario, :idPostagem)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("motivo", $denuncia->getMotivo());
        $stm->bindValue("status", $denuncia->getStatus());
        $stm->bindValue("idUsuario", $this->loginService->getIdUsuarioLogado());
        $stm->bindValue("idPostagem", $denuncia->getPost()->getId());

        $stm->execute();
    }

    public function insertSolution(Denuncia $denuncia)
    {
        $conn = Connection::getConnection();

        $sql = "UPDATE denuncia
                SET solucao = :solucao, status = :status
                WHERE id = :idDenuncia";

        $stm = $conn->prepare($sql);
        $stm->bindValue(":solucao", $denuncia->getSolucao());
        $stm->bindValue(":status", $denuncia->getStatus());
        $stm->bindValue(":idDenuncia", $denuncia->getId());
        $stm->execute();
    }


    ####################################################################################

    #DELETA UM USUÁRIO PELO ID

    public function deleteById(int $id)
    {
        $conn = Connection::getConnection();

        $sql = "DELETE FROM denuncia WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    #BUSCA UMA DENUNCIA PELO ID

    public function findById(int $id)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM denuncia d WHERE d.id = ?";
        $stm = $conn->prepare($sql);

        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $denuncias = $this->mapDenuncias($result);

        if (count($denuncias) == 1)
            return $denuncias[0];
        elseif (count($denuncias) == 0)
            return null;

        die("DenunciaDAO.findById()" .
            " - Erro: mais de uma denuncia encontrado.");
    }

    ####################################################################################

    #CONVERTE REGISTRO DA BASE EM OBJETO

    private function mapDenunciasPostagem($result) {
        $postagens = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['idUsuario']);
            $usuario->setNomeUsuario($reg['nomeUsuario']);

            $post = new Post();
            $post->setId($reg['idPostagem']);
            $post->setUsuario($usuario);
            $post->setTotalDenuncias($reg['totalDenuncias']);

            array_push($postagens, $post);
        }

        return $postagens;
    }

    private function mapDenuncias($result)
    {
        $denuncias = array();
        foreach ($result as $reg) {
            $denuncia = new Denuncia();
            $denuncia->setId($reg['id']);
            $denuncia->setMotivo($reg['motivo']);
            $denuncia->setstatus($reg['status']);
            $denuncia->setSolucao($reg['solucao']);

            $usuario = new Usuario();
            $usuario->setId($reg['idUsuario']);
            if(isset($reg['nomeUsuario']))
                $usuario->setNomeUsuario($reg['nomeUsuario']);
            $denuncia->setUsuario($usuario);

            $post = new Post();
            $post->setId($reg['idPostagem']);
            $denuncia->setPost($post);

            array_push($denuncias, $denuncia);
        }

        return $denuncias;
    }
}
