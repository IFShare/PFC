

var search = document.querySelector('#pesquisar');

search.addEventListener("keydown", function(e) {
    if(e.key === "Enter") {
        searchData();
    }
})

function searchData() {
    window.location = 'HomeController.php?action=home&search=' + search.value;
}

window.addEventListener('scroll', function() {
    const arrowUp = document.querySelector('#arrowUp');
    if (window.scrollY > 100) {
        arrowUp.classList.add('show');
    } else {
        arrowUp.classList.remove('show');
    }
});











