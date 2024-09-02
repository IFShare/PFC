<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login IFShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">


    <style>

    .font-abril {
        font-family: 'Abril Fatface', cursive; /* Fonte personalizada */
    }
    .title-ifshare {
        font-size: 3rem; /* Ajuste o tamanho da fonte conforme necessário */
        color: #000; /* Cor desejada */
    }

        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            background: linear-gradient(90deg, #81a880, #004f44);
        }

        .form-container {
            height: 100vh; /* altura da tela inteira */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-content {
            background-color: #fff; /* Cor de fundo do formulário */
            border-radius: 8px; /* Bordas arredondadas */
            padding: 20px; /* Espaçamento interno */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra */
            max-width: 400px; /* Largura máxima do formulário */
            width: 100%; /* Largura total dentro do máximo */
        }

        .btn-custom {
            background-color: #004f44; /* Cor de fundo */
            color: #fff; /* Cor do texto */
            border: none; /* Remove a borda padrão */
            border-radius: 30px; /* Bordas arredondadas */
            padding: 10px 20px; /* Espaçamento interno */
            font-size: 16px; /* Tamanho da fonte */
            font-weight: bold; /* Peso da fonte */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra */
            transition: background-color 0.3s, transform 0.3s; /* Transição */
        }

        .btn-custom:hover {
            background-color: #81a880; /* Cor do botão ao passar o mouse */
            transform: scale(1.05); /* Aumenta o botão */
        }

        .form-control, .form-select {
            border-radius: 8px; /* Bordas arredondadas */
            border: 1px solid #000; /* Cor da borda */
            padding: 8px; /* Reduzir o padding interno para diminuir a altura */
            font-size: 14px; /* Diminuir o tamanho da fonte */
            line-height: 1.2; /* Reduzir o espaçamento entre linhas */
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1); /* Sombra interna */
            transition: border-color 0.3s, box-shadow 0.3s; /* Transição suave */
            height: 30px; /* Definir uma altura fixa */
            background-color: transparent; /* Cor de fundo para combinar com o site */
            color: #000; /* Cor do texto */
        }

        .form-control:focus, .form-select:focus {
            background-color: transparent; /* Manter o fundo transparente ao foco */
            border-color: #fff; /* Borda branca ao foco */
            outline: none; /* Remove o contorno padrão */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); /* Sombra externa ao foco */
        }

        .form-label {
            font-size: 16px; /* Tamanho da fonte */
            color: #000; /* Cor do texto */
            margin-bottom: 4px; /* Espaço abaixo do rótulo */
        }
    </style>
</head>
<body>
