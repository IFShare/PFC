<style>
    #myToast {
        background-color: #004f44;
        /* Fundo principal verde */
        color: #ffffff;
        /* Texto branco */
        border: 2px solid #81a880;
        /* Borda verde escuro */
        border-radius: 8px;
        /* Bordas arredondadas */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Sombra leve */
    }

    #myToast .toast-header {
        background-color: #81a880;
        /* Verde mais escuro para o cabeçalho */
        color: #004f44;
        /* Texto branco */
        font-weight: bold;
        /* Negrito no título */
        border-bottom: 1px solid #004f44;
    }


    #myToast .toast-body {
        font-size: 1rem;
        /* Tamanho da fonte */
        padding: 1rem;
        /* Espaçamento interno */
        text-align: justify;
        /* Alinha o texto */
    }

    #myToast .mt-2.pt-2.border-top {
        border-top: 1px solid #388E3C;
        /* Linha divisória verde */
        padding-top: 0.5rem;
        /* Espaçamento no topo */
    }

    #myToast .msgToast {
        font-size: 1rem;
        padding: 7px;
        border-radius: 10px;
        background: transparent;
        /* Fundo verde escuro */
        border-color: #81a880;
        /* Borda combinando */
        color: #ffffff;
        /* Texto branco */
        border: 2px solid #81a880;
    }

    #myToast .msgToast:hover {
        font-size: 1rem;
        padding: 7px;
        border-radius: 10px;
        background: #81a880;
        /* Fundo verde escuro */
        border-color: #81a880;
        /* Borda combinando */
        color: #004f44;
        /* Texto branco */
    }
</style>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="myToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">IFShare</strong>
            <button type="button" class="btn-close btn-success" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php
            if (isset($_SESSION['login_naoverificado'])  && $_SESSION['login_naoverificado'] == true):
            ?>
                Olá, <?= $usuarioLogado->getNomeUsuario() ?>! 😊Sua declaração de matrícula está em análise!

            <?php
            elseif (isset($_SESSION['fotoPerfilSaved'])  && $_SESSION['fotoPerfilSaved'] == true):
            ?>
                Foto de perfil alterada com sucesso!

            <?php
            elseif (isset($_SESSION['senhaSaved'])  && $_SESSION['senhaSaved'] == true):
            ?>
                Senha alterada com sucesso!

            <?php
            elseif (isset($_SESSION['perfilSaved'])  && $_SESSION['perfilSaved'] == true):
            ?>
                Perfil alterado com sucesso!

            <?php
            elseif (isset($_SESSION['fotoDeleted'])  && $_SESSION['fotoDeleted'] == true):
            ?>
                Foto de perfil excluída com sucesso!

            <?php
            elseif (isset($_SESSION['userDeleted'])  && $_SESSION['userDeleted'] == true):
            ?>
                Usuário excluído com sucesso!


            <?php
            elseif (isset($_SESSION['denunciaEnviada'])  && $_SESSION['denunciaEnviada'] == true):
            ?>
                Denuncia enviada.<br>
                Os admnistradores irão revisar a publicação denunciada.

            <?php
            endif;
            ?>
        </div>
        <div class="mb-2 me-2 text-end">
            <button type="button" class="btn btn-success btn-sm msgToast" data-bs-dismiss="toast">Entendi!</button>
        </div>
    </div>
</div>



<script>
    // Exibir o toast ao carregar a página
    document.addEventListener('DOMContentLoaded', () => {
        const myToastElement = document.getElementById('myToast');
        const myToast = new bootstrap.Toast(myToastElement, {
            autohide: false
        });
        myToast.show();
    });
</script>