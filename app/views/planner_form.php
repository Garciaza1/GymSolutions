<div class="container my-4">
    <h1 class="text-center">Formulário de Exercícios</h1>

    <form action="" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tarefas Semanais</div>
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
                                        <td><input type="text" name="domingo[]" class="form-control"></td>
                                        <td><input type="text" name="segunda[]" class="form-control"></td>
                                        <td><input type="text" name="terca[]" class="form-control"></td>
                                        <td><input type="text" name="quarta[]" class="form-control"></td>
                                        <td><input type="text" name="quinta[]" class="form-control"></td>
                                        <td><input type="text" name="sexta[]" class="form-control"></td>
                                        <td><input type="text" name="sabado[]" class="form-control"></td>
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
                        <textarea name="anotacoes" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>

        acertar a porra do botao
        <div class="row mt-3 justify-content-end">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>

    </form>
</div>