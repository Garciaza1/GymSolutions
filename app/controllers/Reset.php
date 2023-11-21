<?php

namespace GymSolution\Controllers;

use GymSolution\Controllers\BaseController;
use GymSolution\Controllers\Main;
use GymSolution\Models\UserModel;
use GymSolution\Models\Main as ModelsMain;
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

        // check if username is valid email and between 5 and 50 chars
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validation_errors[] = 'O email tem que ser válido.';
        }

        $token = bin2hex(random_bytes(32));
        $_SESSION['recover_token'] = $token;

        $model = new ModelsMain();
        $model->recover_password($email, $token);

        //tenta criar email COLOCAR NUMA CLASSE SEPARADA
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'gymsolutionoperation@gmail.com';                     //SMTP username
            $mail->Password   = 'Gr28011922';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('gymsolutionoperation@gmail.com', 'Mailer');
            $mail->addAddress('gustavogarcia56336@gmail.com', 'Joe User');     //Add a recipient
            $mail->addAddress($email, 'usuario:');     //Add a recipient
            $mail->addReplyTo('gymsolutionoperation@gmail.com', 'Information');

            // //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Gym Solution password recover';

            $body = '<!DOCTYPE html>

                <html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Recuperação de Senha</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f4;
                            margin: 0;
                            padding: 0;
                        }
                
                        .container {
                            max-width: 600px;
                            margin: 20px auto;
                            background-color: #fff;
                            padding: 20px;
                            border-radius: 5px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }
                
                        h1 {
                            color: #333;
                        }
                
                        p {
                            color: #555;
                        }
                
                        .token {
                            background-color: #eee;
                            padding: 10px;
                            border-radius: 5px;
                            font-size: 18px;
                            margin-top: 20px;
                        }
                    </style>
                </head>
                <body>
                
                <div class="container">
                    <h1>Recuperação de Senha</h1>
                    <p>Olá,</p>
                    <p>Você solicitou a recuperação de senha. Use o seguinte token para redefinir sua senha:</p>
                    <div class="token">
                        <!-- Inserir o token gerado dinamicamente aqui -->
                        <strong>'. $token .'</strong>
                    </div>
                    <p>Este token é válido por um curto período de tempo. Não compartilhe com mais ninguém.</p>
                    <p>Se você não solicitou essa recuperação de senha, ignore este e-mail.</p>
                    <p>Atenciosamente,<br>Equipe de Suporte</p>
                </div>
                
                </body>
                </html>';


            $mail->Body = $body;
            $mail->AltBody = 'AQUI ESTÁ O TOKEN DE RECUPERAÇÃO DE SENHA: '. $token;

            $mail->send();

            if (empty($_POST['recupera_senha'])) {
                $server_error[] = "Message has been sent!";
            }
        } catch (Exception $e) {
            // Validação do campo de email
            if (empty($_POST['recupera_senha'])) {
                $server_error[] = "Message could not be sent. Mailer Error:{$mail->ErrorInfo}";
            }
        }

        $this->pass_recover_email($token, $email);
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
