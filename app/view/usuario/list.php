<?php
# Nome do arquivo: usuario/list.php
# Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/list.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/pesquisaStyle.css">


<a class="btn btn-custom mt-2 voltar" href="<?= HOME_PAGE ?>">
    <i class="fs-4 bi bi-arrow-left-square"></i></a>

<h3 class="text-center">Listagem de Usuários</h3>

<div class="container position-relative">

    <a class="insertBtn btn btn-success mb-4" href="<?= BASEURL ?>/controller/UsuarioController.php?action=create">
        Inserir
    </a>

    <?php
    if (isset($dados['naoVerificados']) && $dados['naoVerificados'] > 0):
    ?>

        <a class="naoVerificados btn btn-success mb-4" href="<?= BASEURL ?>/controller/UsuarioController.php?action=list&search=NAOVERIFICADO">
            NÃO VERIFICADOS:
            <?php
            echo $dados['naoVerificados'];
            ?>
        </a>

    <?php
    endif
    ?>

    <div class="box-search mb-4 d-flex">

        <input
            list="usuarios"
            id="pesquisar"
            placeholder="Pesquisar..."
            type="search"
            class="form-control">
        <button onclick="searchData();" class="btn btn-primary btn-search">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
            </svg>
        </button>

    </div>


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
                        <h5 class="card-title d-flex justify-content-center fw-bold">
                            <img class="fotoPerfil" src="/PFC/arquivos/fotosPerfil/<?=$usu->getFotoPerfil();?>" alt="">
                        </h5>

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
                            <a class="btn btn-primary" href="<?= BASEURL ?>/controller/UsuarioController.php?action=edit&id=<?= $usu->getId() ?>&search=<?php echo $dados['data']; ?>">
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