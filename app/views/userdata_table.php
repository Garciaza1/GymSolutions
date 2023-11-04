<?php
$data = $_SESSION["user_data"];
?>

<div class="container mt-5">
    <h1>Tabela de Dados</h1>
    <?php if (empty($data[0])): ?>
        <br>
        <h3>Não tem dados na tabela. Preencha agora mesmo -> <a href="##">form de dados</a></h3>
        <button class="button btn-secondary" type="button"><a href="?ct=main&mt=index ">voltar</a></button>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>UserId</th>
                    <th>Meta</th>
                    <th>Peso</th>
                    <th>Altura</th>
                    <th>Basal</th>
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
                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>{$row['UserId']}</td>";
                    echo "<td>{$row['Meta']}</td>";
                    echo "<td>{$row['Peso']}</td>";
                    echo "<td>{$row['Altura']}</td>";
                    echo "<td>{$row['Basal']}</td>";
                    echo "<td>{$row['Cintura']}</td>";
                    echo "<td>{$row['Pescoco']}</td>";
                    echo "<td>{$row['Braco']}</td>";
                    echo "<td>{$row['Antebraco']}</td>";
                    echo "<td>{$row['Quadril']}</td>";
                    echo "<td>{$row['CinturaEscapular']}</td>";
                    echo "<td>{$row['Perna']}</td>";
                    echo "<td>{$row['Panturrilha']}</td>";
                    echo "<td>{$row['CreatedAt']}</td>";
                    echo "<td>{$row['UpdatedAt']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
