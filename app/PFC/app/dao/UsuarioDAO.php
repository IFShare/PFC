<?php

#INCLUDES

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Uusario.php");

class UsuarioDAO
{

    #LISTAGEM DE USUÁRIOS

    public function list()
    {

        $conn = Connection::getConnection();

        $sql = "SELECT * FROM usuario u ORDER BY u.nome_usuario";
        $stm = $conn->prepare($sql);

        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapUsuarios($result);
    }

    ####################################################################################

    #INSERÇÃO DE USUÁRIO

    public function insert(Usuario $usuario)
    {
        $conn = Connection::getConnection();

        $sql = "INSERT INTO usuario (nome_completo, nome_usuario, email, senha " .
            " bio, tipoUsuario, data_criacao, matricula)" .

            " VALUES (:nomeCompleto, :nomeUsuario, :email, :senha, :bio .
               :tipoUsuario, :data_criacao, :matricula)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeCompleto", $usuario->getNomeSobrenome());
        $stm->bindValue("nomeUsuario", $usuario->getNomeUsuario());
        $stm->bindValue("email", $usuario->getEmail());
        $senhaCript = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
        $stm->bindValue("senha", $senhaCript);
        $stm->bindValue("bio", $usuario->getBio());
        $stm->bindValue("tipoUsuario", $usuario->getTipoUsuario());
        $stm->bindValue("data_criacao", $usuario->getDataCriacao());
        $stm->bindValue("matricula", $usuario->getMatricula());

        $stm->execute();
    }

    ####################################################################################

    //ATUALIZAÇÃO DE USUÁRIO
    public function update(Usuario $usuario)
    {
        $conn = Connection::getConnection();

        $sql = "UPDATE usuario SET nome_completo = :nomeCompleto, nome_usuario = :nomeUsuario," .
            " email = :email, senha = :senha, bio = :bio = tipoUsuario = :tipoUsuario," .
            " data_criacao = :data_criacao, matricula = :matricula " .
            " WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeCompleto", $usuario->getNomeSobrenome());
        $stm->bindValue("nomeUsuario", $usuario->getNomeUsuario());
        $stm->bindValue("email", $usuario->getEmail());
        $senhaCript = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
        $stm->bindValue("senha", $senhaCript);
        $stm->bindValue("bio", $usuario->getBio());
        $stm->bindValue("tipoUsuario", $usuario->getTipoUsuario());
        $stm->bindValue("data_criacao", $usuario->getDataCriacao());
        $stm->bindValue("matricula", $usuario->getMatricula());
        $stm->bindValue("id", $usuario->getId());

        $stm->execute();
    }

    ####################################################################################

    #DELETA UM USUÁRIO PELO ID

    public function deleteById(int $id)
    {
        $conn = Connection::getConnection();

        $sql = "DELETE FROM usuario WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    ####################################################################################

    #BUSCA UM USUÁRIO PELO ID

    public function findById(int $id)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM usuario u WHERE u.id = ?";
        $stm = $conn->prepare($sql);

        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if (count($usuarios) == 1)
            return $usuarios[0];
        elseif (count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findById()" .
            " - Erro: mais de um usuário encontrado.");
    }

    ####################################################################################

    #CONVERTE REGISTRO DA BASE EM OBJETO

    private function mapUsuarios($result)
    {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['id']);
            $usuario->setNomeSobrenome($reg['nome_completo']);
            $usuario->setNomeUsuario($reg['nome_usuario']);
            $usuario->setEmail($reg['email']);
            $usuario->setSenha($reg['senha']);
            $usuario->setBio($reg['bio']);
            $usuario->setTipoUsuario($reg['tipoUsuario']);
            $usuario->setDataCriacao($reg['data_criacao']);
            $usuario->setMatricula($reg['matricula']);
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }
}
