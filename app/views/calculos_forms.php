<?php
if ($_SESSION) {

$_SESSION['user'] = $data['user'];


$idade = $data['user']['idade'];
$user_sex = $data['user']['sexo'];
$user_id = $data['user']['id'];
}
?>

<section id="calculos" class="container my-5 text-center">
    PAGINA APENAS EM JS
    <h2>Calculos</h2>
    Harris-Benedict
    A fórmula Navy Seals
    <div class="mb-3">
        <h3>Calculadora de Percentual de Gordura</h3>
        <h4>APENAS ESTIMATIVA!!</h4>
        <p>
            A fórmula Navy para homens é:<br>
            BF = 86.010 * 1 * (abdomen - pescoço) - 70.041 * 1 * (altura) + 30.30
            <br>
            <br>
            Para mulheres:<br>
            BF = 163.205 * 1 * (cintura + quadril - pescoço) - 97.684 * 1 * (altura) - 104.912

        </p>
        
        <a class="">faça já seus calculos de BF</a>

        <hr>
        colocar dorpdown ao lado e descer o form
        <?php if($user_sex == 'f'):?>
        <div class="container">
            <div class="row justify-content-center">
                 <form class="col-6"> <!-- action="?ct=main&mt=medidas_submitF" method="post" -->
                    <h3> Para mulheres: </h3>
                    <div class="mb-3">
                        <label for="alturaF" class="form-label">Altura (cm)</label>
                        <input type="number" name="altura" class="form-control" id="alturaF">
                    </div>
                    <div class="mb-3">
                        <label for="cintura" class="form-label">Cintura (cm)</label>
                        <input type="number" name="cintura" class="form-control" id="cintura">
                    </div>
                    <div class="mb-3">
                        <label for="quadril" class="form-label">Quadril (cm)</label>
                        <input type="number" name="quadril" class="form-control" id="quadril">
                    </div>
                    <div class="mb-3">
                        <label for="pescocoF" class="form-label">Pescoço (cm)</label>
                        <input type="number" name="pescoco" class="form-control" id="pescocoF">
                    </div>
                    <button type="button" class="btn btn-primary" id="calcularF">Calcular</button>
                </form>
                <div class="col-6 d-none m-2">
                    <p>Seu Percentual de gordura é: <strong id="strongF"></strong></p>
                </div>
            </div>
        </div>
        <hr>
        <?php else: ?>
        <div class="container">
            <div class="row justify-content-center">
                <form class="col-6"> <!-- action="?ct=main&mt=medidas_submitM" method="post"  -->
                <h3> Para Homens: </h3>
                <br> 
                    <div class="mb-3">
                        <label for="alturaM" class="form-label">Altura (cm)</label>
                        <input type="number" name="altura" class="form-control" id="alturaM">
                    </div>
                    <div class="mb-3">
                        <label for="abdomen" class="form-label">abdomen (cm)</label>
                        <input type="number" name="cintura" class="form-control" id="abdomen">
                    </div>
                    <div class="mb-3">
                        <label for="pescocoM" class="form-label">Pescoço (cm)</label>
                        <input type="number" name="pescoco"class="form-control" id="pescocoM">
                    </div>
                    <button type="button" class="btn btn-primary" id="calcularM" >Calcular</button>
                </form>
                <div class="col-6 d-none m-2">
                    <p>Seu Percentual de gordura é: <strong id="strongM"></strong></p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <?php endif;?>
    <div class="mb-3">
        <h3>Calculadora de IMC</h3>
        <div class="container">
            <div class="row justify-content-center">
                <form class="col-6">
                    <div class="mb-3">
                        <label for="peso" class="form-label">Peso (kg)</label>
                        <input type="number" class="form-control" id="peso">
                    </div>
                    <div class="mb-3">
                        <label for="alturaIMC" class="form-label">Altura (cm)</label>
                        <input type="number" class="form-control" id="alturaIMC">
                    </div>
                    <button type="button" class="btn btn-primary" id="calcularIMC">Calcular</button>
                </form>
            </div>
        </div>
    </div>

    <hr>

    <div>
        <h3>Calculadora de Metabolismo Basal</h3> 
        <div class="container">
            <div class="row justify-content-center">
                <form>
                    <p>
                        Fórmula Revisada de Harris-Benedict:
                        TMB (homens) = 88,362 + (13,397 x peso em kg) + (4,799 x altura em cm) - (5,677 x idade em anos)
                        TMB (mulheres) = 447,593 + (9,247 x peso em kg) + (3,098 x altura em cm) - (4,330 x idade em anos)
                    </p>
                    <button type="button" class="btn btn-primary">Calcular</button>
                </form>
            </div>
        </div>
    </div>

</section>


<script>
    // não vai funcionar tera que ser em php
    document.addEventListener('DOMContentLoaded', function() {
        var strongF = document.getElementById("strongF");
        var strongM = document.getElementById("strongM");

        var calcularF = document.getElementById("calcularF");
        var calcularM = document.getElementById("calcularM");

        function calcularPercentualGorduraF() {
            var cintura = parseFloat(document.getElementById("cintura").value);
            var quadril = parseFloat(document.getElementById("quadril").value);
            var pescocoF = parseFloat(document.getElementById("pescocoF").value);
            var alturaF = parseFloat(document.getElementById("alturaF").value);

            var BFf = 163.205 * 1 * (cintura + quadril - pescocoF) - 97.684 * 1 * alturaF - 104.912;

            strongF.textContent = "Seu Percentual de gordura é: " + BFf.toFixed(2) + "%";
            strongF.classList.remove("d-none");
        }

        function calcularPercentualGorduraM() {
            var abdomen = parseFloat(document.getElementById("abdomen").value);
            var pescocoM = parseFloat(document.getElementById("pescocoM").value);
            var alturaM = parseFloat(document.getElementById("alturaM").value);

            var BFm = 86.010 * 1 * (abdomen - pescocoM) - 70.041 * 1 * alturaM + 30.30;

            strongM.textContent = "Seu Percentual de gordura é: " + BFm.toFixed(2) + "%";
            strongM.classList.remove("d-none");
        }

        calcularF.addEventListener("click", calcularPercentualGorduraF);
        calcularM.addEventListener("click", calcularPercentualGorduraM);
    });
</script>