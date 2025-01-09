<style>
    .btn-custom {
        background: none;
        color: black;
        border: 3px solid #004f44;
        border-radius: 30px;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, transform 0.3s;

    }

    .btn-custom:hover {
        color: white;
        background-color: #004f44;
        transform: scale(1.05);
    }

    .modal-header {
        padding-bottom: 0;
        border: none;
    }

    .modal-body {
        border-radius: 20px;
        box-shadow: 0px 0px 30px #004f44;
    }

    .modal-content {
        transition: all 0.4s;
        border-radius: 25px;
    }

    #postModal {
        backdrop-filter: blur(5px);
    }

    #labelLegenda {
        color: black;
    }

    /* Estilo específico do campo de edição onde o texto é inserido */
    #txtLegenda {
        color: black;
        border: 3px solid #004f44;
        border-radius: 10px;
        resize: none;
        outline: none;
        transition: all 0.2s;
        padding: 10px 20px;
        font-size: 18px;
        font-weight: bold;
    }

    #txtLegenda:focus {
        box-shadow: none;
        border: 3px solid #81a880;
    }

    .preview {
        cursor: pointer;
        border-radius: 15px;
        border: 4px solid #004f44;
        transition: all 0.3s;
    }

    .preview:hover {
        border: 4px solid #81a880;
    }

    #imgPreview {
        width: 100%;
        border-radius: 10px;
    }

    #imgPreview:hover {
        width: 100%;
        border-radius: 10px;
    }

    .dark .modal-body {
        background-color: #002923;
    }

    .dark #txtLegenda {
        color: white;
        background: none;
    }

    .dark #labelLegenda {
        color: white;
    }

    .dark .btn-custom {
        background: #81a880;
        color: white;
        border: none;
        border-radius: 30px;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, transform 0.3s;

    }

    .dark .btn-custom:hover {
        transform: scale(1.05);
    }
</style>


<!-- Modal de Inserção de Postagem -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form
                    id="formPost"
                    enctype="multipart/form-data" method="post"
                    action="<?= BASEURL ?>/controller/PostagemController.php?action=save">
                    <!-- Imagem -->
                    <div class="mb-2 preview">
                        <input hidden type="file" class="form-control" id="fileImg" name="imagem" accept="image/*" required>
                        <img id="imgPreview" src="/PFC/app/assets/Clique.png" alt="Preview"">
                    </div>

                    <?php
                        if(isset($erros['imagem'])) {
                            echo $erros['imagem'];
                        }
                    ?>

                    <!-- Legenda -->
                    <div class=" mb-1">
                        <label id="labelLegenda" for="txtLegenda" class="mb-1">Legenda</label>
                        <textarea class="form-control" id="txtLegenda" name="legenda" rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn btn-custom">Publicar</button>
                </form>
            </div>
        </div>
    </div>
</div>