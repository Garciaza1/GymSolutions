<?php

$logado = false;

if ($_SESSION) {

    $logado = true;

    $_SESSION['user'] = $data['user'];

    $nome = $data['user']['nome'];
    $partesDoNome = explode(" ", $nome);
    $primeiro_nome = $partesDoNome[0];

    $email = $data['user']['email'];
    $idade = $data['user']['idade'];
    $user_id = $data['user']['id'];
}

?>

<div class="container-fluid bng-navbar">
    <div class="row">

        <div class="col-4 d-flex align-content-center p-3">
            <a href="?ct=main&mt=index"><img src="<?= IMAGE_PATH . 'KEVIN-1_vetor2.png' ?>" alt="logo GymSolution" height="46" class="me-3"></a>
            <a href="?ct=main&mt=index" style="text-decoration: none; color:black;">
                <h3><?= APP_NAME ?></h3>
            </a>
        </div>

        <div class="text-center col-4 pt-4">
            <?php if ($logado) : ?>
                <h2>Bem-vindo! <span class="" style=" font-style: italic;"><?= $primeiro_nome ?></span></h2>
            <?php endif; ?>
        </div>

        <?php if ($logado) : ?>
            <div class="col-4 text-end pe-4 pt-4">

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle pe-3" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 20%;">
                        <i class="fa-regular fa-user me-4"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?ct=main&mt=perfil"><i class="fa-solid fa-user me-2"></i>Alterar Perfil</i></a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="?ct=main&mt=change_password"><i class="fa-solid fa-key me-2"></i>Alterar Senha</i></a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="?ct=main&mt=logout"><i class="fa-solid fa-right-from-bracket me-2"></i>Sair</a></li>
                    </ul>
                </div>

            <?php else : ?>

                <div class="text-end col-4 mt-2 ">
                    <button class="btn btn-dark m-2" type="button">
                    <i class="fa-solid fa-medal me-2"></i></i>
                        <a href="?ct=main&mt=login" style="text-decoration: none; color: white;">Entrar</a>
                    </button>

                    <button class="btn btn-dark m-2" type="button">
                    <i class="fa-solid fa-person-skiing me-2"></i></i>
                        <a href="?ct=main&mt=cadastro" style="text-decoration: none; color: white;">Cadastrar</a>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        <hr>
    </div>
</div>