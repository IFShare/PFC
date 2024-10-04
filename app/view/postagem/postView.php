<?php
require_once(__DIR__ . "/../include/header.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/postView.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">


<div class="container">

    <div class="postagem">
        <img
            class="imgPost"
            src="/PFC/arquivos/<?= $dados["postagem"]->getImagem(); ?>"
            alt="Imagem da postagem">

        <p id="legenda">
            <?php
            echo $dados["postagem"]->getLegenda();
            ?>
        </p>

    </div>

</div>