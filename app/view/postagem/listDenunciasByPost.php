<?php
# Nome do arquivo: usuario/list.php
# Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/list.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/pesquisaStyle.css">

<h3 class="text-center">Listagem de denuncias</h3>

<div class="container-list position-relative sidebar-open" id="container">


    <?php
    require_once(__DIR__ . "/../include/menu.php");
    require_once(__DIR__ . "/../include/menuTop.php");
    ?>

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
                        <p class="card-text">
                            <strong>ID do usuário:</strong> <?= $den['idUsuario'] ?><br>

                            <strong>Motivo:</strong>
                            <span>
                                <?= $den['motivo'] ?>
                            </span>
                            <!-- <br>
                            <strong>Status:</strong>
                            <span <?= $den['status'] === "NAOVERIFICADO" ? "style = 'color: red; font-weight: bold;" : ($den['status'] === "VERIFICADO" ? "style = 'color: green; font-weight: bold;" : "") ?>'>
                                <?= $den['status']; ?></span> -->
                        </p>
                        <div class="btn-verify text-center d-flex justify-content-center gap-4">
                            <a class="btn" href="/PFC/app/controller/PostagemController.php?action=viewPost&id=<?= $den['idPostagem'] ?>&isDenuncia=sim">
                                Verificar Postagem
                            </a>

                        </div>

                        <?php
                            if ($den['status'] === "NAOVERIFICADO"):
                        ?>

                        <?php endif; ?>
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
        window.location = 'DenunciaController.php?action=listDenunciasByPost&search=' + search.value;
    }
</script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>