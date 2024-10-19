<?php
require_once(__DIR__ . "/../include/header.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/postView.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">


<div class="container">

    <a class="voltar"
        href="<?= HOME_PAGE ?>">
        <i class="fs-4 bi bi-arrow-left-square"
            data-bs-toggle="tooltip" data-bs-title="Default tooltip data-bs-title=">
        </i>

    </a>

    <div class="postagem">

        <div class="postLeft">

            <div class="imgPost">

                <img
                    class="img"
                    src="/PFC/arquivos/<?= $dados["postagem"]->getImagem(); ?>"
                    alt="Imagem da postagem">



                <?php

                if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM"):

                ?>

                <?php
                endif
                ?>

            </div>


            <div class="heart mt-2">
                <a href="/PFC/app/controller/CurtidaController.php?action=likeDislike&idPostagem=<?= $dados["postagem"]->getId() ?>">
                    <i class="fa-solid fa-heart"></i>
                </a>
                <span id="likes">0 likes</span>
            </div>

        </div>

        <div class="postRight">

            <div class="nomeUsuario">
                <h6> <?php echo $dados["usuario"]; ?> </h6>
            </div>

            <p id="legenda">
                <?php
                echo $dados["postagem"]->getLegenda();
                ?>
            </p>

            <div class="comentarios">
                <h5>Comentários</h5>
                <div class="listComentarios">
                    <?php
                    foreach ($dados['listComentarios'] as $coments):
                    ?>
                        <span class="coment">

                            <?= $coments->getConteudo(); ?>
                        </span>
                    <?php
                    endforeach;
                    ?>

                </div>
                <form action="/PFC/app/controller/ComentarioController.php?action=InsertComentario" method="post">
                    <input type="hidden" name="idPostagem" value="<?= $dados["postagem"]->getId(); ?>"> <!-- ID da postagem -->

                    <input id="inpComent" type="text" name="comentario" required placeholder="Insira um comentário">
                    <button type="submit" id="insertComent">INSERIR</button>
                </form>
            </div>

            <a class="excluir"
                onclick="return confirm('Confirma a exclusão da postagem?');"
                href="<?= BASEURL ?>/controller/PostagemController.php?action=delPost&id=<?= $dados["postagem"]->getId() ?>">
                Excluir
            </a>

        </div>


        <div class="data">
            <?php
            $dataPostagem = new DateTime($dados["postagem"]->getDataPostagem());

            $dataAtual = new DateTime();

            $diferenca = $dataPostagem->diff($dataAtual);

            if ($diferenca->y > 0) {
                // Mais de um ano
                echo "Há " . $diferenca->y . ($diferenca->y == 1 ? " ano" : " anos") . ".";
            } elseif ($diferenca->m > 0) {
                // Mais de um mês
                echo "Há " . $diferenca->m . ($diferenca->m == 1 ? " mês" : " meses") . ".";
            } elseif ($diferenca->d > 0) {
                // Mais de um dia
                echo "Há " . $diferenca->d . ($diferenca->d == 1 ? " dia" : " dias") . ".";
            } elseif ($diferenca->h > 0) {
                // Mais de uma hora
                echo "Há " . $diferenca->h . ($diferenca->h == 1 ? " hora" : " horas") . ".";
            } elseif ($diferenca->i > 0) {
                // Mais de um minuto
                echo "Há " . $diferenca->i . ($diferenca->i == 1 ? " minuto" : " minutos") . ".";
            } else {
                // Menos de um minuto (segundos)
                echo "Há " . $diferenca->s . ($diferenca->s == 1 ? " segundo" : " segundos") . ".";
            }
            ?>
        </div>

    </div>






</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var legenda = document.getElementById('legenda');

        // Verifica se o conteúdo da legenda é maior que a altura da div
        if (legenda.scrollHeight > legenda.clientHeight) {
            // Habilita o scroll e aplica os estilos
            legenda.style.overflowY = 'scroll';

            // Adiciona os estilos de barra de rolagem
            legenda.classList.add('scroll-styles');
        }
    });
</script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>