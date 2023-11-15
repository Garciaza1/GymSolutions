<div class="container mt-5">
    <h1>Planejador Semanal</h1>
    <?php if (empty($data['user_planner'])) : ?>
        <br>
        <h3>Você não tem dados no Planner ainda. Preencha agora mesmo -> <a href="?ct=main&mt=planner_form">Aqui!</a></h3>
        <button class="button btn-secondary" type="button"><a href="?ct=main&mt=index ">voltar</a></button>
    <?php else : ?>

        <h1 class="text-center">Planejador Semanal</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Exercícios da Semana</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="px-5">Domingo</th>
                                    <th class="px-5">Segunda</th>
                                    <th class="px-5">Terça</th>
                                    <th class="px-5">Quarta</th>
                                    <th class="px-5">Quinta</th>
                                    <th class="px-5">Sexta</th>
                                    <th class="px-5">Sábado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i <= 10; $i++) : ?>
                                    <tr>
                                        <td><input readonly type="text" name="domingo[]" class="form-control"></td>
                                        <td><input readonly type="text" name="segunda[]" class="form-control"></td>
                                        <td><input readonly type="text" name="terca[]" class="form-control"></td>
                                        <td><input readonly type="text" name="quarta[]" class="form-control"></td>
                                        <td><input readonly type="text" name="quinta[]" class="form-control"></td>
                                        <td><input readonly type="text" name="sexta[]" class="form-control"></td>
                                        <td><input readonly type="text" name="sabado[]" class="form-control"></td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">Anotações</div>
                    <div class="card-body">
                        <textarea readonly name="anotacoes" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>