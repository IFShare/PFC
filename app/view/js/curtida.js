$(document).ready(function() {
    $("#likeButton").click(function() {
        
        var idPost = $('#idPost').val();
        var idUsuario = $('#idUsuario').val();
        //console.log(idPost, idUsuario);

        $.ajax({
            url: '/PFC/app/controller/CurtidaController.php?action=likeDislike&id=' + idPost,
            method: 'POST',
            data: {post: idPost, user: idUsuario},
            dataType: 'json'
        }).done(function(result){
            if (result.status === 'like') {
                $('#likeButton').css('color', 'red');
            } else if (result.status === 'dislike') {
                $('#likeButton').css('color', 'white');
            }
            
            if(result.totalLikes == 1) {
                $('#likes').text(result.totalLikes + " Curtida");
            } else {
                $('#likes').text(result.totalLikes + " Curtidas");
            }
            console.log(result);

        });

    });
});
