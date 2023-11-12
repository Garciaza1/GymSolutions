<?php
$labels = [];
$pesos = [];
$basal = [];
$body_fat = [];

foreach ($data['user_data'] as $row) {

    $labels[] = explode(" ", $row['CreatedAt'])[0]; // Use a data como rótulo
    $pesos[] = $row['Peso']; // Use o peso como dado
    $basal[] = $row['Basal']; // Use o peso como dado
    $body_fat[] = $row['gordura']; // Use o peso como dado
}
?>

<div class="container mt-5">
    <h1>Estatísticas do Usuário</h1>
    <?php if (empty($data['user_data'])) : ?>
        <br>
        <h3 class="">
            Ainda não há dados para as estatísticas. Preencha agora mesmo -> <a href="?ct=main&mt=novas_medidas">Aqui!</a>
        </h3>
        <button type="button"><a href="?ct=main&mt=index ">voltar</a></button>

    <?php else : ?>

        <div class="row mt-5">
            <!-- pesos -->
            <h3 class="text-center">Peso</h3>
            <div class="row justify-content-center">
                <canvas id="lineChartP" width="250" height="100" class="col-lg-6"></canvas>
            </div>

            <div class=" my-3">
                <hr>
            </div>

            <!-- basal -->
            <h3 class="text-center">Basal</h3>
            <div class="row justify-content-center">
                <canvas id="lineChartB" width="250" height="100" class="col-lg-6"></canvas>
            </div>

            <div class=" my-3">
                <hr>
            </div>

            <!-- body_fat -->
            <h3 class="text-center">Body Fat<br>Gordura Corporal</h3>
            <div class="row justify-content-center">
                <canvas id="lineChartG" width="250" height="100" class="col-lg-6"></canvas>
            </div>

        </div>


</div>
<?php endif; ?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    //colocar o charts e as infos do banco IMPORTANTE

    /* ============================      PESO      ========================================== */
    var ctx = document.getElementById('lineChartP').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Peso',
                data: <?= json_encode($pesos) ?>,
                backgroundColor: 'rgba(0, 0, 0, 0)', // Cor da área abaixo da linha
                borderColor: 'blue', // Cor da linha
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false,
                    ticks: {
                        font: {
                            size: 15 // Tamanho da fonte
                        },
                        color: 'black'
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 15 // Tamanho da fonte
                        },
                        color: 'black'
                    }
                }
            }
        }
    });
    /* ============================      BASAL      ========================================== */

    var ctx = document.getElementById('lineChartB').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Basal',
                data: <?= json_encode($basal) ?>,
                backgroundColor: 'rgba(0, 0, 0, 0)', // Cor da área abaixo da linha
                borderColor: 'red', // Cor da linha
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false,
                    ticks: {
                        font: {
                            size: 15 // Tamanho da fonte
                        },
                        color: 'black'
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 15 // Tamanho da fonte
                        },
                        color: 'black'
                    }
                }
            }
        }
    });

    /* ============================      BODY_FAT      ========================================== */

    var ctx = document.getElementById('lineChartG').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Body fat',
                data: <?= json_encode($body_fat)?>,
                backgroundColor: 'rgba(0, 0, 0, 0)', // Cor da área abaixo da linha
                borderColor: 'green', // Cor da linha
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false,
                    ticks: {
                        font: {
                            size: 15 // Tamanho da fonte
                        },
                        color: 'black'
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 15 // Tamanho da fonte
                        },
                        color: 'black'
                    }
                }
            }
        }
    });
</script>