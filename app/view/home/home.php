<?php
#View para a home do sistema

//require_once(__DIR__ . "/../include/header.php");
//require_once(__DIR__ . "/../include/menu.php");
?>

<div class="row mt-3 justify-content-center">
    <h1>"HOME PAGE"</h1>
    <div class="col-3 text-center">

        <a href="/PFC/app/controller/UsuarioController.php?action=save">FORM</a>
        <p>em andamento.</p>

        <ul>
            <?php
            foreach ($dados["listaUsuarios"] as $u) {
                echo "<li>" . $u->getNomeSobrenome() . "</li>";
            }
            ?>
        </ul>
    </div>

</div>

<script src="<?= BASEURL ?>/view/home/home.js"></script>

<?php
//require_once(__DIR__ . "/../include/footer.php");
?>