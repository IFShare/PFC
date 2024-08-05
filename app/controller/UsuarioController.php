<?php

require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/enum/TipoUsuario.php");


class UsuarioController extends Controller
{

    private UsuarioDAO  $usuarioDao;
    private UsuarioService  $usuarioService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;

        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "")
    {
        $usuarios = $this->usuarioDao->list();
        //print_r($usuarios);
        $dados["lista"] = $usuarios;

        $this->loadView("usuario/list.php", $dados, $msgErro, $msgSucesso);
    }


    protected function save()
    {
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nomeSobrenome = trim($_POST['nomeSobrenome']) ? trim($_POST['nomeSobrenome']) : NULL;
        $nomeUsuario = trim($_POST['nomeUsuario']) ? trim($_POST['nomeUsuario']) : NULL;
        $email = trim($_POST['email']) ? trim($_POST['email']) : NULL;
        $senha = trim($_POST['senha']) ? trim($_POST['senha']) : NULL;
        $bio = NULL;
        $tipoUsuario = trim($_POST['tipoUsuario']) ? trim($_POST['tipoUsuario']) : NULL;
        $dataCriacao = trim($_POST['dataCriacao']) ? trim($_POST['dataCriacao']) : NULL;
        $compMatricula = trim($_POST['compMatricula']) ? trim($_POST['compMatricula']) : NULL;


        //Cria objeto Usuario
        $usuario = new Usuario();
        $usuario->setNomeSobrenome($nomeSobrenome);
        $usuario->setNomeUsuario($nomeUsuario);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setBio($bio);
        $usuario->setSenha($tipoUsuario);
        $usuario->setSenha($dataCriacao);
        $usuario->setSenha($compMatricula);



        //Validar os dados
        $erros = $this->usuarioService->validarDados($usuario);
        if (empty($erros)) {
            //Persiste o objeto
            try {

                if ($dados["id"] == 0)  //Inserindo
                    $this->usuarioDao->insert($usuario);
                else { //Alterando
                    $usuario->setId($dados["id"]);
                    $this->usuarioDao->update($usuario);
                }

                //TODO - Enviar mensagem de sucesso
                $msg = "Usuário salvo com sucesso.";
                $this->list("", $msg);
                exit;
            } catch (PDOException $e) {
                $erros = "[Erro ao salvar o usuário na base de dados.]";
            }
        }

        //Se há erros, volta para o formulário

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["usuario"] = $usuario;
        $dados["tipoUsuario"] = TipoUsuario::getAllAsArray();

        $msgsErro = implode("<br>", $erros);
        $this->loadView("usuario/form.php", $dados, $msgsErro);
    }

    //Método create
    protected function create()
    {
        //echo "Chamou o método create!";

        $dados["id"] = 0;
        $dados["tipoUsuario"] = TipoUsuario::getAllAsArray();
        $this->loadView("usuario/form.php", $dados);
    }
}
