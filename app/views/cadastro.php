<div class="container-fluid mt-5 mb-5">
    <div class="row justify-content-center pb-5">
        <div class="col-lg-8 col-md-10">
            <div class="card p-4">

                <div class="row justify-content-center">
                    <div class="col-10">
                    <div class="col-12 text-center">
                        <img src="<?= IMAGE_PATH . 'KEVIN-1_vetor2.png'?>" class="img-fluid me-3" style="height: 46px;">
                        <h2><strong><?= APP_NAME ?></strong></h2>
                    </div>
                    <hr>

                    <h2 class="text-center p-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><strong>CADASTRO</strong></h2>

                        <form action="?ct=main&mt=cadastro_submit" method="post" >

                            <div class="mb-3">
                                <label for="text_name" class="form-label">Nome</label>
                                <input type="text" name="text_name" id="text_name" value="" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="text_email" class="form-label">Email</label>
                                <input type="email" name="text_email" id="text_email" value="" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="text_senha" class="form-label">Senha</label>
                                <input type="password" name="text_senha" id="text_senha" value="" class="form-control" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <div>Sexo</div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radio_gender" id="radio_m" value="m" checked>
                                        <label class="form-check-label" for="radio_m">Masculino</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radio_gender" id="radio_f" value="f">
                                        <label class="form-check-label" for="radio_f">Feminino</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radio_gender" id="radio_o" value="o">
                                        <label class="form-check-label" for="radio_o">Outro</label>
                                    </div>
                                </div>


                                <div class="col-md-6 col-sm-12">
                                    <label for="text_birthdate" class="form-label">Data de nascimento</label>
                                    <input type="date" class="form-control" name="text_birthdate" id="text_birthdate" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="text_phone" class="form-label">Telefone</label>
                                    <input type="text" class="form-control" name="text_phone" id="text_phone" required>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="text_idade" class="form-label">Idade</label>
                                    <input type="number" name="text_idade" id="text_idade" value="" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3 text-center">
                                <a href="?ct=main&mt=home" class="btn btn-secondary"><i class="fa-solid fa-xmark me-2"></i>Cancelar</a>
                                <button type="submit" class="btn btn-secondary"><i class="fa-regular fa-floppy-disk me-2"></i>Guardar</button>
                            </div>

                            <?php if (isset($validation_errors)) : ?>
                                <div class="alert alert-danger p-2">
                                    <ul>
                                        <?php foreach ($validation_errors as $error) : ?>
                                            <li><?= $error ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($server_error)) : ?>
                                <div class="alert alert-danger p-2 text-center">
                                    <?= $server_error ?>
                                </div>
                            <?php endif; ?>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    flatpickr("#text_birthdate", {
        dateFormat: "d-m-Y"
    })
</script>