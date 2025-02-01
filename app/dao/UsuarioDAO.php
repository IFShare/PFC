<?php

#INCLUDES

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Usuario.php");

class UsuarioDAO
{

    #LISTAGEM DE USUÁRIOS

    public function list()
    {

        $conn = Connection::getConnection();

        $sql = "SELECT * FROM usuario u ORDER BY u.id DESC";
        $stm = $conn->prepare($sql);

        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapUsuarios($result);
    }

    public function search($data)
    {

        $conn = Connection::getConnection();

        $sql = "SELECT * FROM usuario u
                WHERE u.id LIKE :search
                or u.nomeSobrenome LIKE :search
                or u.nomeUsuario LIKE :search
                or u.email LIKE :search
                or u.tipoUsuario LIKE :search 
                or u.status LIKE :search 
                ORDER BY u.id DESC";
        $stm = $conn->prepare($sql);
        $stm->bindValue(':search', "%$data%");

        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapUsuarios($result);
    }

    public function searchPerfis($data)
    {

        $conn = Connection::getConnection();

        $sql = "SELECT * FROM usuario
        WHERE usuario.nomeUsuario LIKE :search
        OR usuario.id LIKE :search
        OR usuario.nomeSobrenome LIKE :search
        ORDER BY usuario.id DESC
        LIMIT 4";


        $stm = $conn->prepare($sql);
        $stm->bindValue(':search', "%$data%");

        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapUsuarios($result);
    }

    public function countUsersNaoVerificados()
    {

        $conn = Connection::getConnection();

        $sql = "SELECT COUNT(*) total FROM usuario u WHERE u.status = 'NAOVERIFICADO'";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["total"];
    }

    ####################################################################################

    #INSERÇÃO DE USUÁRIO

    public function insert(Usuario $usuario)
    {
        $conn = Connection::getConnection();

        $sql = "INSERT INTO usuario (nomeSobrenome, nomeUsuario, email, senha, " .
            " fotoPerfil, bio, tipoUsuario, dataCriacao, compMatricula, status, isEstudante)" .

            " VALUES (:nomeSobrenome, :nomeUsuario, :email, :senha, :fotoPerfil, :bio, " .
            " :tipoUsuario, CURRENT_DATE, :compMatricula, :status, :isEstudante)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeSobrenome", $usuario->getNomeSobrenome());
        $stm->bindValue("nomeUsuario", $usuario->getNomeUsuario());
        $stm->bindValue("email", $usuario->getEmail());
        $senhaCript = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
        $stm->bindValue("senha", $senhaCript);
        $stm->bindValue("fotoPerfil", $usuario->getFotoPerfil());
        $stm->bindValue("bio", $usuario->getBio());
        $stm->bindValue("tipoUsuario", $usuario->getTipoUsuario());
        $stm->bindValue("compMatricula", $usuario->getCompMatricula());
        $stm->bindValue("status", $usuario->getStatus());
        $stm->bindValue("isEstudante", $usuario->getIsEstudante());



