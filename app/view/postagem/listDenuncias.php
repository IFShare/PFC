<?php
# Nome do arquivo: usuario/list.php
# Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/list.css">

<a class="btn btn-custom mt-2 voltar" href="<?= HOME_PAGE ?>">
    <i class="fs-4 bi bi-arrow-left-square"></i></a>

<h3 class="text-center">Listagem de denuncias</h3>

<div class="container position-relative">

    <?php
    if (isset($dados['naoVerificados']) && $dados['naoVerificados'] > 0):
    ?>

        <a class="naoVerificados btn btn-success mb-4" href="<?= BASEURL ?>/controller/DenunciaController.php?action=listDenuncias&search=NAOVERIFICADO">
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
            print "<h3 class='fw-bold text-center mt-3'>Nenhuma denuncia encontrada.</h3>";
        }
        ?>
        <?php foreach ($dados['lista'] as $den): ?>
            <div class="col-md-4">
                <div class="card mb-4" style="border: 1px solid #ddd; border-radius: 8px;">
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold"><?= $den->getUsuario()->getId(); ?></h5>
                        <p class="card-text">
                            <strong>ID:</strong> <?= $den->getId(); ?><br>
                            <strong>ID da postagem:</strong> <?= $den->getPost()->getId(); ?><br>
                            <strong>ID do usuário:</strong> <?= $den->getUsuario()->getId(); ?><br>

                            <strong>Status:</strong>
                            <span <?= $den->getStatus() === "VERIFICADO" ? "style = 'color: blue; font-weight: bold;" : ($den->getStatus() === "NAOVERIFICADO" ? "style = 'color: red; font-weight: bold;" : ""); ?>'>
                                <?= $den->getStatus(); ?>

                            </span>
                                <br>
                            <strong>Motivo:</strong>
                            <span>
                            <?= $den->getMotivo()?>
                            </span>
                        </p>
                        <div class="text-center">
                            <a class="btn btn-primary" href="<?= BASEURL ?>/controller/UsuarioController.php?action=edit&id=<?= $den->getId() ?>&search=<?php echo $dados['data']; ?>">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a class="btn btn-danger" onclick="return confirm('Confirma a exclusão do usuário?');" href="<?= BASEURL ?>/controller/UsuarioController.php?action=delete&id=<?= $den->getId() ?>">
                                <i class="fa-solid fa-trash"></i> Excluir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    var search = document.querySelector('#pesquisar');

    search.addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            searchData();
        }
    })

    function searchData() {
        window.location = 'DenunciaController.php?action=listDenuncias&search=' + search.value;
    }
</script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>