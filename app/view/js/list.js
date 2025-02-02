var search = document.querySelector('#pesquisar');

search.addEventListener("keydown", function(e) {
    if(e.key === "Enter") {
        searchData();
    }
})

function searchData() {
    window.location = 'UsuarioController.php?action=list&search=' + search.value;
}


function confirmAction() {
    var senhaDel = prompt('Digite a senha para confirmar a ação:', '')

    if(senhaDel == "ifshare2025") 
        return true
    else
        alert("Senha incorreta.");
        return false;
}