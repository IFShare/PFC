<?php
# Nome do arquivo: usuario/list.php
# Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/list.css">


<h3 class="text-center">Listagem de Usuários</h3>

<div class="container-list position-relative" id="container">


    <?php
    require_once(__DIR__ . "/../include/menu.php");
    require_once(__DIR__ . "/../include/menuTop.php");
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
            <div class="col-md-4">
                <div class="card mb-4" style="border: 1px solid #ddd; border-radius: 8px;">
                    <div class="card-body">
                        <a href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?= $usu->getId() ?>">
                            <h5 class="card-title d-flex justify-content-center fw-bold">
                                <img class="fotoPerfil" src="/PFC/arquivos/fotosPerfil/<?= $usu->getFotoPerfil(); ?>" alt="Fotos do perfil">
                            </h5>
                        </a>

                        <h5 class="card-title text-center fw-bold"><?= $usu->getNomeUsuario(); ?></h5>
                        <p class="card-text">
                            <strong>ID:</strong> <?= $usu->getId(); ?><br>
                            <strong>Nome completo:</strong> <?= $usu->getNomeSobrenome(); ?><br>
                            <strong>Email:</strong> <?= $usu->getEmail(); ?><br>
                            <strong>Tipo de usuário:</strong>
                            <span <?= $usu->getTipoUsuario() === "ADM" ? "style= 'color: purple; font-weight: bold;" : ($usu->getTipoUsuario() === "ESTUDANTE" ? "style = 'color: green; font-weight: bold;" : ""); ?>'>
                                <?= $usu->getTipoUsuario(); ?>

                            </span><br>
                            <strong>Estudante:</strong> <?= $usu->getIsEstudante(); ?><br>
                            <strong>Declaração:</strong>
                            <?= $usu->getCompMatricula()
                                ? "<a href='/PFC/arquivos/compMatricula/" . $usu->getCompMatricula() . "' target='_blank'>Ver declaração</a>"
                                : "Sem declaração.";
                            ?><br>
                            <strong>Status:</strong>
                            <span <?= $usu->getStatus() === "ATIVOVERIFICADO" ? "style = 'color: blue; font-weight: bold;" : ($usu->getStatus() === "ATIVO" ? "style = 'color: green; font-weight: bold;" : ($usu->getStatus() === "INATIVO" ? "color: gray; font-weight: bold;" : ($usu->getStatus() === "NAOVERIFICADO" ? "style = 'color: red; font-weight: bold;" : ""))); ?>'>
                                <?= $usu->getStatus(); ?>

                            </span>
                        </p>
                        <div class="text-center">
                            <a class="btn btn-primary" href="<?= BASEURL ?>/controller/UsuarioController.php?action=edit&id=<?= $usu->getId() ?>&search=<?php echo $dados['dadoPesquisa']; ?>">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a class="btn btn-danger" onclick="return confirm('Confirma a exclusão do usuário?');" href="<?= BASEURL ?>/controller/UsuarioController.php?action=delete&id=<?= $usu->getId() ?>">
                                <i class="fa-solid fa-trash"></i> Excluir
                            </a>
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