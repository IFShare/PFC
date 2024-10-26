$(document).ready(function() {
    $("#likeButton").click(function() {
        
        var idPost = $('#idPost').val();
        var idUsuario = $('#idUsuario').val();
        // Teste para verificar os valores
        //console.log(idPost, idUsuario);

        $.ajax({
            url: '/PFC/app/controller/CurtidaController.php?action=likeDislike&id=' + idPost,
            method: 'POST',
            data: {post: idPost, user: idUsuario},
            dataType: 'json'
        }).done(function(result){
            console.log(result);

            if (result.status === 'like') {
                $('#likeButton').css('color', 'red');
            } else if (result.status === 'dislike') {
                $('#likeButton').css('color', 'white');
            }
            
            // Atualiza o contador de curtidas
            $('#likes').text(result.totalLikes);
        });

    });
});
