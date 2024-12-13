<?php
#View para a home do sistema

require_once(__DIR__ . "/../include/header.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/post.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/pesquisaStyle.css">


<?php
require_once(__DIR__ . "/../include/menu.php");
$usuarioLogado = $dados['usuarioLogado'];
?>
<div class="container-posts sidebar-closed" id="container">

    <?php
    require_once(__DIR__ . "/../include/createPost.php");

    ?>

    <?php
    if (
        $usuarioLogado->getTipoUsuario() == "USUARIO" &&
        $usuarioLogado->getStatus() == "NAOVERIFICADO" &&
        !empty($usuarioLogado->getCompMatricula()) &&
        $_SESSION['login_naoverificado'] == true
    ):
    ?>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="myToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">IFShare</strong>
                    <button type="button" class="btn-close btn-success" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Olá, <?= $usuarioLogado->getNomeUsuario() ?>! 😊Sua declaração de matrícula está em análise!
                </div>
                <div class="mb-2 me-2 text-end">
                    <button type="button" class="btn btn-success btn-sm msgToast" data-bs-dismiss="toast">Entendi!</button>
                </div>
            </div>
        </div>

        <script>
            // Exibir o toast ao carregar a página
            document.addEventListener('DOMContentLoaded', () => {
                const myToastElement = document.getElementById('myToast');
                const myToast = new bootstrap.Toast(myToastElement, {
                    autohide: false // Desativa o fechamento automático
                });
                myToast.show();
            });
        </script>

    <?php
        $_SESSION['login_naoverificado'] = false;
    endif;
    ?>

    <div class="box-search d-flex">

        <input
            value=""
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
    <section class="postagens">

        <?php foreach ($dados['listPosts'] as $posts): ?>
            <div class="post" id="post-<?php echo $posts->getId() ?>">
                <a href="<?= BASEURL ?>/controller/PostagemController.php?action=viewPost&id=<?= $posts->getId() ?>">
                    <img
                        class="imgPost" id="imgPost"
                        src="/PFC/arquivos/imgs/<?= $posts->getImagem(); ?>"
                        alt="Imagem da postagem">
                </a>
            </div>

        <?php endforeach; ?>

    </section>

</div>



<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="<?= BASEURL ?>/view/js/home.js"></script>
<?php
require_once(__DIR__ . "/../include/footer.php");
?>