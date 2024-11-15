<?php
# Nome do arquivo: usuario/list.php
# Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/list.css">

<a class="btn btn-custom mt-2 voltar" href="<?= HOME_PAGE ?>">
    <i class="fs-4 bi bi-arrow-left-square"></i></a>

<h3 class="text-center">Listagem de Usuários</h3>

<div class="container">
    <a class="btn btn-success mb-4" href="<?= BASEURL ?>/controller/UsuarioController.php?action=create">
        Inserir
    </a>

    <div class="row">
        <?php foreach ($dados['lista'] as $usu): ?>
            <div class="col-md-4">
                <div class="card mb-4" style="border: 1px solid #ddd; border-radius: 8px;">
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold"><?= $usu->getNomeUsuario(); ?></h5>
                        <p class="card-text">
                            <strong>Nome completo:</strong> <?= $usu->getNomeSobrenome(); ?><br>
                            <strong>Email:</strong> <?= $usu->getEmail(); ?><br>
                            <strong>Tipo de usuário:</strong>
                            <span <?= $usu->getTipoUsuario() === "ADM" ? "style= 'color: purple; font-weight: bold;" : ($usu->getTipoUsuario() === "ESTUDANTE" ? "color: green; font-weight: bold;" : ""); ?>'>
                                <?= $usu->getTipoUsuario(); ?>

                            </span><br>
                            <strong>Estudante:</strong> <?= $usu->getIsEstudante(); ?><br>
                            <strong>Comprovante:</strong>
                            <?= $usu->getCompMatricula()
                                ? "<a href='/PFC/arquivos/compMatricula/" . $usu->getCompMatricula() . "' target='_blank'>Ver comprovante</a>"
                                : "Sem comprovante.";
                            ?><br>
                            <strong>Status:</strong>
                            <span <?= $usu->getStatus() === "ATIVOVERIFICADO" ? "style = 'color: blue; font-weight: bold;" : ($usu->getStatus() === "ATIVO" ? "color: green; font-weight: bold;" : ($usu->getStatus() === "INATIVO" ? "color: gray; font-weight: bold;" : ($usu->getStatus() === "NAOVERIFICADO" ? "color: red; font-weight: bold;" : ""))); ?>'>
                                <?= $usu->getStatus(); ?>

                            </span>
                        </p>
                        <div class="text-center">
                            <a class="btn btn-primary" href="<?= BASEURL ?>/controller/UsuarioController.php?action=edit&id=<?= $usu->getId() ?>">
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

<?php
require_once(__DIR__ . "/../include/footer.php");
?>