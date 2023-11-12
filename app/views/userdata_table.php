<?php

?>

<div class="container mt-5" >
    <h1>Tabela de Dados</h1>
    <?php if (empty($data['user_data'])): ?>
        <br>
        <h3>Não tem dados na tabela. Preencha agora mesmo -> <a href="?ct=main&mt=novas_medidas">Aqui!</a></h3>
        <button class="button btn-secondary" type="button"><a href="?ct=main&mt=index ">voltar</a></button>
    <?php else: ?>
        <div class="table-container border border-3 border-dark rounded-2 p-2" style="height: 90vh;">
            <table class="table table-bordered table-dark table-striped mx-auto my-3" id="myTable" style="width: 90%;">
                <thead style="color: white;">
                <tr>
                    <th>Excluir</th>
                    <th>Editar</th>
                    <th hidden>Id</th>
                    <th>Peso</th>
                    <th>Altura</th>
                    <th>Basal</th>
                    <th>Gordura</th>
                    <th>Cintura</th>
                    <th>Pescoco</th>
                    <th>Braco</th>
                    <th>Antebraco</th>
                    <th>Quadril</th>
                    <th>Cintura Escapular</th>
                    <th>Perna</th>
                    <th>Panturrilha</th>
                    <th>CreatedAt</th>
                    <th>UpdatedAt</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Substitua $data pelos seus dados vindos do banco de dados
                foreach ($data['user_data'] as $row) : ?>
                    <tr>
                        <td class="text-center pt-3"><a href="?ct=main&mt=medidas_delete&id=<?=$row['id']?>"><i class="fas fa-solid fa-trash"></i></a></td>
                        <td class="text-center pt-3"><a href="?ct=main&mt=medidas_edit&id=<?=$row['id']?>"><i class="fas fa-solid fa-pen-to-square"></i></a></td>
                        <td hidden><?=$row['id'] ?></td>
                        <td><?=$row['Peso'] ?></td>
                        <td><?=$row['Altura'] ?></td>
                        <td><?=$row['Basal'] ?> Calorias</td>
                        <td><?=$row['gordura'] ?> %</td>
                        <td><?=$row['Cintura'] ?></td>
                        <td><?=$row['Pescoco'] ?></td>
                        <td><?=$row['Braco'] ?></td>
                        <td><?=$row['Antebraco'] ?></td>
                        <td><?=$row['Quadril'] ?></td>
                        <td><?=$row['CinturaEscapular'] ?></td>
                        <td><?=$row['Perna'] ?></td>
                        <td><?=$row['Panturrilha'] ?></td>
                        <td><?=$row['CreatedAt'] ?></td>
                        <td><?=$row['UpdatedAt'] ?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<div>
    <a>coloque mais infirmações aqui</a>
</div>

<script>

$(document).ready(function() {
    new DataTable('#myTable',{
        order: [[12, 'desc']]
    });
});


    
</script>