const file =
document.querySelector('#fileImg');

const img = 
document.querySelector('#imgPreview');

img.addEventListener("click", function() {
    file.click();
});

file.addEventListener("change", function(e) {

    if(file.files.lenght <= 0) {
        return;
    }

    let reader = new FileReader();

    reader.onload = function() {
        img.src = reader.result;
        console.log(reader.result);
    }

    reader.readAsDataURL(file.files[0]);

})

window.addEventListener ("scroll", () => {
    if(window.scrollY + window.innerHeight + 5 > document.body.scrollHeight) {
        //função para printar mais postagens na tela.
    }
})
