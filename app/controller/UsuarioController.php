<?php

require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/PostagemDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../service/EditPerfilService.php");
require_once(__DIR__ . "/../service/EditSenhaService.php");
require_once(__DIR__ . "/../service/FotoPerfilService.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/enum/TipoUsuario.php");
require_once(__DIR__ . "/../model/enum/Status.php");
require_once(__DIR__ . "/../model/enum/IsEstudante.php");

class UsuarioController extends Controller
{

    private UsuarioDAO  $usuarioDao;
    private PostagemDAO  $postDao;
    private UsuarioService  $usuarioService;
    private EditPerfilService  $editperfilservice;
    private FotoPerfilService  $fotoPerfilService;
    private EditSenhaService  $editSenhaservice;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;

        $this->usuarioDao = new UsuarioDAO();
        $this->postDao = new PostagemDAO();
        $this->usuarioService = new UsuarioService();
        $this->editperfilservice = new EditPerfilService();
        $this->fotoPerfilService = new FotoPerfilService();
        $this->editSenhaservice = new EditSenhaService();

        $this->handleAction();
    }

    protected function list()
    {
        if (! $this->usuarioIsAdmin()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        $data = isset($_GET['search']) ? $_GET['search'] : NULL;

        if (!empty($data)) {
            $usuarios = $this->usuarioDao->search($data);
        } else {
            $usuarios = $this->usuarioDao->list();
        }

        $naoVerifiacdos = $this->usuarioDao->countUsersNaoVerificados();

        //print_r($usuarios);
        $dados["dadoPesquisa"] = $data;
        $dados["lista"] = $usuarios;
        $dados["naoVerificados"] = $naoVerifiacdos;

        $this->loadView("usuario/list.php", $dados, []);
    }

    protected function listPerfis()
    {
        $data = isset($_GET['search']) ? $_GET['search'] : NULL;
        $perfis = []; // Inicializa como array vazio

        if (!empty($data)) {
            $perfis = $this->usuarioDao->searchPerfis($data);
        }

        $dados['listPerfis'] = $perfis;

        $this->loadView("home/home.php", $dados, []);
    }

    protected function save()
    {

        if (! $this->usuarioIsAdmin()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nomeSobrenome = isset($_POST['nomeSobrenome']) ? trim($_POST['nomeSobrenome']) : NULL;
        $nomeUsuario = isset($_POST['nomeUsuario']) ? trim($_POST['nomeUsuario']) : NULL;
        $email = isset($_POST['email']) ? trim($_POST['email']) : NULL;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : NULL;
        $tipoUsuario = isset($_POST['tipoUsuario']) ? $_POST['tipoUsuario'] : NULL;
        $isEstudante = isset($_POST['isEstudante']) ? trim($_POST['isEstudante']) : NULL;
        $status = isset($_POST['status']) ? trim($_POST['status']) : NULL;
        $data = isset($_GET['search']) ? $_GET['search'] : NULL;
        $fotoPerfil = "/defaultPfp.png";

        //Cria objeto Usuario
        $usuario = new Usuario();

        $usuario->setId($dados["id"]);
        $usuario->setNomeSobrenome($nomeSobrenome);
        $usuario->setNomeUsuario($nomeUsuario);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setFotoPerfil($fotoPerfil);
        $usuario->setBio(null);
        $usuario->setTipoUsuario($tipoUsuario);
        $usuario->setIsEstudante($isEstudante);
        $usuario->setStatus($status);

        //Validar os dados
        $erros = $this->usuarioService->validarDados($usuario, '');
        if (empty($erros)) {
            try {
                if ($dados["id"] == 0) //Inserindo
                    $this->usuarioDao->insert($usuario);
                else { //Alterando
                    $this->usuarioDao->update($usuario);
                }

                header("location: UsuarioController.php?action=list&search=$data");



                exit;
            } catch (PDOException $e) {
                //echo $e->getMessage();
                $erros['banco'] = "Erro ao salvar o usuário na base de dados." . $e;
            }
        }

        //Se há erros, volta para o formulário

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["usuario"] = $usuario;
        $dados["tipoUsuario"] = TipoUsuario::getAllAsArray();
        $dados["isEstudante"] = IsEstudante::getAllAsArray();
        $dados["status"] = Status::getAllAsArray();

        //echo $msgsErro;
        //exit;
        $this->loadView("usuario/form.php", $dados, $erros);
    }

    //Método create
    protected function create()
    {

        if (! $this->usuarioIsAdmin()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }
        //echo "Chamou o método create!";

        $dados["id"] = 0;
        $dados["tipoUsuario"] = TipoUsuario::getAllAsArray();
        $dados["isEstudante"] = IsEstudante::getAllAsArray();
        $dados["status"] = Status::getAllAsArray();
        $this->loadView("usuario/form.php", $dados, []);
    }

    protected function editPerfil()
    {
        $usuario = $this->findUsuarioById();
        if ($usuario) {
            //Setar os dados
            $dados["id"] = $usuario->getId();
            $dados["usuario"] = $usuario;

            $this->loadView("usuario/editPerfil.php", $dados, []);
        }
    }

    protected function editSenha()
    {
        $usuario = $this->findUsuarioById();
        if ($usuario) {
            //Setar os dados
            $dados["id"] = $usuario->getId();
            $dados["usuario"] = $usuario;

            $this->loadView("usuario/editSenha.php", $dados, []);
        }
    }

    protected function saveSenha()
    {
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $senhaAtual = isset($_POST['senhaAtual']) ? trim($_POST['senhaAtual']) : NULL;
        $senhaNova = isset($_POST['senhaNova']) ? trim($_POST['senhaNova']) : NULL;
        $confirmSenha = isset($_POST['confirmSenha']) ? trim($_POST['confirmSenha']) : NULL;
        $usuario = new Usuario();

        $usuario->setId($dados["id"]);
        $usuario->setSenha($senhaAtual);
        //Validar os dados
        $erros = $this->editSenhaservice->validarDados($usuario, $senhaNova, $confirmSenha);

        if (empty($erros)) {
            try {
                // Criptografar a nova senha antes de salvar
                $usuario->setSenha($senhaNova);

                $this->usuarioDao->updateSenha($usuario);
                header("location: /PFC/app/controller/UsuarioController.php?action=perfil&id=" . $usuario->getId());
            } catch (PDOException $e) {
                //echo $e->getMessage();
                $erros['banco'] = "Erro ao salvar o usuário na base de dados." . $e;
            }
        }

        //Se há erros, volta para o formulário

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["usuario"] = $usuario;
        $dados["senhaNova"] = $senhaNova;
        $dados["confirmSenha"] = $confirmSenha;

        $this->loadView("usuario/editSenha.php", $dados, $erros);
    }

    protected function saveFotoPerfil()
    {
        $id = $_SESSION[SESSAO_USUARIO_ID];
        $imagem = isset($_FILES['imagem']) ? $_FILES['imagem'] : null;

        $usuario = new Usuario();

        // Buscar o usuário atual e obter a foto de perfil existente
        $usuarioAtual = $this->usuarioDao->findById($id);
        $fotoPerfilAtual = $usuarioAtual ? $usuarioAtual->getFotoPerfil() : null;


        //Validar os dados
        $nomeArquivo = $this->fotoPerfilService->salvarArquivo($imagem);
        if ($nomeArquivo) {
            $usuario->setId($id);
            $usuario->setFotoPerfil($nomeArquivo);
        } else
            $erros = array("Erro ao salvar o arquivo da postagem.");

        if (empty($erros)) {
            //Persiste o objeto
            try {
                if ($fotoPerfilAtual && $fotoPerfilAtual !== "/defaultPfp.png") {
                    $caminhoCompleto =  $_SERVER['DOCUMENT_ROOT'] . "/PFC/arquivos/fotosPerfil/" . $fotoPerfilAtual;
                    if (file_exists($caminhoCompleto)) {
                        unlink($caminhoCompleto);
                    }
                }

                // Atualizar o banco de dados com a nova foto
                $this->usuarioDao->updateFotoPerfil($usuario);

                // Redirecionar para o perfil
                header("location: /PFC/app/controller/UsuarioController.php?action=perfilUsuario");
                exit;
            } catch (PDOException $e) {
                $erros = array("Erro ao salvar a postagem na base de dados: " . $e->getMessage());
            }
        }
        //Se há erros, volta para o formulário

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["usuario"] = $usuario;

        header("location: /PFC/app/controller/UsuarioController.php?action=perfilUsuario");
    }

    protected function savePerfil()
    {
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nomeSobrenome = isset($_POST['nomeSobrenome']) ? trim($_POST['nomeSobrenome']) : NULL;
        $nomeUsuario = isset($_POST['nomeUsuario']) ? trim($_POST['nomeUsuario']) : NULL;
        $bio = trim($_POST['bio']) ? trim($_POST['bio']) : NULL;
        $usuario = new Usuario();

        $usuario->setId($dados["id"]);
        $usuario->setNomeSobrenome($nomeSobrenome);
        $usuario->setNomeUsuario($nomeUsuario);
        $usuario->setFotoPerfil(null);
        $usuario->setBio($bio);

        //Validar os dados
        $erros = $this->editperfilservice->validarDados($usuario);

        if (empty($erros)) {
            try {
                $this->usuarioDao->updatePerfil($usuario);
                header("location: /PFC/app/controller/UsuarioController.php?action=perfil&id=" . $usuario->getId());
            } catch (PDOException $e) {
                //echo $e->getMessage();
                $erros['banco'] = "Erro ao salvar o usuário na base de dados." . $e;
            }
        }

        //Se há erros, volta para o formulário

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["usuario"] = $usuario;

        $this->loadView("usuario/editPerfil.php", $dados, $erros);
    }

    //Método edit
    protected function edit()
    {

        if (! $this->usuarioIsAdmin()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        if (! $this->usuarioIsAdminStudent()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        $usuario = $this->findUsuarioById();

        if ($usuario) {
            $data = isset($_GET['search']) ? $_GET['search'] : NULL;
            //Setar os dados
            $dados["id"] = $usuario->getId();
            $dados["usuario"] = $usuario;
            $dados["tipoUsuario"] = TipoUsuario::getAllAsArray();
            $dados["status"] = Status::getAllAsArray();
            $dados["isEstudante"] = IsEstudante::getAllAsArray();
            $dados["data"] = $data;

            $this->loadView("usuario/form.php", $dados, []);
        } else
            $this->list("Usuário não encontrado");
    }


    //Método para excluir
    protected function delete()
    {

        if (! $this->usuarioIsAdmin()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        $usuario = $this->findUsuarioById();
        if ($usuario) {
            //Excluir
            $this->usuarioDao->deleteById($usuario->getId());
            header("location: UsuarioController.php?action=list");
        } else {
            //Mensagem q não encontrou o usuário
            $this->list("Usuário não encontrado!");
        }
    }

    protected function inactivateActivateUser()
    {

        if (! $this->usuarioIsAdmin()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        $usuario = $this->findUsuarioById();
        if ($usuario) {

            if ($usuario->getStatus() !== "INATIVO") {
                $this->usuarioDao->inactivateById($usuario->getId());
                header("location: UsuarioController.php?action=list");
            } elseif ($usuario->getStatus() == "INATIVO") {
                $this->usuarioDao->activateById($usuario->getId());
                header("location: UsuarioController.php?action=list");
            }
        } else {
            //Mensagem q não encontrou o usuário
            echo "Usuário não encontrado.";
        }
    }

    protected function verifyAsAdm()
    {
        if (! $this->usuarioIsAdmin()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        $usuario = $this->findUsuarioById();
        if ($usuario) {
            $this->usuarioDao->verifyAsAdm($usuario->getId());
            header("location: UsuarioController.php?action=list");
        } else {
            //Mensagem q não encontrou o usuário
            echo "Usuário não encontrado.";
        }
    }

    protected function verifyAsStudent()
    {
        if (! $this->usuarioIsAdmin()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        $usuario = $this->findUsuarioById();
        if ($usuario) {
            $this->usuarioDao->verifyAsStudent($usuario->getId());
            header("location: UsuarioController.php?action=list");
        } else {
            //Mensagem q não encontrou o usuário
            echo "Usuário não encontrado.";
        }
    }

    protected function verifyAsUser()
    {
        if (! $this->usuarioIsAdmin()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        $usuario = $this->findUsuarioById();
        if ($usuario) {
            $this->usuarioDao->verifyAsUser($usuario->getId());
            header("location: UsuarioController.php?action=list");
        } else {
            //Mensagem q não encontrou o usuário
            echo "Usuário não encontrado.";
        }
    }

    //Método para buscar o usuário com base no ID recebido por parâmetro GET
    private function findUsuarioById()
    {
        $id = 0;
        if (isset($_GET['id']))
            $id = $_GET['id'];

        $usuario = $this->usuarioDao->findById($id);
        return $usuario;
    }

    protected function perfil()
    {
        $id = 0;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $postagens = $this->postDao->listPostByUserId($id);
        $totalPostagens = $this->usuarioDao->countPostsByUserId($id);
        $totalCurtidas = $this->usuarioDao->countLikesByUserId($id);
        $usuario = $this->usuarioDao->findById($id);
        $likedPosts = $this->usuarioDao->likedPosts($id);

        $dados['postagens'] = $postagens;
        $dados['totalPostagens'] = $totalPostagens;
        $dados['totalCurtidas'] = $totalCurtidas;
        $dados['usuario'] = $usuario;
        $dados['likedPosts'] = $likedPosts;


        $this->loadView("usuario/perfil.php", $dados, []);
    }

    protected function perfilUsuario()
    {
        $id = $_SESSION[SESSAO_USUARIO_ID];

        $postagens = $this->postDao->listPostByUserId($id);
        $totalPostagens = $this->usuarioDao->countPostsByUserId($id);
        $totalCurtidas = $this->usuarioDao->countLikesByUserId($id);
        $usuario = $this->usuarioDao->findById($id);
        $likedPosts = $this->usuarioDao->likedPosts($id);

        $dados['postagens'] = $postagens;
        $dados['totalPostagens'] = $totalPostagens;
        $dados['totalCurtidas'] = $totalCurtidas;
        $dados['usuario'] = $usuario;
        $dados['likedPosts'] = $likedPosts;


        $this->loadView("usuario/perfil.php", $dados, []);
    }
}

#Criar objeto da classe para assim executar o construtor
new UsuarioController();
