<?php
require_once(__DIR__ . "/../include/header.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/postView.css">

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
                    src="/PFC/arquivos/imgs/<?= $dados["postagem"]->getImagem(); ?>"
                    alt="Imagem da postagem">

                <button 
                class="expand"
                data-bs-target="#postModal"
                data-bs-toggle="modal"
                class="justify-content-center btnInsert">
                    <i class="ampliar bi bi-arrows-angle-expand"></i>
                </button>

            </div>

            <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="imgModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 90vw;">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img
                                id="imgModal"
                                class="img"
                                src="/PFC/arquivos/imgs/<?= $dados["postagem"]->getImagem(); ?>"
                                alt="Imagem da postagem">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="postRight position-relative">

            <a target="_blank" id="wpp" href="https://api.whatsapp.com/send?text=http://localhost/PFC/app/controller/PostagemController.php?action=viewPost&id=<?php echo $dados['postagem']->getId(); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                    <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                </svg>
            </a>

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
                            echo "<div class='user-coment'>";
                            echo "<i class='user bi bi-person-circle'></i>";
                            echo "<span class='userComent'>" . $comentario->getUsuario()->getNomeUsuario() . "</span>";
                            echo "</div>";
                            echo "<span class='conteudo'>" . $comentario->getConteudo() . "</span>";
                    ?>
                            <div class="data-del">

                                <?php
                                $dataComentario = new DateTime($comentario->getDataComentario());

                                $dataAtual = new DateTime();

                                $diferenca = $dataComentario->diff($dataAtual);

                                if ($diferenca->y > 0) {
                                    // Mais de um ano
                                    echo "<span id='dataResumidaComent' onclick='changeDataComent()'>Há " . $diferenca->y . ($diferenca->y == 1 ? " ano" : " anos") . ".</span>";
                                } elseif ($diferenca->m > 0) {
                                    // Mais de um mês
                                    echo "<span id='dataResumidaComent' onclick='changeDataComent()'>Há " . $diferenca->m . ($diferenca->m == 1 ? " mês" : " meses") . ".</span>";
                                } elseif ($diferenca->d > 0) {
                                    // Mais de um dia
                                    echo "<span id='dataResumidaComent' onclick='changeDataComent()'>Há " . $diferenca->d . ($diferenca->d == 1 ? " dia" : " dias") . ".</span>";
                                } elseif ($diferenca->h > 0) {
                                    // Mais de uma hora
                                    echo "<span id='dataResumidaComent' onclick='changeDataComent()'>Há " . $diferenca->h . ($diferenca->h == 1 ? " hora" : " horas") . ".</span>";
                                } elseif ($diferenca->i > 0) {
                                    // Mais de um minuto
                                    echo "<span id='dataResumidaComent' onclick='changeDataComent()'>Há " . $diferenca->i . ($diferenca->i == 1 ? " minuto" : " minutos") . ".</span>";
                                } else {
                                    // Menos de um minuto (segundos)
                                    echo "<span id='dataResumidaComent' onclick='changeDataComent()'>Agora mesmo." . "</span>";
                                }

                                // Dropdown de opções
                                echo "<div class='dropdown'>";
                                echo "<button class='btn btn-link dropdown-toggle' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>";
                                echo "<i class='bi bi-three-dots'></i>"; // Ícone de três pontinhos
                                echo "</button>";
                                echo "<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                                echo "<li><a class='dropdown-item' href='/PFC/app/controller/ComentarioController.php?action=delComentario&id=" . $comentario->getId() . "'>Excluir</a></li>";

                                echo "</ul>";
                                echo "</div>";
                                ?>
                            </div>
                    <?php


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
                <?php
                if ($dados["curtidaExistente"] == true): ?>

                    <span>
                        <i id="likeButton" class="bi bi-heart-fill" style="color: red;"></i>
                    </span>

                <?php else: ?>

                    <span>
                        <i id="likeButton" class='bi bi-heart-fill'></i>
                    </span>

                <?php endif ?>

                <?php
                if ($dados["countLikes"] == 1):
                ?>
                    <span id="likes"><?php echo $dados["countLikes"] ?> Curtida</span>

                <?php else: ?>
                    <span id="likes"><?php echo $dados["countLikes"] ?> Curtidas</span>

                <?php endif; ?>

                <?php
                if ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM" || $_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ESTUDANTE"):
                ?>
                    <input form="formComent" id="inpComent" type="text" name="comentario" required placeholder="Adicione um comentário...">
                    <button form="formComent" type="submit" id="insertComent" class="material-symbols-outlined">
                        send
                    </button>
                <?php endif; ?>
            </div>

            <form id="formLike">
                <input hidden type="number" id="idPost" value="<?php echo $dados["postagem"]->getId(); ?>">
                <input hidden type="number" id="idUsuario" value="<?php echo $_SESSION[SESSAO_USUARIO_ID] ?>">
            </form>


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

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="/PFC/app/view/js/curtida.js"></script>
<script src="/PFC/app/view/js/postView.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>