<style>
    body {
        background-color: #f8f9fa;
    }

    .form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
    }

    input[type="email"] {
        width: 50%;
        margin: 0 auto;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        background-color: #d9534f;
        color: #fff;
        border: 1px solid #d9534f;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #c9302c;
        border-color: #ac2925;
    }
</style>

<section class="container pt-5">

    <h3 class="text-center">Digite seu Email:</h3>

    <div class="container">
        <form class="form" action="?ct=reset&mt=pass_recover_submit" method="post">
            <div class="mb-3">
                <input type="" name="recupera_senha" id="email" class="form-control">
            </div>
            <button type="submit" class="btn btn-danger text-center me-2">Enviar</button>
            <button type="" class="btn btn-danger text-center me-2"><a class="text-white" href="?ct=main&mt=index">voltar</a></button>
        </form>
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
    </div>
</section>