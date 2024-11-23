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
                or u.nomeCompleto LIKE :search
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

        $sql = "INSERT INTO usuario (nomeCompleto, nomeUsuario, email, senha, " .
            " fotoPerfil, bio, tipoUsuario, dataCriacao, compMatricula, status, isEstudante)" .

            " VALUES (:nomeCompleto, :nomeUsuario, :email, :senha, :fotoPerfil, :bio, " .
            " :tipoUsuario, CURRENT_DATE, :compMatricula, :status, :isEstudante)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeCompleto", $usuario->getNomeSobrenome());
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

        $sql = "UPDATE usuario SET nomeCompleto = :nomeCompleto, nomeUsuario = :nomeUsuario," .
            " email = :email, fotoPerfil = :fotoPerfil, bio = :bio, tipoUsuario = :tipoUsuario," .
            " status = :status, isEstudante = :isEstudante" .
            " WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeCompleto", $usuario->getNomeSobrenome());
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


    public function abrirPdf(int $id)
    {
        $conn = Connection::getConnection();

        // Preparar a consulta
        $sql = "SELECT nomeUsuario, compMatricula FROM usuario WHERE id = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue(":id", $id);
        $stm->execute();

        // Verifica se há resultados
        $usuario = $stm->fetch();
        var_dump($usuario);

        if ($usuario) {
            $fileContent = $usuario['compMatricula']; // Conteúdo do arquivo (provavelmente o caminho)

            // Verificar se o arquivo existe
            if (file_exists(PATH_ARQUIVOS_COMPMATRICULA . '/' . $fileContent)) {
                // Forçar o download do arquivo
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="' . $fileContent);
                header('Content-Length: ' . filesize(PATH_ARQUIVOS_COMPMATRICULA . '/' . $fileContent));
                readfile(PATH_ARQUIVOS_COMPMATRICULA . '/' . $fileContent);
                exit;
            } else {
                echo "Arquivo não encontrado!";
            }
        } else {
            echo "Usuário não encontrado.";
        }
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

    ####################################################################################

    #CONVERTE REGISTRO DA BASE EM OBJETO

    private function mapUsuarios($result)
    {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['id']);
            $usuario->setNomeSobrenome($reg['nomeCompleto']);
            $usuario->setNomeUsuario($reg['nomeUsuario']);
            $usuario->setEmail($reg['email']);
            $usuario->setSenha($reg['senha']);
            $usuario->setBio($reg['fotoPerfil']);
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
