const file = document.querySelector('#fileImg');
const img = document.querySelector('#imgPreview');
const preview = document.querySelector('.preview');

preview.addEventListener("click", function() {
    file.click();
});

file.addEventListener("change", function(e) {
    if(file.files.length <= 0) { // Corrigido "length"
        return;
    }

    let reader = new FileReader();

    reader.onload = function() {
        img.src = reader.result;
        img.removeAttribute('hidden'); // Remove o atributo "hidden" para mostrar a imagem
        document.querySelector("#h2Text").setAttribute("hidden", true); // Oculta o texto
        console.log(reader.result); // Mostra o link da imagem em Base64 no console
    }

    reader.readAsDataURL(file.files[0]);
});
