document.addEventListener('DOMContentLoaded', function() {
    if (!$.fn.DataTable.isDataTable('#myTable')) {
        $('#myTable').DataTable({
            order: [[12, 'asc']]
            // Outras configurações do DataTable, se necessário
        });
    }
});



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