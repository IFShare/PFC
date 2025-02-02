<?php
# Nome do arquivo: usuario/list.php
# Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/list.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/pesquisaStyle.css">

<div class="container-list position-relative sidebar-open" id="container">


    <?php
    require_once(__DIR__ . "/../include/menu.php");
    require_once(__DIR__ . "/../include/menuTop.php");
    require_once(__DIR__ . "/../include/createPost.php");
    ?>

    <div class="row col-12 mt-5">

        <?php
        if ($dados['lista'] == null) {
            print "<h3 class='fw-bold text-center mt-3'>Nenhuma denuncia encontrada.</h3>";
        }
        ?>
        <?php foreach ($dados['lista'] as $post): ?>
            <div class="col-md-4">
                <div class="card mb-4" style="border: 1px solid #ddd; border-radius: 8px;">
                    <div class="card-body">
                        <p class="card-text">
                            <strong>ID da postagem:</strong> <?= $post->getId() ?><br>

                            <strong>Responsável pela postagem:</strong>
                            <span>
                                <?= $post->getUsuario()->getNomeUsuario() ?>
                            </span>
                            <br> 
                            <strong>Total denuncias:</strong>
                            <span>
                                <?= $post->getTotalDenuncias() ?>
                            </span>
                            <br>                            
                        </p>
                        <div class="btn-verify text-center d-flex justify-content-center gap-4">
                            <a class="btn" href="/PFC/app/controller/PostagemController.php?action=viewPost&id=<?= $post->getId() ?>&isDenuncia=sim">
                                Verificar Postagem
                            </a>

                            <a class="btn" href="/PFC/app/controller/DenunciaController.php?action=listDenunciaByPost&idPostagem=<?= $post->getId() ?>">
                                Ver denúncias
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