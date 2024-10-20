// Função que é chamada ao clicar no botão de curtir
function curtirPostagem(idPostagem) {
    $.ajax({
        url: 'http://localhost/PFC/app/controller/CurtidaController.php?action=insertLike', // URL do controller responsável
        type: 'POST',
        data: {
            idPostagem: idPostagem
        },
        success: function(response) {
            let result = JSON.parse(response);
            if (result.success) {
                alert(result.message); // Mostra mensagem de sucesso
                // Aqui você pode atualizar o contador de curtidas, mudar a cor do botão, etc.
            } else {
                alert(result.message); // Mostra mensagem de erro
            }
        },
        error: function() {
            alert("Ocorreu um erro ao tentar curtir a postagem.");
        }
    });
}
