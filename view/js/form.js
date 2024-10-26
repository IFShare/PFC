var verSenha = 
document.querySelector('#ver');

var inpSenha =
document.querySelector('#txtSenha');

verSenha.addEventListener("click", function() {
    if (inpSenha.type === "password") {
        inpSenha.type = "text";
        verSenha.textContent = "Ocultar senha";
    } else if (inpSenha.type === "text") {
        inpSenha.type = "password";
        verSenha.textContent = "Mostrar senha";
    }
});