<?php
if ($_SESSION) {

    $_SESSION['user'] = $data['user'];


    $idade = $data['user']['idade'];
    $user_sex = $data['user']['sexo'];
    $user_id = $data['user']['id'];
}
?>

<div class="container-fluid mt-5 mb-5">
    <div class="row justify-content-center pb-5">
        <div class="col-lg-8 col-md-10">
            <div class="card p-4">

                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="col-12 text-center">
                            <!-- <h2><strong><?= APP_NAME ?></strong></h2> -->
                            <img src="<?= IMAGE_PATH . 'KEVIN-1_vetor2.png' ?>" class="img-fluid me-3" style="height: 46px;">
                            <h2 class="text-center p-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><strong>SUAS MEDIDAS</strong></h2>
                            <hr>
                            <h3 class="text-center p-4 text-danger" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">TODA A CIRCUNFERÊNCIA</h3>
                        </div>


                        <form action="?ct=main&mt=medidas_submit_2" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_altura" class="form-label">Altura (cm)</label>
                                        <input type="number" name="text_altura" id="text_altura" placeholder="180" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="text_peso" class="form-label">Peso (kg)</label>
                                        <input type="number" step="0.01" name="text_peso" id="text_peso" placeholder="80" class="form-control">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_cintura" class="form-label">Cintura (cm)</label>
                                        <input type="number" step="0.01" name="text_cintura" id="text_cintura" placeholder="76" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="text_quadril" class="form-label">Quadril (cm)</label>
                                        <input type="number" step="0.01" name="text_quadril" id="text_quadril" placeholder="90" class="form-control">
                                    </div>

                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_pescoco" class="form-label">Pescoço (cm)</label>
                                        <input type="number" step="0.01" name="text_pescoco" id="text_pescoco" placeholder="37" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="text_braco" class="form-label">Braço (cm)</label>
                                        <input type="number" step="0.01" name="text_braco" id="text_braco" placeholder="35" class="form-control">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_antebraco" class="form-label">Antebraco (cm)</label>
                                        <input type="number" step="0.01" name="text_antebraco" id="text_antebraco" placeholder="30" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="text_panturrilha" class="form-label">Panturrilha (cm)</label>
                                        <input type="number" step="0.01" name="text_panturrilha" id="text_panturrilha" placeholder="40" class="form-control">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_perna" class="form-label">Perna (cm)</label>
                                        <input type="number" step="0.01" name="text_perna" id="text_perna" placeholder="56" class="form-control" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="text_cinturaEscapular" class="form-label">Cintura Escapular / Ombros(ponta a ponta) (cm)</label>
                                        <input type="number" step="0.01" name="text_cinturaEscapular" id="text_cinturaEscapular" placeholder="48" class="form-control" >
                                        <h6 class="text-danger">Apenas a metade<br>Se for 96cm divida por 2, coloque 48cm !</h6>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Meta</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="text_meta" id="meta_emagrecer" value="Emagrecer">
                                            <label class="form-check-label" for="meta_emagrecer">Emagrecer</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="text_meta" id="meta_ganhar_massa" value="Ganhar Massa" checked>
                                            <label class="form-check-label" for="meta_ganhar_massa">Ganhar Massa</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="text_meta" id="meta_manter_saudavel" value="Manter Estável e Saudável">
                                            <label class="form-check-label" for="meta_manter_saudavel">Manter Estável e Saudável</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Já sabe o Basal ou body fat? -->
                                <section class="border border-secundary-subtle rounded-3 p-3 my-2 col-12">

                                    <h5 class="card-title pb-1">Já sabe o Basal ou body fat?</h5>

                                    <div class="mb-3">
                                        <label class="form-label">Caso não saiba:</label>
                                        <P class="text-danger">O caculo de body fat e metabolismo Basal é feito automaticamente <a href="?ct=main&mt=novas_medidas">Aqui.</a></P>
                                        <div class="col-6">
                                    <div class="mb-3">
                                        <label for="text_gordura" class="form-label">Gordura Corporal (%)</label>
                                        <input type="number" step="0.01" name="text_gordura" id="text_cinturaEscapular" value="<?= $gordura ?>" class="form-control" placeholder="13" >

                                    </div>

                                    <div class="mb-3">
                                        <label for="text_basal" class="form-label">Metabolismo Basal (Calorias)</label>
                                        <input type="number" step="0.01" name="text_basal" id="text_basal" value="<?= $basal ?>" class="form-control" placeholder="1750" >
                                    </div>
                                </div>
                                    </div>

                                </section>

                                <div class="mb-3 text-center">
                                    <a href="?ct=main&mt=index" class="btn btn-secondary"><i class="fa-solid fa-xmark me-2"></i>Cancelar</a>
                                    <button type="submit" class="btn btn-secondary"><i class="fa-regular fa-floppy-disk me-2"></i>Guardar</button>
                                </div>
                            </div>
                            <!-- tratamento de erros -->
                            <?php if (!empty($validation_errors)) : ?>
                                <div class="alert alert-danger p-2 text-center">
                                    <?php foreach ($validation_errors as $error) : ?>
                                        <div><?= $error ?></div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($server_error)) : ?>
                                <div class="alert alert-danger p-2 text-center">
                                    <div><?= $server_error ?></div>
                                </div>
                            <?php endif; ?>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>