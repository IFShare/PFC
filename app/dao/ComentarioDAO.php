<?php

#INCLUDES

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Comentario.php");
include_once(__DIR__ . "/../service/LoginService.php");

class ComentarioDAO
{

    private LoginService $loginService;

    public function __construct()
    {
        $this->loginService = new LoginService();
    }

    #LISTAGEM DE USUÁRIOS

    public function listComentariosByPost(int $idPostagem)
    {

        $conn = Connection::getConnection();

        //WHERE idPostagem = :idPostagem
        $sql = "SELECT comentario.*, usuario.nomeUsuario, usuario.fotoPerfil
        FROM comentario 
        JOIN usuario ON comentario.idUsuario = usuario.id
        WHERE comentario.idPostagem = :idPostagem
        ORDER BY comentario.id DESC";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue(':idPostagem', $idPostagem);

        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapComentario($result);
    }

    #INSERÇÃO DE COMENTÁRIO

    public function insert(Comentario $comentario)
    {
        $conn = Connection::getConnection();

        $sql = "INSERT INTO comentario (conteudo, dataComentario, idPostagem, idUsuario)" .
            " VALUES (:conteudo, now(), :idPostagem, :idUsuario)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("conteudo", $comentario->getConteudo());
        $stm->bindValue("idPostagem", $comentario->getPostagem()->getId());
        $stm->bindValue("idUsuario", $this->loginService->getIdUsuarioLogado());

        $stm->execute();
    }

    ####################################################################################

    #DELETA UM USUÁRIO PELO ID

    public function deleteById(int $id)
    {
        $conn = Connection::getConnection();

        $sql = "DELETE FROM comentario WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    ####################################################################################

    public function findById(int $id)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM comentario c WHERE c.id = ?";
        $stm = $conn->prepare($sql);

        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $comentarios = $this->mapComentario($result);

        if (count($comentarios) == 1)
            return $comentarios[0];
        elseif (count($comentarios) == 0)
            return null;

        die("UsuarioDAO.findById()" .
            " - Erro: mais de um comentário encontrado.");
    }

    #CONVERTE REGISTRO DA BASE EM OBJETO

    private function mapComentario($result)
    {
        $comentarios = array();
        foreach ($result as $reg) {
            $comentario = new Comentario();
            $comentario->setId($reg['id']);
            $comentario->setConteudo($reg['conteudo']);
            $comentario->setDataComentario($reg['dataComentario']);

            $usuario = new Usuario();
            $usuario->setId($reg['idUsuario']);
            $usuario->setNomeUsuario($reg['nomeUsuario']);
            $usuario->setFotoPerfil($reg['fotoPerfil']); // Adicionando o nome do usuário
            $comentario->setUsuario($usuario);

            $postagem = new Post();
            $postagem->setId($reg['idPostagem']);
            $comentario->setPostagem($postagem);

            array_push($comentarios, $comentario);
        }

        return $comentarios;
    }
}
