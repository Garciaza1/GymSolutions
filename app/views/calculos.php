<?php

if ($_SESSION['user']) {

    $_SESSION['user'] = $data['user'];


    $idade = $data['user']['idade'];
    $user_sex = $data['user']['sexo'];
    $user_id = $data['user']['id'];
}

?>

<h1 class="text-center">Entendendo o Metabolismo e a Saúde</h1>
<h3 class="text-center m-1">❤</h3>
<h5 class="text-danger text-center">
    Ao final da pagina entre no link faça os calculos com base em fitas metricas das regiôes do corpo
</h5>
<section id="metabolismo" class="container my-5 text-center">
    <hr>
    <h2>Como Funciona o Metabolismo</h2>
    <h6>
        O metabolismo é o conjunto de processos químicos que acontecem dentro das células do nosso corpo para manter-nos vivos.
        <br><br>
        Ele envolve duas principais etapas:
        <br><br>
        Catabolismo: É o conjunto de reações químicas que quebram moléculas complexas em partes menores, liberando energia. Por exemplo, quando comemos carboidratos, o catabolismo os quebra em glicose, uma forma de açúcar que nosso corpo pode usar como fonte de energia.
        <br><br><br>
        Anabolismo: Envolve reações químicas que constroem moléculas complexas a partir de partes menores. Por exemplo, durante o processo de digestão e absorção, os nutrientes são utilizados para construir proteínas, lipídios e outras moléculas essenciais para o funcionamento do corpo.
        <br><br><br>
        A taxa metabólica basal (TMB) é a quantidade mínima de energia que o corpo precisa para manter suas funções vitais, como respiração, circulação sanguínea, regulação da temperatura corporal e funcionamento dos órgãos internos, em repouso absoluto.
        <br><br><br>
        A TMB é influenciada por fatores como idade, sexo, massa muscular, e até mesmo genética.
        <br><br><br>
        Pessoas com mais massa muscular geralmente têm uma TMB mais alta porque músculos queimam mais calorias em repouso do que gordura.
        <br><br><br>
        Agora, quando se fala em "metabolismo rápido" ou "metabolismo lento", isso geralmente se refere à TMB. Pessoas com um metabolismo rápido queimam calorias mais rapidamente, enquanto aquelas com um metabolismo mais lento queimam mais devagar.
        <br><br><br>
        É importante lembrar que alimentação saudável e exercício são fundamentais para manter um metabolismo eficiente e uma vida saudável.
    </h6>
</section>
<hr>
<section id="percentual-gordura" class="container my-5 text-center">
    <h2>Percentual de Gordura</h2>
    <p>A taxa de gordura saudável em um homem é X% e em uma mulher é Y%.</p>
</section>
<hr>
<section id="dicas" class="container my-5 text-center">
    <h2>Dicas para Manter um Metabolismo Saudável</h2>

    <p>Dica 1:...</p>
    <p>Dica 2:...</p>
    <!-- Adicione mais dicas conforme necessário -->

    <a class="text-danger" href="?ct=main&mt=calculos_forms"><h5>faça já seus calculos de BF</h5></a>
</section>