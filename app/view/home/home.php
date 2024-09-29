<?php
#View para a home do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/post.css">


<div class="row mt-4 justify-content-center w-100">
    <div class="col-4 textCentral">
        <h1 class="text-center fw-bold">IFSHARE</h1>

    </div>

</div>

<div class="row justify-content-center align-items-center w-100">
    <div class="col-3">
        <a class="justify-content-center mt-3 btn btn-dark text-center" href="/PFC/app/controller/PostagemController.php?action=createPost">
            Inserir nova postagem</a>
    </div>
</div>

<div class="container">

    <section>

        <div class="post">
            <?php foreach ($dados['listPosts'] as $posts): ?>

                <img class="imgPost" src="/PFC/arquivos/<?= $posts->getImagem(); ?>" alt="Imagem da postagem">
            <?php endforeach; ?>

        </div>
</div>
</section>




<?php
require_once(__DIR__ . "/../include/footer.php");
?>