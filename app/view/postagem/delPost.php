<?php
require_once(__DIR__ . '/../include/header.php');
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/delPost.css">

<div class="container">

    <a class="voltar"
        href="<?= HOME_PAGE ?>">
        <i class="fs-4 bi bi-arrow-left-square"
            data-bs-toggle="tooltip" data-bs-title="Default tooltip data-bs-title=">
        </i>

    </a>

    <h2>Selecione a postagem que deseja excluir</h2>

    <section class="postagens">

        <?php foreach ($dados['listPosts'] as $posts): ?>
            <div class="post">
                <a
                    onclick="return confirm('Confirma a exclusão desta postagem?');"
                    href="/PFC/app/controller/PostagemController.php?action=delPost&id=<?= $posts->getId() ?>">
                    <img
                        class="imgPost"
                        src="/PFC/arquivos/imgs/<?= $posts->getImagem(); ?>"
                        alt="Imagem da postagem">
                    <i class="lixeira fa-solid fa-trash"></i>
                </a>

            </div>

        <?php endforeach; ?>

    </section>

</div>


<?php
require_once(__DIR__ . '/../include/footer.php');
?>