<?php

require_once(__DIR__ . "/../model/Post.php");

class PostagemService
{

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Post $post)
    {
        $erros = array();

        //Validar campos vazios
        if (! $post->getImagem())
            $erros['imagem'] = "Escolha uma imagem.";

        return $erros;
    }
}
