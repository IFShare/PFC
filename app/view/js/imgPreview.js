const file = document.querySelector('#fileImg');
const img = document.querySelector('#imgPreview');
const preview = document.querySelector('.preview');

file.addEventListener("change", function(e) {
    if(file.files.length <= 0) { 
        return;
    }

    let reader = new FileReader();

    reader.onload = function() {
        img.src = reader.result;
        img.removeAttribute('hidden'); 
        document.querySelector("#h2Text").setAttribute("hidden", true);
        console.log(reader.result); 
    }

    reader.readAsDataURL(file.files[0]);
});
