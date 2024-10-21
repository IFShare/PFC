<?php
require_once(__DIR__ . '/../include/header.php');

// Verifica se o ID foi passado como parâmetro GET
$idPost = isset($_GET['id']) ? $_GET['id'] : null;
?>

<div class="container justify-content-center">

    <h3>Digite o ID da postagem que deseja deletar.</h3>

    <form action="/PFC/app/controller/PostagemController?action=findPostById" method="get">
        <!-- Campo de entrada para o ID da postagem -->
        <input type="number" name="id" required>
        <button type="submit" class="btn btn-danger">Procurar Postagem.</button>
    </form>

    <!-- Botão de exclusão -->

    <p><?php
        if (isset($_GET["id"])) {
            $idPost = $_GET["id"];
        }
        if (isset($dados["post"])) {
            $dados["post"];
        }
        if (isset($erros["erroPost"])) {
            echo $erros["erroPost"];
        }
        ?></p>
</div>

<?php
require_once(__DIR__ . '/../include/footer.php');
?>