<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6 col-sm-8 col-10">
            <div class="card p-4">

                <div class="d-flex align-items-center justify-content-center my-4">
                    <img src="<?= IMAGE_PATH . 'KEVIN-1_vetor2.png'?>" class="img-fluid me-3" style="height: 46px;">
                    <h2><strong><?= APP_NAME ?></strong></h2>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <form action="?ct=main&mt=login_submit" method="post" novalidate>
                            <div class="mb-3">
                                <label for="text_email" class="form-label">Email</label>
                                <input type="email" name="text_email" id="text_email" value="" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="text_password" class="form-label">Password</label>
                                <input type="password" name="text_password" id="text_password" class="form-control" required>
                            </div>
                            <div class="mb-3 text-center pt-2">
                                <button type="submit" class="btn btn-secondary px-4">Entrar<i class="fa-solid fa-right-to-bracket ms-2"></i></button>
                            </div>
                            <div class="mb-3 text-center pt-2">
                                <a class="btn btn-secondary px-4" href="?ct=main&mt=home" style="text-decoration: none; color: white;">Voltar<i class="fa-solid fa-igloo  ms-2"></i></a>
                            </div>

                            <div class="mb-3 text-center pt-2">
                                <a href="?ct=main&mt=cadastro">Não Tenho Cadastro</a>
                                <hr>
                                <div class="pt-2">
                                    <a href="?ct=main&mt=#">Esqueci-me da senha!</a>
                                </div>
                            </div>

                            <?php if(!empty($validation_errors)): ?>
                                <div class="alert alert-danger p-2 text-center">
                                    <?php foreach($validation_errors as $error): ?>
                                        <div><?= $error ?></div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php if(!empty($server_error)): ?>
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