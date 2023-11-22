<?php

namespace GymSolution\Controllers;

use GymSolution\Controllers\BaseController;
use GymSolution\Controllers\Main;
use GymSolution\Models\UserModel;
use GymSolution\Models\Main as ModelsMain;
use GymSolution\System\SendEmail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class reset extends BaseController
{

    public function pass_reset()
    {
        $data = [];

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('recuperar_senha', $data);
        $this->view('shared/html_footer');
    }

    public function pass_recover_form()
    {
        $data = [];

        if (!empty($_SESSION['validation_errors'])) {
            $data['validation_errors'] = $_SESSION['validation_errors'];
            unset($_SESSION['validation_errors']);
        }

        // check if there was an invalid login
        if (!empty($_SESSION['server_error'])) {
            $data['server_error'] = $_SESSION['server_error'];
            unset($_SESSION['server_error']);
        }

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('recuperar_senha_form', $data);
        $this->view('shared/html_footer');
    }

    public function pass_recover_submit()
    {

        // Verifica se foi feita uma requisição POST
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->pass_recover_form();
            return;
        }

        // Inicializa o array de erros de validação
        $validation_errors = [];

        // Validação do campo de email
        if (empty($_POST['recupera_senha'])) {
            $validation_errors[] = 'O email é obrigatória.';
        }

        $email = $_POST['recupera_senha'];

        // check if email is valid 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validation_errors[] = 'O email tem que ser válido.';
        }

        // Se houver erros de validação, redireciona de volta ao formulário com os erros
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->pass_recover_form();
            return;
        }


        $model = new ModelsMain();

        $token = bin2hex(random_bytes(3));

        $model->recover_password($email, $token);

        $_SESSION['recover_token'] = $token;
        $data['code'] = $token; // vai passar pro email

        // aqui fica o model do Email com codigo e email.
        $mail = new SendEmail();
        $results = $mail->send_email(
            APP_NAME . ' Código para recuperar a password',

            'codigo_recuperar_password'/*nome da função privada de recuperar a senha*/,

            ['to' => $email, 'code' => $data['code']]
        );

        if ($results['status'] == 'error') {
            $_SESSION['validation_error'] = "Aconteceu um erro inesperado. Por favor tente novamente." . $results["message"];
            $this->pass_recover_form();
            return;
        }

        $this->pass_recover_email($token, $email); // joga pra view
        return;
    }

    public function pass_recover_email($token, $email)
    {
        $data = [];


        
        $data["token"] = $token;
        $data["email"] = $email;

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('recuperar_senha_form_2', $data);
        $this->view('shared/html_footer');
    }
}
