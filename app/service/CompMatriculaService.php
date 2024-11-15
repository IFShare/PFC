<?php

require_once(__DIR__ . "/../model/Usuario.php");

class CompMatriculaService
{


    /* Método para salvar os arquivo em diretório */
    public function salvarArquivo(Usuario $usuario, array $compMatricula)
    {
        //Captura o nome e a extensão do arquivo
        $arquivoNome = explode('.', $compMatricula['name']);
        $arquivoExtensao = $arquivoNome[count($arquivoNome)-1];

        $nomeUsuario = $usuario->getNomeUsuario();
        $nomeArquivoSalvar = "compMatricula_" . $nomeUsuario . "." . $arquivoExtensao;

        //Salva o arquivo no diretório defindo em $PATH_ARQUIVOS
        if (move_uploaded_file($compMatricula["tmp_name"], PATH_ARQUIVOS_COMPMATRICULA . "/" . $nomeArquivoSalvar)) {
            return $nomeArquivoSalvar;
        } else {
            return null;
        }

    }
}
