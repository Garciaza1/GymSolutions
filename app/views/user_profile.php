<?php
//tem que pegar num MT diferente do model User_data fazer a seleção do ultimo id 

$nome = $data['user']['nome'];
$sexo = $data['user']['sexo'];
$idade = $data['user']['idade'];

if ($sexo == 'm') {
    $sexoCompleto = "Masculino";
} elseif ($sexo == 'f') {
    $sexoCompleto = "Feminino";
}

$id = $data['user_data']['id']; 
$userId = $data['user_data']['UserId'];
$meta = $data['user_data']['Meta'];
$peso = $data['user_data']['Peso'];
$altura = $data['user_data']['Altura'];
$basal = $data['user_data']['Basal'];
$cintura = $data['user_data']['Cintura'];
$pescoco = $data['user_data']['Pescoco'];
$braco = $data['user_data']['Braco'];
$antebraco = $data['user_data']['Antebraco'];
$quadril = $data['user_data']['Quadril'];
$cinturaEscapular = $data['user_data']['CinturaEscapular'];
$perna = $data['user_data']['Perna'];
$panturrilha = $data['user_data']['Panturrilha'];
$gordura = $data['user_data']['gordura'];

?>

<div class="container mt-5">
    <h1 class="text-center pb-4">Seus Dados</h1>
    <?php if (empty($data['user_data'])) : ?>
            <br>
            <h3>Não tem dados na tabela. Preencha agora mesmo -> <a href="?ct=main&mt=novas_medidas">Aqui!</a></h3>
            <button><a href="?ct=main&mt=index">Voltar</a></button>

    <?php else : ?>
        <div class="container p-2 d-flex justify-content-evenly">
            <div class="col-6 border rounded-2 border-dark border-4">
                <div class="menu-header container">
                    <p>
                        <h6 class="text-danger text-center col-12 ">Ultimas medidas que colocou</h6>
                        <h4>
                            <div class="py-1">Nome: <strong> <?= $nome ?></strong></div>
                            <div class="py-1">Idade: <strong><?= $idade ?> Anos</strong></div>
                            <div class="py-1">Sexo: <strong><?= $sexoCompleto ?></strong></div>
                            <div class="py-1">Gordura: <strong><?= $gordura ?>%</strong></div>
                            <div class="py-1">Basal: <strong><?= $basal ?> Calorias</strong></div>
                            <div class="py-1">Peso: <strong> <?= $peso ?>Kg</strong></div>
                            <div class="py-1">Altura:<strong><?= $altura ?>cm</strong></div>
                            <div class="py-1">Cintura: <strong><?= $cintura ?>cm</strong></div>
                            <div class="py-1">Pescoco: <strong><?= $pescoco ?>cm</strong></div>
                            <div class="py-1">Braco: <strong><?= $braco ?>cm</strong></div>
                            <div class="py-1">Antebraco: <strong><?= $antebraco ?>cm</strong></div>
                            <div class="py-1">Quadril: <strong><?= $quadril ?>cm</strong></div>
                            <div class="py-1">Cintura Escapular: <strong><?= $cinturaEscapular ?>cm</strong></div>
                            <div class="py-1">Perna: <strong><?= $perna ?>cm</strong></div>
                            <div class="py-1">Panturrilha: <strong><?= $panturrilha ?>cm</strong></div>
                            <div class="py-1">Meta: <strong> <?= $meta ?></strong></div>
                        </h4>
                    </p>
                </div>
            </div>
        </div>

        <div class="container mt-5 text-center">
            <!-- Link para o data_table -->
            <h2 class=" text-center "><a class="text-danger" href="?ct=main&mt=userdata_table">Veja todos os dados inseridos</a></h2>

        </div>
    <?php endif; ?>
</div>