        $stm->execute();
    }

    ####################################################################################

    //ATUALIZAÇÃO DE USUÁRIO

    public function update(Usuario $usuario)
    {
        $conn = Connection::getConnection();

        $sql = "UPDATE usuario SET nomeSobrenome = :nomeSobrenome, nomeUsuario = :nomeUsuario," .
            " email = :email, fotoPerfil = :fotoPerfil, bio = :bio, tipoUsuario = :tipoUsuario," .
            " status = :status, isEstudante = :isEstudante" .
            " WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeSobrenome", $usuario->getNomeSobrenome());
        $stm->bindValue("nomeUsuario", $usuario->getNomeUsuario());
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("fotoPerfil", $usuario->getFotoPerfil());
        $stm->bindValue("bio", $usuario->getBio());
        $stm->bindValue("tipoUsuario", $usuario->getTipoUsuario());
        $stm->bindValue("status", $usuario->getStatus());
        $stm->bindValue("isEstudante", $usuario->getIsEstudante());
        $stm->bindValue("id", $usuario->getId());

        $stm->execute();
    }

    public function updatePerfil(Usuario $usuario)
    {
        $conn = Connection::getConnection();

        $sql = "UPDATE usuario SET nomeSobrenome = :nomeSobrenome, 
            nomeUsuario = :nomeUsuario, 
            bio = :bio 
            WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue(":nomeSobrenome", $usuario->getNomeSobrenome());
        $stm->bindValue(":nomeUsuario", $usuario->getNomeUsuario());
        $stm->bindValue(":bio", $usuario->getBio());
        $stm->bindValue(":id", $usuario->getId());

        $stm->execute();
    }


    public function updateFotoPerfil(Usuario $usuario)
    {
        $conn = Connection::getConnection();

        $sql = "UPDATE usuario SET fotoPerfil = :fotoPerfil" .
            " WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("fotoPerfil", $usuario->getFotoPerfil());
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

    #CONTA O NÚMERO DE USUÁRIOS DO SISTEMA

    public function count()
    {
        $conn = Connection::getConnection();

        $sql = "SELECT COUNT(*) total FROM usuario";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["total"];
    }

    ####################################################################################

    #VERIFICA SE UM EMAIL JÁ FOI CADASTRADO.

    public function emailJaCadastrado(string $email, ?int $idUsuario): bool
    {
        $conn = Connection::getConnection();
        $sql = "SELECT COUNT(*) as total FROM usuario WHERE email = :email and id != :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue(':email', $email);
        $stm->bindValue(':id', ($idUsuario ? $idUsuario : 0));
        $stm->execute();
        $result = $stm->fetch();

        return $result['total'] > 0;
    }

    ####################################################################################

    #VERIFICA SE UM EMAIL JÁ FOI CADASTRADO.

    public function nomeUsuarioCadastrado(string $nomeUsuario, ?int $idUsuario): bool
    {
        $conn = Connection::getConnection();
        $sql = "SELECT COUNT(*) as total FROM usuario WHERE nomeUsuario = :nomeUsuario and id != :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue(':nomeUsuario', $nomeUsuario);
        $stm->bindValue(':id', ($idUsuario ? $idUsuario : 0));
        $stm->execute();
        $result = $stm->fetch();

        return $result['total'] > 0;
    }

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

    //Método para buscar um usuário por seu login e senha
    public function findByEmailSenha(string $email, string $senha)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM usuario u" .
            " WHERE BINARY u.email = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$email]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if (count($usuarios) == 1) {
            //Tratamento para senha criptografada
            if (password_verify($senha, $usuarios[0]->getSenha()))
                //if ($usuarios[0]->getSenha())
                return $usuarios[0];
            else
                return null;
        } elseif (count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByEmailnSenha()" .
            " - Erro: mais de um usuário encontrado.");
    }

    public function findByEmail(string $email)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM usuario u" .
            " WHERE BINARY u.email = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$email]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);
        return $usuarios[0];
    }

    public function findByNomeUsuario(string $nomeUsuario)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM usuario u" .
            " WHERE u.nomUsuario = ?";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll([$nomeUsuario]);

        $usuarios = $this->mapUsuarios($result);
        return $usuarios[0];
    }

    public function buscarSenhaPorId($id)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT senha FROM usuario WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['senha'] ?? null;
    }

    //Método para atualizar um Usuario
    public function updateSenha(Usuario $usuario)
    {
        $conn = Connection::getConnection();

        $sql = "UPDATE usuario SET senha = :senha" .
            " WHERE id = :id";

        $stm = $conn->prepare($sql);
        $senhaCript = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
        $stm->bindValue("senha", $senhaCript);
        $stm->bindValue("id", $usuario->getId());
        $stm->execute();
    }

    public function likedPosts($idUsuario)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT curtida.*, postagem.imagem
        FROM curtida 
        JOIN postagem ON curtida.idPostagem = postagem.id
        WHERE curtida.idUsuario = :idUsuario";
        $stm = $conn->prepare($sql);
        $stm->bindValue(':idUsuario', $idUsuario);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result;
    }

    public function countPostsByUserId($id)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT COUNT(*) AS total
        FROM postagem WHERE postagem.idUsuario = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue(':id', "$id");
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["total"];
    }

    public function countLikesByUserId($id)
    {
        $conn = Connection::getConnection();

        $sql = "SELECT COUNT(c.id) AS total
        FROM curtida c
        INNER JOIN postagem p ON c.idPostagem = p.id
        WHERE p.idUsuario = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();
        $result = $stm->fetchAll();
        return $result[0]["total"];
    }


    ####################################################################################

    #CONVERTE REGISTRO DA BASE EM OBJETO

    private function mapUsuarios($result)
    {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['id']);
            $usuario->setNomeSobrenome($reg['nomeSobrenome']);
            $usuario->setNomeUsuario($reg['nomeUsuario']);
            $usuario->setEmail($reg['email']);
            $usuario->setSenha($reg['senha']);
            $usuario->setFotoPerfil($reg['fotoPerfil']);
            $usuario->setBio($reg['bio']);
            $usuario->setTipoUsuario($reg['tipoUsuario']);
            $usuario->setDataCriacao($reg['dataCriacao']);
            $usuario->setCompMatricula($reg['compMatricula']);
            $usuario->setStatus($reg['status']);
            $usuario->setIsEstudante($reg['isEstudante']);

            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }
}
