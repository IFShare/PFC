<?php
require_once(__DIR__ . "/../include/header.php");


$usuario = $dados['usuario'];
$usuarioLogado = $_SESSION["usuarioLogado"];
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/postView.css">

<div class="container">

    <?php
    if (isset($_GET['isDenuncia']) && $_GET['isDenuncia'] == "sim"):
    ?>

        <a class="voltar"
            href="/PFC/app/controller/DenunciaController.php?action=listTotalDenunciaForEachPost">
            <i class="fs-4 bi bi-arrow-left-square"
                data-bs-toggle="tooltip" data-bs-title="Default tooltip data-bs-title=">
            </i>
        </a>

    <?php
    elseif (isset($_GET['idPerfil'])):
    ?>

        <a class="voltar"
            href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?= $_GET['idPerfil'] ?>">
            <i class="fs-4 bi bi-arrow-left-square"
                data-bs-toggle="tooltip" data-bs-title="Default tooltip data-bs-title=">
            </i>
        </a>

    <?php
    else:
    ?>

        <a class="voltar"
            href="<?= HOME_PAGE ?>#post-<?php echo $dados["postagem"]->getId() ?>">
            <i class="fs-4 bi bi-arrow-left-square"
                data-bs-toggle="tooltip" data-bs-title="Default tooltip data-bs-title=">
            </i>
        </a>

    <?php
    endif;
    ?>

    <div class="postagem">

        <div class="postLeft">

            <!--IMAGEM DA POSTAGEM -->
            <div class="imgPost">

                <img
                    class="img"
                    src="/PFC/arquivos/imgs/<?= $dados["postagem"]->getImagem(); ?>"
                    alt="Imagem da postagem">

                <button
                    onclick="document.querySelector('#modal').show(); document.querySelector('#modal').style.display = 'flex';" ;
                    class="expand justify-content-center btnInsert">
                    <i class="ampliar bi bi-arrows-angle-expand"></i>
                </button>

            </div>

            <dialog id="modal">

                <img
                    id="imgModal"
                    class="img"
                    src="/PFC/arquivos/imgs/<?= $dados["postagem"]->getImagem(); ?>"
                    alt="Imagem da postagem">

                <button
                    onclick="document.querySelector('#modal').close(); document.querySelector('#modal').style.display = 'none';"
                    class="close-button">
                    X
                </button>

            </dialog>




        </div>

        <div class="postRight position-relative">

            <div class="topOpt">
                <button
                    data-bs-target="#postModal"
                    data-bs-toggle="modal">
                    <svg id="denunciaSVG" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z" />
                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                    </svg>
                </button>

                <?php
                if (
                    ($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == TipoUsuario::ESTUDANTE
                    && $dados["postagem"]->getUsuario()->getId() == $_SESSION[SESSAO_USUARIO_ID])
                    || $_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == TipoUsuario::ADM
                ):
                ?>

                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='dots-excluir bi bi-three-dots'></i>
                        </button>
                        <ul class="dropdown-menu delete-post" aria-labelledby="dropdownMenuButton">
                            <li><a class="" href="/PFC/app/controller/PostagemController.php?action=delPost&id=<?= $dados['postagem']->getId() ?>">Excluir Postagem</a></li>
                        </ul>
                    </div>

                <?php
                endif;
                ?>

            </div>



            <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form
                                id="formDenuncia"
                                method="post"
                                action="<?= BASEURL ?>/controller/DenunciaController.php?action=insertDenuncia&id=<?php echo $dados['postagem']->getId(); ?>">
                                <!-- Motivo -->
                                <div class="mb-2 motivo">
                                    <label id="labelMotivo" for="motivo">Qual é o motivo da denuncia?</label>
                                    <input placeholder="Não obrigatório" type="text" class="form-control" id="motivo" name="motivo">
                                </div>

                                <button type="submit" class="btn btn-custom">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!--LEGENDA E COMENTÁRIOS -->
            <div class="infos">
                <div class="usuario">
                    <img
                        class="fotoPerfil"
                        src="<?php echo $usuario->getFotoPerfil() != null
                                    ? "/PFC/arquivos/fotosPerfil/" . $usuario->getFotoPerfil()
                                    : "https://s3.amazonaws.com/37assets/svn/765-default-avatar.png"; ?>"
                        alt="Foto de Perfil">

                    <?php
                    if ($dados["postagem"]->getUsuario()->getId() == $_SESSION[SESSAO_USUARIO_ID]):
                    ?>
                        <a href="/PFC/app/controller/UsuarioController.php?action=perfilUsuario">

                        <?php
                    else:
                        ?>
                            <a href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?= $dados["postagem"]->getUsuario()->getId() ?>">
                            <?php
                        endif;
                            ?>
                            <span class="nomeUsuario">
                                <?php echo $dados["nomeUsuario"]; ?>
                                <?php
                                if ($dados["tipoUsuario"] == "ADM"):
                                ?>
                                    <i class="bi bi-patch-check verificado" title="Este usuário é um ADM do sistema"></i>
                                <?php endif ?>
                            </span>
                            </a>
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
                    ?>
                            <?php
                            if ($comentario->getUsuario()->getId() == $_SESSION[SESSAO_USUARIO_ID]):
                            ?>
                                <a href="/PFC/app/controller/UsuarioController.php?action=perfilUsuario">

                                <?php
                            else:
                                ?>
                                    <a href="/PFC/app/controller/UsuarioController.php?action=perfil&id=<?= $comentario->getUsuario()->getId() ?>">
                                    <?php
                                endif;
                                    ?> <div class="fotoPerfilComent">
                                        <img class="fotoPerfil mb-0"
                                            src="<?php echo $comentario->getUsuario()->getFotoPerfil() != null
                                                        ? "/PFC/arquivos/fotosPerfil/" . $comentario->getUsuario()->getFotoPerfil()
                                                        : "https://s3.amazonaws.com/37assets/svn/765-default-avatar.png"; ?>"
                                            alt="Foto de Perfil">
                                    </div>
                                    <?php


                                    echo "<span class='userComent'>" . $comentario->getUsuario()->getNomeUsuario() . "</span>";
                                    echo "</a></div>";
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

                                        if (($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == TipoUsuario::ESTUDANTE
                                            && $comentario->getUsuario()->getId() == $_SESSION[SESSAO_USUARIO_ID])
                                            || $_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == TipoUsuario::ADM):
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
                                        <?php
                                        endif;
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
                    <button form="formComent" type="submit" id="insertComent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z" />
                        </svg>
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