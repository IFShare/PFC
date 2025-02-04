<?php
# Nome do arquivo: usuario/list.php
# Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/list.css">


<h3 class="text-center">Listagem de Usuários</h3>

<div class="container-list position-relative sidebar-open" id="container">


    <?php
    require_once(__DIR__ . "/../include/menu.php");
    require_once(__DIR__ . "/../include/menuTop.php");
    require_once(__DIR__ . "/../include/createPost.php");
    ?>

    <?php
    if (
        (isset($_SESSION['userDeleted'])  && $_SESSION['userDeleted'] == true)
    ):
    ?>

        <?php
        require_once(__DIR__ . "/../include/msgToast.php");
        ?>

    <?php
        if (isset($_SESSION['userDeleted'])  && $_SESSION['userDeleted'] == true)
            unset($_SESSION['userDeleted']);
    endif;
    ?>


    <a class="insertBtn btn btn-success mb-3" href="<?= BASEURL ?>/controller/UsuarioController.php?action=create">
        Inserir novo usuário
    </a>


    <div class="row col-12">

        <?php
        if ($dados['lista'] == null) {
            print "<h3 class='fw-bold text-center mt-3'>Nenhum usuário encontrado.</h3>";
        }
        ?>
        <?php foreach ($dados['lista'] as $usu): ?>
            <div class="col-md-4 coluna mb-4">
                <div class="card" style="border-radius: 8px;">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='dots-info bi bi-three-dots'></i>
                        </button>
                        <ul class="dropdown-menu more-options" aria-labelledby="dropdownMenuButton">
                            <li class="liDropDown estudante">
                                <a
                                    class="linkDropdown"
                                    onclick="return confirm('Tem certeza de que deseja verificar <?= $usu->getNomeUsuario(); ?> como ESTUDANTE?');"
                                    href="/PFC/app/controller/UsuarioController.php?action=verifyAsStudent&id=<?= $usu->getId() ?>">
                                    <i class="fa-solid fa-user-graduate"></i>
                                    Verificar como ESTUDANTE</a>
                            </li>
                            <li class="liDropDown adm">
                                <a
                                    class="linkDropdown"
                                    onclick="return confirm('Tem certeza de que deseja verificar <?= $usu->getNomeUsuario(); ?> como ADM?');"
                                    href="/PFC/app/controller/UsuarioController.php?action=verifyAsAdm&id=<?= $usu->getId() ?>">
                                    <i class="fa-solid fa-crown me-1"></i>
                                    Verificar como ADM</a>
                            </li>

                            <li class="liDropDown usuario">
                                <a
                                    class="linkDropdown"
                                    onclick="return confirm('Tem certeza de que deseja verificar <?= $usu->getNomeUsuario(); ?> como USUARIO?');"
                                    href="/PFC/app/controller/UsuarioController.php?action=verifyAsUser&id=<?= $usu->getId() ?>">
                                    <i class="fa-solid fa-user"></i>
                                    Verificar como USUARIO</a>
                            </li>

                            <li class="liDropDown delete">
                                <a class="linkDropdown"
                                    onclick="return confirmAction();"
                                    href="/PFC/app/controller/UsuarioController.php?action=delete&id=<?= $usu->getId() ?>">
                                    <i class="bi bi-trash-fill me-1"></i>
                                    Excluir usuário</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body position-relative">
                        <a href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?= $usu->getId() ?>">
                            <h5 class="card-title d-flex justify-content-center fw-bold">
                                <img class="fotoPerfil" src="/PFC/arquivos/fotosPerfil/<?= $usu->getFotoPerfil(); ?>" alt="Fotos do perfil">
                            </h5>
                        </a>

                        <h5 class="card-title text-center fw-bold"><?= $usu->getNomeUsuario(); ?></h5>
                        <p class="card-text">
                            <strong>ID:</strong> <?= $usu->getId(); ?><br>
                            <strong>Nome e sobrenome:</strong> <?= $usu->getNomeSobrenome(); ?><br>
                            <strong>Email:</strong> <?= $usu->getEmail(); ?><br>
                            <strong>Data de cadastro:</strong>
                            <?= date('d/m/y', strtotime($usu->getDataCriacao())); ?><br> <strong>Tipo de usuário:</strong>
                            <span <?= $usu->getTipoUsuario() === "ADM" ? "style= 'color: purple; font-weight: bold;" : ($usu->getTipoUsuario() === "ESTUDANTE" ? "style = 'color: #24a424; font-weight: bold;" : ($usu->getTipoUsuario() === "USUARIO" ? "style = 'color: white; font-weight: bold;" : "")); ?>'>
                                <?= $usu->getTipoUsuario(); ?>

                            </span><br>
                            <strong>Declaração:</strong>
                            <?= $usu->getCompMatricula()
                                ? "<a href='/PFC/arquivos/compMatricula/" . $usu->getCompMatricula() . "' target='_blank'>Ver declaração</a>"
                                : "Sem declaração.";
                            ?><br>
                            <strong>Status:</strong>
                            <span <?= $usu->getStatus() === "ATIVOVERIFICADO" ? "style = 'color: blue; font-weight: bold;" : ($usu->getStatus() === "ATIVO" ? "style = 'color: #24a424; font-weight: bold;" : ($usu->getStatus() === "INATIVO" ? "style='color: orange; font-weight: bold;'" : ($usu->getStatus() === "NAOVERIFICADO" ? "style = 'color: red; font-weight: bold;" : ""))); ?>'>
                                <?= $usu->getStatus(); ?>

                            </span>
                        </p>
                        <div class="d-flex btns-options">
                            <a class="btn btn-primary" href="<?= BASEURL ?>/controller/UsuarioController.php?action=edit&id=<?= $usu->getId() ?>&search=<?php echo $dados['dadoPesquisa']; ?>">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>

                            <?php
                            if ($usu->getStatus() !== "INATIVO"):
                            ?>

                                <a class="btn btn-secondary" onclick="return confirmAction();"
                                    href="<?= BASEURL ?>/controller/UsuarioController.php?action=inactivateActivateUser&id=<?= $usu->getId() ?>">
                                    <i class="bi bi-person-fill-slash"></i> Inativar
                                </a>

                            <?php
                            elseif ($usu->getStatus() == "INATIVO"):
                            ?>

                                <a class="btn btn-success" onclick="return confirmAction();"
                                    href="<?= BASEURL ?>/controller/UsuarioController.php?action=inactivateActivateUser&id=<?= $usu->getId() ?>">
                                    <i class="bi bi-person-fill-check"></i> Ativar
                                </a>

                            <?php
                            endif;
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="<?= BASEURL ?>/view/js/list.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>