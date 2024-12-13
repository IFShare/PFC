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

    public function list()
    {

        $conn = Connection::getConnection();

        $sql = "SELECT denuncia.*, usuario.nomeUsuario 
        FROM denuncia
        JOIN usuario ON denuncia.idUsuario = usuario.id
        ORDER BY denuncia.id DESC";
        $stm = $conn->prepare($sql);

        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapDenuncias($result);
    }

    public function search($data)
    {

        $conn = Connection::getConnection();

        $sql = "SELECT d.*, u.nomeUsuario 
                FROM denuncia d
                JOIN usuario u ON d.idUsuario = u.id
                WHERE d.id LIKE :search
                OR d.motivo LIKE :search
                OR d.status LIKE :search
                OR d.idPostagem LIKE :search
                OR d.idUsuario LIKE :search
                OR u.nomeUsuario LIKE :search
                ORDER BY d.id DESC";
        $stm = $conn->prepare($sql);
        $stm->bindValue(':search', "%$data%");

        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapDenuncias($result);
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

    private function mapDenuncias($result)
    {
        $denuncias = array();
        foreach ($result as $reg) {
            $denuncia = new Denuncia();
            $denuncia->setId($reg['id']);
            $denuncia->setMotivo($reg['motivo']);
            $denuncia->setstatus($reg['status']);

            $usuario = new Usuario();
            $usuario->setId($reg['idUsuario']);
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
