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


document.addEventListener('DOMContentLoaded', function() {
    var legenda = document.getElementById('legenda');

    // Verifica se o conteúdo da legenda é maior que a altura da div
    if (legenda.scrollHeight > legenda.clientHeight) {
        // Habilita o scroll e aplica os estilos
        legenda.style.overflowY = 'scroll';

        // Adiciona os estilos de barra de rolagem
        legenda.classList.add('scroll-styles');
    }
});