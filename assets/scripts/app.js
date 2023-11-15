// CALCULOS BF IMC E ETC
document.addEventListener('DOMContentLoaded', function () {
    var strongF = document.getElementById('strongF');
    var strongM = document.getElementById('strongM');

    var calcularF = document.getElementById('calcularF');
    var calcularM = document.getElementById('calcularM');

    function calcularPercentualGorduraF() {
        var cintura = parseFloat(document.getElementById('cintura').value);
        var quadril = parseFloat(document.getElementById('quadril').value);
        var pescoçoF = parseFloat(document.getElementById('pescoçoF').value);
        var alturaF = parseFloat(document.getElementById('alturaF').value);

        var BFf = 163.205 * 1 * (cintura + quadril - pescoçoF) - 97.684 * 1 * alturaF - 104.912;

        strongF.textContent = "Seu Percentual de gordura é: " + BFf.toFixed(2) + "%";
        strongF.classList.remove("d-none");
    }

    function calcularPercentualGorduraM() {
        var abdomen = parseFloat(document.getElementById('abdômen').value);
        var pescoçoM = parseFloat(document.getElementById('pescoçoM').value);
        var alturaM = parseFloat(document.getElementById('alturaM').value);

        var BFm = 86.010 * 1 * (abdomen - pescoçoM) - 70.041 * 1 * alturaM + 30.30;

        strongM.textContent = "Seu Percentual de gordura é: " + BFm.toFixed(2) + "%";
        strongM.classList.remove("d-none");
    }

    calcularF.addEventListener('click', calcularPercentualGorduraF);
    calcularM.addEventListener('click', calcularPercentualGorduraM);
});

document.addEventListener('DOMContentLoaded', function () {
    if (!$.fn.DataTable.isDataTable('#myTable')) {
        $('#myTable').DataTable({
            order: [[12, 'asc']]
            // Outras configurações do DataTable, se necessário
        });
    }
});


/*
function limparform() {
    document.getElementById('LimparBtn').addEventListener('click', () => {

        document.getElementById("text_name").focus();
        document.getElementById("text_birthdate").focus();
        document.getElementById("text_email").focus();
        document.getElementById("text_senha").focus();
        document.getElementById("text_phone").focus();
        document.getElementById("text_###").focus();

    });
}
*/

function toggleForm(form) {
    form.classList.toggle("d-none");
}

function limparFormulario(form) {
    form.reset();
    form.querySelector('input').focus();
}

// Adiciona evento de clique aos botões para mostrar/ocultar o formulário
document.querySelectorAll(".btn").forEach((btn) => {
    btn.addEventListener("click", () => {
        const formContainer = btn.parentElement.nextElementSibling;
        toggleForm(formContainer);
        limparFormulario(formContainer);


    });
});



flatpickr("#text_birthdate", {
    dateFormat: "d/m/Y"
})



const input = document.querySelector("#text_phone");
window.intlTelInput(input, {
    initialCountry: "br",
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js", // "/intl-tel-input/js/utils.js?1690975972744" // just for formatting/placeholders etc
});