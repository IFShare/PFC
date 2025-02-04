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
    require_once(__DIR__ . "/../include/createPost.php");
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
                            <strong>Usuário denunciante:</strong> <?= $den->getUsuario()->getNomeUsuario() ?><br>

                            <strong>Motivo:</strong>
                            <span>
                                <?= $den->getMotivo() ?>
                            </span>
                            <br>
                            <strong>Status:</strong>
                            <span <?= $den->getStatus() === "NAOVERIFICADO" ? "style = 'color: red; font-weight: bold;" : ($den->getStatus() === "VERIFICADO" ? "style = 'color: green; font-weight: bold;" : "") ?>'>
                                <?= $den->getStatus(); ?></span>
                            <br>
                            <strong>Solução tomada:</strong>
                            <span style="color: black; font-weight: bold; text-decoration: underline;"><?= $den->getSolucao(); ?></span>
                            <br>
                        </p>
                        <div class="btn-verify text-center d-flex justify-content-center gap-4">
                            <a class="btn" href="/PFC/app/controller/PostagemController.php?action=viewPost&id=<?= $den->getPost()->getId() ?>&listDenunciaByPost&idPostagem=<?= $den->getPost()->getId() ?>">
                                Verificar Postagem
                            </a>

                        </div>

                        <?php
                        if ($den->getStatus() === "NAOVERIFICADO"):
                        ?>
                            <div class="solution d-flex mt-3">
                                <form action="/PFC/app/controller/DenunciaController.php?action=insertSolution" method="post">
                                    <input name="solucao" type="text" id="inp-solution" placeholder="Digite a solução tomada">
                                    <button type="submit" id="insertSolution">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z" />
                                        </svg>
                                    </button>
                                    <input type="hidden" name="idDenuncia" value="<?= $den->getId() ?>">
                                </form>
                            </div>
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