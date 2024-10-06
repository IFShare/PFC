<?php 
#Classe controller para a Logar do sistema
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

require_once(__DIR__ . "/../service/LoginService.php");
require_once(__DIR__ . "/../service/UsuarioService.php");

require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/enum/TipoUsuario.php");

class LoginController extends Controller {

    private LoginService $loginService;
    private UsuarioDAO $usuarioDao;
    private UsuarioService $usuarioService;

    public function __construct() {
        $this->loginService = new LoginService();
        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();
        
        $this->handleAction();
    }

    protected function login() {
        $this->loadView("login/login.php", [], []);
    }

    /* Método para logar um usuário a partir dos dados informados no formulário */
    protected function logon() {
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;

        //Validar os campos
        $erros = $this->loginService->validarCampos($email, $senha);
        if(empty($erros)) {
            //Valida o login a partir do banco de dados
            $usuario = $this->usuarioDao->findByEmailSenha($email, $senha);
            if($usuario) {
                //Se encontrou o usuário, salva a sessão e redireciona para a HOME do sistema
                $this->loginService->salvarUsuarioSessao($usuario);

                header("location: " . HOME_PAGE);     
                exit;
            } else {
                $erros['ambos'] = "<p class='mb-0 fw-bold text-danger'>Login ou senha informados são inválidos!</p>";
            }
        }

        //Se há erros, volta para o formulário            
        $loginErros = $erros;
        $dados["email"] = $email;
        $dados["senha"] = $senha;

        $this->loadView("login/login.php", $dados, $loginErros);
    }

     /* Método para logar um usuário a partir dos dados informados no formulário */
    protected function logout() {
        $this->loginService->removerUsuarioSessao();

        $this->loadView("login/login.php", [], []);
    }


    protected function createCadastro() {
        $this->loadView("login/cadastro.php", [], []);
    }

    protected function saveCadastro() {
        //Captura os dados do formulário
        $nomeSobrenome = isset($_POST['nomeSobrenome']) ? trim($_POST['nomeSobrenome']) : NULL;
        $nomeUsuario = isset($_POST['nomeUsuario']) ? trim($_POST['nomeUsuario']) : NULL;
        $email = isset($_POST['email']) ? trim($_POST['email']) : NULL;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : NULL;

        //Cria objeto Usuario
        $usuario = new Usuario();
        $usuario->setNomeSobrenome($nomeSobrenome);
        $usuario->setNomeUsuario($nomeUsuario);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setBio(null);
        $usuario->setTipoUsuario(TipoUsuario::USUARIO);
        $usuario->setCompMatricula(null);

        
        //Validar os dados
        $erros = $this->usuarioService->validarDados($usuario);

        if(empty($erros)) {
            //Persiste o objeto
            try {
                $this->usuarioDao->insert($usuario);

                //TODO - Enviar mensagem de sucesso
                "<script>alert('Usuário salvo com sucesso.')</script>";
                header("location: " . LOGIN_PAGE);
                exit;
            } catch (PDOException $e) {
                //echo $e->getMessage();
                $erros = array("Erro ao salvar o usuário na base de dados." . $e);
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
