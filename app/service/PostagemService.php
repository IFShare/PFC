<?php

require_once(__DIR__ . "/../model/Post.php");

class PostagemService
{

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Post $post, array $imagem)
    {
        $erros = array();

        //Validar campos vazios
        if ($imagem["size"] <= 0)
            $erros['imagem'] = "Escolha uma imagem.";

        if(strlen($post->getLegenda()) > 5) {
            $erros['legenda'] = "Legenda muito pirocuda";
        }

        return $erros;
    }
}
