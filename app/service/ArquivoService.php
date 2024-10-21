<?php

require_once(__DIR__ . "/../model/Post.php");

class ArquivoService
{

    /* Método para salvar os arquivo em diretório */
    public function salvarArquivo(array $arquivo)
    {
        //Captura o nome e a extensão do arquivo
        $arquivoNome = explode('.', $arquivo['name']);
        $arquivoExtensao = $arquivoNome[count($arquivoNome)-1];

        //A partir da extensão, o ideal é gerar um nome único para o arquivo a fim de encontrá-lo depois
        //Exemplo: pode-se concatenar um identificador único do tipo UUID
        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
        $nomeArquivoSalvar = "arquivo_" . $uuid . "." . $arquivoExtensao;

        //Salva o arquivo no diretório defindo em $PATH_ARQUIVOS
        if (move_uploaded_file($arquivo["tmp_name"], PATH_ARQUIVOS . "/" . $nomeArquivoSalvar)) {
            return $nomeArquivoSalvar;
        } else {
            return null;
        }

    }
}
