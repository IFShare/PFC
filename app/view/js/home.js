const file =
document.querySelector('#fileImg');

const img = 
document.querySelector('#imgPreview');

var search = document.querySelector('#pesquisar');

search.addEventListener("keydown", function(e) {
    if(e.key === "Enter") {
        searchData();
    }
})

function searchData() {
    window.location = 'HomeController.php?action=home&search=' + search.value;
}

img.addEventListener("click", function() {
    file.click();
});

file.addEventListener("change", function(e) {

    if(file.files.length <= 0) {
        return;
    }

    let reader = new FileReader();

    reader.onload = function() {
        img.src = reader.result;
        console.log(reader.result);
    }

    reader.readAsDataURL(file.files[0]);

})

window.addEventListener('scroll', function() {
    const arrowUp = document.querySelector('#arrowUp');
    if (window.scrollY > 100) {
        arrowUp.classList.add('show');
    } else {
        arrowUp.classList.remove('show');
    }
});











