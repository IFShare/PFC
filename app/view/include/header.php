<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IFShare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=verified" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=send" />
    <link rel="shortcut icon" href="/PFC/app/assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= BASEURL ?>/view/css/theme-mode.css">

</head>

<style>
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #004f44;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #004f44;
        border-radius: 10px;
        border: 2px solid #e0e0e0;
        transition: all 0.5s;
    }
</style>

<?php
setlocale(LC_TIME, 'pt_BR.utf8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
?>

<body id="body">
    <?php
    $darkMode = false;
    if (isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'true') {
        $darkMode = true;
    }
    ?>
