<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} #Classe controller para a Logar do sistema
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/LoginService.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../service/CompMatriculaService.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/enum/TipoUsuario.php");
require_once(__DIR__ . "/../model/enum/Status.php");


class LoginController extends Controller
{

    private LoginService $loginService;
    private UsuarioDAO $usuarioDao;
    private UsuarioService $usuarioService;
    private CompMatriculaService  $matriculaService;

    public function __construct()
    {
        $this->loginService = new LoginService();
        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();
        $this->matriculaService = new CompMatriculaService();

        $this->handleAction();
    }

    protected function acessoNegado()
    {

        $this->loadView("include/msgNegado.php", [], []);
    }

    protected function login()
    {
        $this->loadView("login/login.php", [], []);
    }

    /* Método para logar um usuário a partir dos dados informados no formulário */
    protected function logon()
    {
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;

        $usuario = $this->usuarioDao->findByEmailSenha($email, $senha);
        $usuarioEmail = $this->usuarioDao->findByEmail($email);

        //Validar os campos
        $erros = $this->loginService->validarCampos($usuarioEmail, $email, $senha);
        if (empty($erros)) {
            //Valida o login a partir do banco de dados
            if ($usuario) {
                //Se encontrou o usuário, salva a sessão e redireciona para a HOME do sistema
                $this->loginService->salvarUsuarioSessao($usuario);
                if ($usuario->getStatus() == "NAOVERIFICADO" && $usuario->getTipoUsuario() == "USUARIO")
                    $_SESSION['login_naoverificado'] = true;

                header("location: " . HOME_PAGE);
                exit;
            } elseif($usuarioEmail) {
                $erros['inativoEmail'] = "<p class='mb-1 fw-bold text-danger text-center'>Email cadastrado inativo<br>Verifique com um administrador</p>";
            }
            else {
                $erros['ambos'] = "<p class='mb-1 fw-bold text-danger text-center'>Login ou senha informados são inválidos!</p>";
            }
        }

        //Se há erros, volta para o formulário            
        $loginErros = $erros;
        $dados["email"] = $email;
        $dados["senha"] = $senha;

        $this->loadView("login/login.php", $dados, $loginErros);
    }

    /* Método para logar um usuário a partir dos dados informados no formulário */
    protected function logout()
    {
        $this->loginService->removerUsuarioSessao();

        header("location: " . "/PFC");
    }


    protected function createCadastro()
    {
        $this->loadView("login/cadastro.php", [], []);
    }

    protected function saveCadastro()
    {
        //Captura os dados do formulário
        $nomeSobrenome = isset($_POST['nomeSobrenome']) ? trim($_POST['nomeSobrenome']) : NULL;
        $nomeUsuario = isset($_POST['nomeUsuario']) ? trim($_POST['nomeUsuario']) : NULL;
        $email = isset($_POST['email']) ? trim($_POST['email']) : NULL;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : NULL;
        $compMatricula = isset($_FILES['compMatricula']) ? $_FILES['compMatricula'] : NULL;
        $isEstudante = isset($_POST['isEstudante']) ? trim($_POST['isEstudante']) : NULL;
        $fotoPerfil = "/defaultPfp.png";

        //echo $isEstudante;
        //exit;

        //Cria objeto Usuario
        $usuario = new Usuario();
        $usuario->setNomeSobrenome($nomeSobrenome);
        $usuario->setNomeUsuario($nomeUsuario);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setFotoPerfil($fotoPerfil);
        $usuario->setBio(null);
        $usuario->setTipoUsuario(TipoUsuario::USUARIO);
        $usuario->setIsEstudante($isEstudante);
        $usuario->setStatus(Status::ATIVO);

        //Validar os dados
        $erros = $this->usuarioService->validarDados($usuario, $compMatricula);

        if (empty($erros) && isset($compMatricula)) {
            $nomeArquivo = $this->matriculaService->salvarArquivo($usuario, $compMatricula);
            if ($nomeArquivo && $usuario->getIsEstudante() == "SIM") {
                $usuario->setCompMatricula($nomeArquivo);
                $usuario->setStatus(Status::NAOVERIFICADO);
            }
            try {
                $this->usuarioDao->insert($usuario);
                $_SESSION['mensagem_sucesso'] = "Cadastro feito com sucesso! <br> Realize o login para continuar.";
                //TODO - Enviar mensagem de sucesso
                header("location: " . LOGIN_PAGE);
                exit;
            } catch (PDOException $e) {
                //echo $e->getMessage();
                $erros['banco'] = "Erro ao salvar o usuário na base de dados." . $e;
            }

        }

        if (empty($erros)) {
            //Persiste o objeto

            try {
                $this->usuarioDao->insert($usuario);
                $_SESSION['nomeUsuario'] = $usuario->getNomeUsuario();
                $_SESSION['mensagem_sucesso'] = "Seja bem-vindo ao IFShare, " . $_SESSION['nomeUsuario'] . ".<br> Realize o login para continuar.";

                //TODO - Enviar mensagem de sucesso
                header("location: " . LOGIN_PAGE);
                exit;
            } catch (PDOException $e) {
                //echo $e->getMessage();
                $erros['banco'] = "Erro ao salvar o usuário na base de dados." . $e;
            }
        }

        //Se há erros, volta para o formulário

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["usuario"] = $usuario;
        $this->loadView("login/cadastro.php", $dados, $erros);
    }
}


#Criar objeto da classe para assim executar o construtor
new LoginController();
