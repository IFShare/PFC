<?php
require_once(__DIR__ . "/../include/header.php");
?>

<style>
    body {
        height: 100vh;
        width: 100%;
        margin: 0;
        padding: 0;
        background: linear-gradient(90deg, #81a880, #004f44);
    }

    .container {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .mensagem {
        padding: 20px;
        border-radius: 15px;
        transition: all 0.4s;
    }

    .mensagem h1 {
        font-size: 50px;
        font-weight: bold;
        transition: all 0.4s;
    }

    .mensagem p {
        font-size: 25px;
    }

    .btn-custom {
    background-color: #004f44;
    color: white;
    border: none;
    border-radius: 30px;
    padding: 5px 20px;
    font-size: 25px;
    font-weight: bold;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s, transform 0.3s;

}

</style>

<div class="container">

    <div class="mensagem">

        <h1>Acesso Negado!</h1>
        <p>Você não tem permissão para acessar esta página.</p>

    </div>

    <div class="voltar mt-3">
        <a class="btn btn-custom" href="/PFC/app/controller/HomeController.php?action=home">
            Voltar
        </a>
    </div>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>