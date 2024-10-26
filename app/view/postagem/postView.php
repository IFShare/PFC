<?php
require_once(__DIR__ . "/../include/header.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/postView.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">

<div class="container">
<!--BOTÃO DE VOLTAR -->
    <a class="voltar"
        href="<?= HOME_PAGE ?>">
        <i class="fs-4 bi bi-arrow-left-square"
            data-bs-toggle="tooltip" data-bs-title="Default tooltip data-bs-title=">
        </i>

    </a>

    <div class="postagem">

        <div class="postLeft">

        <!--IMAGEM DA POSTAGEM -->
            <div class="imgPost">

                <img
                    class="img"
                    src="/PFC/arquivos/<?= $dados["postagem"]->getImagem(); ?>"
                    alt="Imagem da postagem">

            </div>
        </div>

        <div class="postRight">

        <!--LEGENDA E COMENTÁRIOS -->
            <div class="infos">
                <div class="usuario">
                    <i class='user bi bi-person-circle'></i>
                    <span class="nomeUsuario">
                        <?php echo $dados["nomeUsuario"]; ?>
                        <?php
                        if ($dados["tipoUsuario"] == "ADM"):
                        ?>
                            <abbr title="Este usuário é um ADM do sistema"><i class="bi bi-patch-check verificado"></i></abbr>
                        <?php endif ?>
                    </span>
                </div>

                <p id="legenda">
                    <?php
                    echo $dados["postagem"]->getLegenda();
                    ?>
                </p>
                <!--COMENTÁRIOS -->
                <div class="listComentarios">
                    <?php
                    if (isset($dados['listComentarios']) && !empty($dados['listComentarios'])) {
                        foreach ($dados['listComentarios'] as $comentario) {
                            echo "<div class='coment'>";
                            echo "<i class='user bi bi-person-circle'></i>";
                            echo "<span class='userComent'>" . $comentario->getUsuario()->getNomeUsuario() . "</span>";
                            echo "<span class='conteudo'>" . $comentario->getConteudo() . "</span>";
                            // Dropdown de opções
                            echo "<div class='dropdown'>";
                            echo "<button class='btn btn-link dropdown-toggle' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>";
                            echo "<i class='bi bi-three-dots'></i>"; // Ícone de três pontinhos
                            echo "</button>";
                            echo "<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                            echo "<li><a class='dropdown-item' href='/PFC/app/controller/ComentarioController.php?action=delComentario&id=" . $comentario->getId() . "'>Excluir</a></li>";

                            echo "</ul>";
                            echo "</div>";

                            echo "</div>";
                        }
                    } else {
                        echo "<p class='noComent mt-5'>Ainda não há nenhum comentário.</p>";
                        echo "<p class='fs-4 text-center'>Inicie a conversa!</p>";
                    }
                    ?>

                </div>

            </div>

            <!--CURTIDA -->
            <div class="heart mt-2">
                <a 
                id="likeButton" 
                href="/PFC/app/controller/CurtidaController.php?action=likeDislike&id=<?= $dados["postagem"]->getId() ?>">
                    <?php
                        if($dados["curtidaExistente"] == true) {
                            echo "<i class='bi bi-heart-fill' style='color: red;'></i>";
                        } else {
                            echo "<i class='bi bi-heart'></i>";
                        }
                    ?>
                </a>
                <span id="likes"><?php echo $dados["countLikes"] ?></span>
                <input form="formComent" id="inpComent" type="text" name="comentario" required placeholder="Adicione um comentário...">
                <button form="formComent" type="submit" id="insertComent" class="material-symbols-outlined">
                    send
                </button>
            </div>

            <!--DATA -->
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

            <form id="formComent" action="/PFC/app/controller/ComentarioController.php?action=InsertComentario" method="post">
                <input type="hidden" name="idPostagem" value="<?= $dados["postagem"]->getId(); ?>"> <!-- ID da postagem -->
            </form>

        </div>

    </div>

</div>

<script src="/PFC/app/view/js/curtida.js"></script>
<script src="/PFC/app/view/js/postView.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>