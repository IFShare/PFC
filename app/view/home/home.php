<?php
#View para a home do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">

<div class="row mt-4 justify-content-center w-100">
    <div class="col-4 textCentral">
        <div class="text-center">Usuários ativos: 

        <span class="badge badge-info text-center bg-dark">
            <?= $dados["totalUsuarios"] ?>
        </span>

        </div>

        <ul class="text-left mt-2">
            <?php
            foreach ($dados["listaUsuarios"] as $u) {
                echo "<li>" . $u->getNomeUsuario() . " " . "<span class='fw-bold'>" . $u->getTipoUsuario() . "</span> </li>";
            }
            ?>
        </ul>

    </div>

    <?php

            if($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM") {
                echo "<div class='btnInsertDiv'>
                        <a class='btn btn-custom' href='/PFC/app/controller/UsuarioController.php?action=create'>INSERIR NOVO USUÁRIO</a>
                      </div>

                      <div class='post btnInsertDiv mt-2'>
                        <a href='/PFC/app/controller/PostagemController.php?action=createPost' class='btn btn-custom'>ADICIONAR POSTAGEM</a>
                      </div>";
                } else {
                     echo "";
            }
?>

    


</div>

<div class="row w-100 mt-3">
    <div class="col-12 d-flex justify-content-center">

    </div>
</div>


<?php
require_once(__DIR__ . "/../include/footer.php");
?>