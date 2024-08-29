<?php
#View para a home do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">

<div class="row mt-3 justify-content-center w-100">
    <div class="col-3 textCentral">
        <div class="text-center">Usuários ativos: 

        <span class="badge badge-info text-center bg-dark">
            <?= $dados["totalUsuarios"] ?>
        </span>

        </div>

        <ul class="text-left">
            <?php
            foreach ($dados["listaUsuarios"] as $u) {
                echo "<li>" . $u->getNomeUsuario() . "</li>";
            }
            ?>
        </ul>

    </div>

    <?php

            if($_SESSION[SESSAO_USUARIO_TIPO_USUARIO] == "ADM") {
                echo "<div class='btnInsertDiv'>
                        <a class='btn btn-custom btnInsert' href='/PFC/app/controller/UsuarioController.php?action=create'>INSERÇÃO DE NOVOS USUÁRIOS</a>
                      </div>";
                } else {
                     echo "";
            }
?>

    


</div>


<?php
require_once(__DIR__ . "/../include/footer.php");
?>