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
                    if (isset($dados['listComentarios'])) {
                        foreach ($dados['listComentarios'] as $comentario) {
                            echo "<span class='coment'>" . $comentario->getConteudo() . "</span>";
                        }
                    } else {
                        echo "Seja o primeiro a comentar!";
                    }
                    ?>

                </div>
                <form action="/PFC/app/controller/ComentarioController.php?action=InsertComentario" method="post">
                    <input type="hidden" name="idPostagem" value="<?= $dados["postagem"]->getId(); ?>"> <!-- ID da postagem -->

                    <input id="inpComent" type="text" name="comentario" required placeholder="Faça um comentário">
                    <button type="submit" id="insertComent" class="material-symbols-outlined">
                        send
                    </button>
                </form>
            </div>

            <?php

            if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM"):

            ?>

                <a class="excluir"
                    onclick="return confirm('Confirma a exclusão da postagem?');"
                    href="<?= BASEURL ?>/controller/PostagemController.php?action=delPost&id=<?= $dados["postagem"]->getId() ?>">
                    <i class="fa-solid fa-trash"></i>
                </a>


            <?php
            endif
            ?>

        </div>

        <div class="data">
            <?php
            // Obter a data da postagem
            $dataPostagem = $dados["postagem"]->getDataPostagem();

            // Criar o objeto DateTime
            $dataFormatada = new DateTime($dataPostagem);

            // Exibir a data no formato: "15 de Outubro de 2024, 14:30"
            echo "<span id='dataCompleta' onclick='changeData();'>" . strftime('%d de %B de %Y, %H:%M', $dataFormatada->getTimestamp()) . "</span>";
            ?>

            <?php
            $dataPostagem = new DateTime($dados["postagem"]->getDataPostagem());

            $dataAtual = new DateTime();

            $diferenca = $dataPostagem->diff($dataAtual);

            if ($diferenca->y > 0) {
                // Mais de um ano
                echo "<span id='dataResumida' onclick='changeData()'>Há " . $diferenca->y . ($diferenca->y == 1 ? " ano" : " anos") . ".</span>";
            } elseif ($diferenca->m > 0) {
                // Mais de um mês
                echo "<span id='dataResumida' onclick='changeData()'>Há " . $diferenca->m . ($diferenca->m == 1 ? " mês" : " meses") . ".</span>";
            } elseif ($diferenca->d > 0) {
                // Mais de um dia
                echo "<span id='dataResumida' onclick='changeData()'>Há " . $diferenca->d . ($diferenca->d == 1 ? " dia" : " dias") . ".</span>";
            } elseif ($diferenca->h > 0) {
                // Mais de uma hora
                echo "<span id='dataResumida' onclick='changeData()'>Há " . $diferenca->h . ($diferenca->h == 1 ? " hora" : " horas") . ".</span>";
            } elseif ($diferenca->i > 0) {
                // Mais de um minuto
                echo "<span id='dataResumida' onclick='changeData()'>Há " . $diferenca->i . ($diferenca->i == 1 ? " minuto" : " minutos") . ".</span>";
            } else {
                // Menos de um minuto (segundos)
                echo "<span id='dataResumida' onclick='changeData()'>Há " . $diferenca->s . ($diferenca->s == 1 ? " segundo" : " segundos") . ".</span>";
            }
            ?>
        </div>

    </div>

</div>

<script src="/PFC/app/view/js/postView.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>