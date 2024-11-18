var search = document.querySelector('#pesquisar');

search.addEventListener("keydown", function(e) {
    if(e.key === "Enter") {
        searchData();
    }
})

function searchData() {
    window.location = 'UsuarioController.php?action=list&search=' + search.value;
}