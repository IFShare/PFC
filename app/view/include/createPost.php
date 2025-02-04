<style>
    .btn-post-custom {
        background: none;
        color: black;
        border: 3px solid #1a5f53;
        border-radius: 30px;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.5s, transform 0.3s;
    }

    .btn-post-custom.reset {
        background-color: #1a5f53;
        margin-left: auto;
        color: white;
    }

    .btn-post-custom:hover {
        color: white;
        background-color: #1a5f53;
        transform: scale(1.05);
    }

    .post-modal-header {
        padding-bottom: 0;
        border: none;
    }

    .post-modal-body {
        width: 100%;
        height: 100%;
        border-radius: 20px;
        box-shadow: 0px 0px 30px #1a5f53;
        padding: 16px;
    }

    .post-modal-content {
        transition: all 0.4s;
        border-radius: 25px;
        width: 100%;
        height: 100%;
    }

    #postModalNew {
        backdrop-filter: blur(10px);
    }

    #labelLegendaNew {
        color: black;
    }

    #txtLegendaNew {
        color: black;
        border: 3px solid #1a5f53;
        border-radius: 10px;
        resize: none;
        outline: none;
        transition: all 0.2s;
        padding: 10px 20px;
        font-size: 18px;
        font-weight: bold;
    }

    #txtLegendaNew:focus {
        box-shadow: none;
        border: 3px solid #81a880;
    }

    .post-preview {
        border-radius: 15px;
        border: 4px solid #1a5f53;
        transition: all 0.3s;
    }

    .post-preview:hover {
        border: 4px solid #81a880;
    }

    #imgPreviewAddPost {
        width: 100%;
        border-radius: 10px;
    }

    #imgPreviewAddPost:hover {
        width: 100%;
        border-radius: 10px;
    }

    .dark .post-modal-body {
        background-color: #0b362e;
    }

    .dark #txtLegendaNew {
        color: white;
        background: none;
    }

    .dark #labelLegendaNew {
        color: white;
    }

    .dark .btn-post-custom {
        margin-top: 10px;
        color: white;
        border: 2px solid #1a5f53;
        border-radius: 30px;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, transform 0.3s;
    }

    .dark .btn-post-custom.reset {
        background-color: #1a5f53;
        margin-left: auto;
        color: white;
    }

    .dark .btn-post-custom:hover {
        transform: scale(1.05);
    }

    .nomeArquivoAddPost {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .nomeArquivoAddPost label {
        color: white;
        text-align: center;
        border: 2px solid #81a880;
        width: 70%;
        border-radius: 20px;
        padding: 10px 5px;
        margin: 10px 0 5px 0;
        cursor: pointer;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .nomeArquivoAddPost label {
        cursor: pointer;
        color: black;
    }

    .dark .nomeArquivoAddPost label {
        color: white;
    }


    .nomeArquivoAddPost label:hover {
        background-color: #81a880;
        color: black;
    }
</style>

<?php

$action = isset($_GET['action']) ? $_GET['action'] : '';
$view = '';

if ($action == 'perfilUsuario') {
    $view = "&view=perfilUsuario";
}

?>

<!-- Modal de Inserção de Postagem -->
<div class="modal fade" id="postModalNew" tabindex="-1" aria-labelledby="postModalLabelNew" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content post-modal-content">
            <div class="modal-body post-modal-body">
                <form
                    id="formPostNew"
                    enctype="multipart/form-data" method="post"
                    action="<?= BASEURL ?>/controller/PostagemController.php?action=save<?= $view ?>">

                    <!-- Imagem -->
                    <div class="mb-2 post-preview">
                        <input hidden type="file" class="form-control" id="fileImgNew" name="imagem" accept="image/*" required>
                        <img id="imgPreviewAddPost" src="/PFC/app/assets/addPost.png" alt="Preview">
                    </div>

                    <div class="nomeArquivoAddPost">
                        <label id="labelFileImg" for="fileImgNew">Escolha uma foto de perfil</label>
                    </div>


                    <!-- Legenda -->
                    <div class="mb-1">
                        <label id="labelLegendaNew" for="txtLegendaNew" class="mb-1">
                            Legenda</label>
                        <textarea
                            class="form-control"
                            id="txtLegendaNew"
                            name="legenda"
                            rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn btn-post-custom">Publicar</button>
                    <button type="reset" class="btn btn-post-custom reset">Limpar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('fileImgNew').addEventListener('change', function() {
        const fileInput = this;
        const imgPreview = document.getElementById('imgPreviewAddPost');
        const fileNameLabel = document.getElementById('labelFileImg');

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const reader = new FileReader();

            // Atualiza o preview da imagem
            reader.onload = function() {
                imgPreview.src = reader.result;
            };
            reader.readAsDataURL(file);

            fileNameLabel.textContent = file.name;
        } else {
            fileNameLabel.textContent = 'Escolha uma foto de perfil';
        }
    });

</script>