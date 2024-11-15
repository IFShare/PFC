// Função para verificar o status dos botões de rádio e atualizar a exibição do campo de upload
function checkStudentStatus() {
    if (document.querySelector('#isStudent').checked) {
        document.querySelector("#compMatriculaLabel").style.display = 'block';
    } else if (document.querySelector('#notStudent').checked) {
        document.querySelector("#compMatriculaLabel").style.display = 'none';
        document.getElementById('compMatricula').value = ''; 
        document.getElementById('compMatriculaLabel').innerHTML = 'Comprovante de Matrícula';
    }
}

// Adiciona o listener para ambos os botões de rádio
document.querySelector('#isStudent').addEventListener('change', checkStudentStatus);
document.querySelector('#notStudent').addEventListener('change', checkStudentStatus);

// Executa a função para definir o estado inicial, caso um botão esteja pré-selecionado
checkStudentStatus();

function ShowCompMatricula() {
    document.querySelector("#compMatriculaLabel").style.display = 'block';
}

function CloseCompMatricula() {
    document.querySelector("#compMatriculaLabel").style.display = 'none';
}

function showFileName() {
    const fileInput = document.getElementById('compMatricula');
    const fileName = document.getElementById('compMatriculaLabel');
    fileName.textContent = fileInput.files.length > 0 ? fileInput.files[0].name : '';
}
