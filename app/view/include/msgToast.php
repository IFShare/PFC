<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="myToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">IFShare</strong>
                    <button type="button" class="btn-close btn-success" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Olá, <?= $usuarioLogado->getNomeUsuario() ?>! 😊Sua declaração de matrícula está em análise!
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
                    autohide: false // Desativa o fechamento automático
                });
                myToast.show();
            });
        </script>