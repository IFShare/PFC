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