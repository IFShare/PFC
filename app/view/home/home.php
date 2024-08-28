<?php
#View para a home do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="row mt-3 justify-content-center">
    <div class="col-12 text-center">
        <span>Usuários ativos: </span>

        <span class="badge badge-info">
            <?= $dados["totalUsuarios"] ?>
        </span>

        <ul>
            <?php
            foreach ($dados["listaUsuarios"] as $u) {
                echo "<li>" . $u->getNomeUsuario() . "</li>";
            }
            ?>
        </ul>

    </div>

    <div>
        <a href="/PFC/app/controller/UsuarioController.php?action=create">FORM DE TESTES</a>
        <p>em andamento.</p>
    </div>


</div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>