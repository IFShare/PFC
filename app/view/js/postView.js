$(document).ready(function() {
    $(".post").click(function() {
        var idPost = $(this).find('.idPost').val(); 

        $.ajax({
            url: '/PFC/app/controller/PostagemController.php?action=viewPost&id=' + idPost,
            method: 'POST',
            data: {post: idPost},
            dataType: 'json'
        }).done(function(result){
            // Preencher o modal com os dados recebidos do PHP
            if (result) {
                // Nome do usuário
                $('#nomeUsuario').text(result.nomeUsuario);

                // Verificar se o usuário é ADM e adicionar o ícone de verificação se for
                if (result.tipoUsuario === 'ADM') {
                    $('#nomeUsuario').append('<abbr title="Este usuário é um ADM do sistema"><i class="bi bi-patch-check verificado"></i></abbr>');
                }

                // Imagem do post
                $('#modalImgPost').attr('src', '/PFC/arquivos/' + result.imgPost);

                // Legenda
                $('#legenda').text(result.postagem.legenda); // Supondo que 'legenda' esteja dentro de 'postagem'

                // Contador de curtidas
                $('#modalLikes').text(result.countLikes + (result.countLikes == 1 ? ' Curtida' : ' Curtidas'));

                // Atualizar o ícone de curtida
                if (result.curtidaExistente) {
                    $('#modalLikeButton').css('color', 'red');
                } else {
                    $('#modalLikeButton').css('color', '');
                }

                // Abrir o modal
                document.getElementById('postDialog').showModal();
            }
        }).fail(function() {
            alert('Erro ao carregar a postagem.');
        });
    });
});


function changeData() {
    var dataCompleta = document.querySelector('#dataCompleta');
    var dataResumida = document.querySelector('#dataResumida');

    if (dataCompleta.style.display == 'none') {
        dataCompleta.style.display = 'block'; 
        dataResumida.style.display = 'none'; 
    } else {
        dataCompleta.style.display = 'none'; 
        dataResumida.style.display = 'block'; 
    }
}
