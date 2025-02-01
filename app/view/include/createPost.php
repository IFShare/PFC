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
        transition: background-color 0.3s, transform 0.3s;
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
        border-radius: 20px;
        box-shadow: 0px 0px 30px #1a5f53;
    }

    .post-modal-content {
        transition: all 0.4s;
        border-radius: 25px;
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
        cursor: pointer;
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

    .dark .btn-post-custom:hover {
        transform: scale(1.05);
    }
</style>

<?php

$action = isset($_GET['action']) ? $_GET['action'] : '';
$view = '';

if ($action == 'perfilUsuario') {
    $view = "perfilUsuario";
} 
elseif ($action == 'home'){
    $view = "home";
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
                    action="<?= BASEURL ?>/controller/PostagemController.php?action=save&view=<?= $view ?>">

                    <!-- Imagem -->
                    <div class="mb-2 post-preview">
                        <input hidden type="file" class="form-control" id="fileImgNew" name="imagem" accept="image/*" required>
                        <img id="imgPreviewAddPost" src="/PFC/app/assets/addPost.png" alt="Preview">
                    </div>


                    <!-- Legenda -->
                    <div class="mb-1">
                        <label id="labelLegendaNew" for="txtLegendaNew" class="mb-1">
                            <?php
                            if (isset($erros['legenda'])) {
                                echo $erros['legenda'];
                            }
                            ?>
                            Legenda</label>
                        <textarea class="form-control" id="txtLegendaNew" name="legenda" rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn btn-post-custom">Publicar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    const file =
        document.querySelector('#fileImgNew');

    const img =
        document.querySelector('#imgPreviewAddPost');
    img.addEventListener("click", function() {
        file.click();
    });

    file.addEventListener("change", function(e) {

        if (file.files.length <= 0) {
            return;
        }

        let reader = new FileReader();

        reader.onload = function() {
            img.src = reader.result;
            console.log(reader.result);
        }

        reader.readAsDataURL(file.files[0]);

    })
</script>