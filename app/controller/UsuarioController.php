<?php

require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../service/ArquivoService.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/enum/TipoUsuario.php");


class UsuarioController extends Controller
{

    private UsuarioDAO  $usuarioDao;
    private UsuarioService  $usuarioService;
    private ArquivoService  $arqService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;

        if (! $this->usuarioIsAdmin()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();
        $this->arqService = new ArquivoService();

        $this->handleAction();
    }

    protected function list()
    {

        $usuarios = $this->usuarioDao->list();
        //print_r($usuarios);
        $dados["lista"] = $usuarios;

        $this->loadView("usuario/list.php", $dados, []);
    }


    protected function save()
    {
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nomeSobrenome = isset($_POST['nomeSobrenome']) ? trim($_POST['nomeSobrenome']) : NULL;
        $nomeUsuario = isset($_POST['nomeUsuario']) ? trim($_POST['nomeUsuario']) : NULL;
        $email = isset($_POST['email']) ? trim($_POST['email']) : NULL;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : NULL;
        $imagem = isset($_FILES['imagem']) ? $_FILES['imagem'] : null;
        $tipoUsuario = isset($_POST['tipoUsuario']) ? $_POST['tipoUsuario'] : NULL;
        $dataCriacao = ($dados["id"] == 0) ? date('Y-m-d') : NULL;  // Captura a data de criação apenas para novos registros
        
        
        //Cria objeto Usuario
        $usuario = new Usuario();

        $usuario->setId($dados["id"]);
        
        $usuario->setNomeSobrenome($nomeSobrenome);
        $usuario->setNomeUsuario($nomeUsuario);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setBio(null);
        $usuario->setTipoUsuario($tipoUsuario);
        $usuario->setDataCriacao($dataCriacao);
        $usuario->setCompMatricula(null);

        //Validar os dados
        $erros = $this->usuarioService->validarDados($usuario);
        if (empty($erros)) {
            $nomeArquivo = $this->arqService->salvarArquivo($imagem);
            if ($nomeArquivo)
                $usuario->setFotoPerfil($nomeArquivo);
            else
                $erros = array("Erro ao salvar o arquivo da postagem.");

            try {

                if ($dados["id"] == 0)  //Inserindo
                    $this->usuarioDao->insert($usuario);
                else { //Alterando
                    $this->usuarioDao->update($usuario);
                }
            } catch (PDOException $e) {
                //echo $e->getMessage();
                $erros["banco"] = "Erro ao salvar o usuário na base de dados.<br>Tente novamente mais tarde.";
            }
        }

        //Se há erros, volta para o formulário

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["usuario"] = $usuario;
        $dados["tipoUsuario"] = TipoUsuario::getAllAsArray();

        //echo $msgsErro;
        //exit;
        $this->loadView("usuario/form.php", $dados, $erros);
    }

    //Método create
    protected function create()
    {
        //echo "Chamou o método create!";

        $dados["id"] = 0;
        $dados["tipoUsuario"] = TipoUsuario::getAllAsArray();
        $this->loadView("usuario/form.php", $dados, []);
    }



    //Método edit
    protected function edit()
    {

        if (! $this->usuarioIsAdminStudent()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        $usuario = $this->findUsuarioById();

        if ($usuario) {
            //Setar os dados
            $dados["id"] = $usuario->getId();
            $dados["usuario"] = $usuario;
            $dados["tipoUsuario"] = TipoUsuario::getAllAsArray();

            $this->loadView("usuario/form.php", $dados, []);
        } else
            $this->list("Usuário não encontrado");
    }

    protected function saveEdit() {}


    //Método para excluir
    protected function delete()
    {
        if (! $this->usuarioIsAdminStudent()) {
            header("location: " . ACESSO_NEGADO);
            exit;
        }

        $usuario = $this->findUsuarioById();
        if ($usuario) {
            //Excluir
            $this->usuarioDao->deleteById($usuario->getId());
            $this->list("", "Usuário excluído com sucesso!");
        } else {
            //Mensagem q não encontrou o usuário
            $this->list("Usuário não encontrado!");
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
        $this->loadView("usuario/perfil.php", [], []);
    }
}

#Criar objeto da classe para assim executar o construtor
new UsuarioController();
