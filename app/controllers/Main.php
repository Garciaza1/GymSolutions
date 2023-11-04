<?php

namespace GymSolution\Controllers;

use GymSolution\Controllers\BaseController;
use GymSolution\Models\Main as ModelsMain;
use GymSolution\Models\UserModel;

class Main extends BaseController
{


    public function home()
    {

        $data = [];
        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('home_page');
        $this->view('shared/html_footer');
    }

    // =======================================================     
    public function acesso_negado()
    {

        $data = [];

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('acesso_negado', $data);
        $this->view('shared/html_footer');
    }

    // ======================================================= 
    public function index()
    {
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];



        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('home', $data);
        $this->view('shared/html_footer');
    }

    // ======================================================= 
    public function login()
    {
        // check if there is already a user in the session
        if (check_session()) {
            $this->index();
            return;
        }

        // check if there are errors (after login_submit)
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

        // display login form
        $this->view('shared/html_header');
        $this->view('login', $data);
        $this->view('shared/html_footer');
    }

    // ======================================================= 
    public function login_submit()
    {

        // check if there is already an active session
        if (check_session()) {
            $this->index();
            return;
        }

        // check if there was a post request
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // form validation
        $validation_errors = [];
        if (empty($_POST['text_email']) || empty($_POST['text_password'])) {
            $validation_errors[] = "Email e password são obrigatórios.";
        }

        // get form data
        $email = $_POST['text_email'];
        $password = $_POST['text_password'];

        // check if username is valid email and between 5 and 50 chars
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validation_errors[] = 'O email tem que ser válido.';
        }

        // check if username is between 5 and 50 chars
        if (strlen($email) < 5 || strlen($email) > 50) {
            $validation_errors[] = 'O email deve ter entre 5 e 50 caracteres.';
        }

        // check if password is valid
        if (strlen($password) < 6 || strlen($password) > 12) {
            $validation_errors[] = 'A password deve ter entre 6 e 12 caracteres.';
        }


        // check if there are validation errors
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->login();
            return;
        }

        $model = new ModelsMain();
        $result = $model->verificar_login($email, $password);

        //LOGIN VALIDO 
        if ($result['status']) {

            //load user information to the session
            $results = $model->get_user_data($email);
            // add user to session
            if (!empty($results)) {
                $_SESSION['user'] = $results[0]; // Armazena todos os resultados na sessão 'user'
            }
            // go to main page
            $this->index();
        }

        //login invalido
        else {

            $_SESSION['server_error'] = 'Login inválido.';
            $this->login();
            return;
        }
    }

    // ======================================================= 
    public function cadastro()
    {
        // check if there is already a user in the session
        if (check_session()) {
            $this->index();
            return;
        }
        // check if there are errors
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

        // display login form
        $this->view('shared/html_header', $data);
        $this->view('cadastro', $data);
        $this->view('shared/html_footer');
    }
    // ======================================================= 
    public function cadastro_submit()
    {

        if (check_session() || $_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // form validation
        $validation_errors = [];

        // text_name
        if (empty($_POST['text_name'])) {
            $validation_errors[] = "Nome é de preenchimento obrigatório.";
        } else {
            if (strlen($_POST['text_name']) < 3 || strlen($_POST['text_name']) > 50) {
                $validation_errors[] = "O nome deve ter entre 3 e 50 caracteres.";
            }
        }

        // gender
        if (empty($_POST['radio_gender'])) {
            $validation_errors[] = "É obrigatório definir o género.";
        }

        // idade
        if (empty($_POST['text_idade'])) {
            $validation_errors[] = "Idade é de preenchimento obrigatório.";
        }

        // senha
        if (empty($_POST['text_senha'])) {
            $validation_errors[] = "senha é de preenchimento obrigatório.";
        }

        // text_birthdate
        if (empty($_POST['text_birthdate'])) {
            $validation_errors[] = "Data de nascimento é obrigatória.";
        } else {
            // check if birthdate is valid and is older than today
            $birthdate = \DateTime::createFromFormat('d-m-Y', $_POST['text_birthdate']);
            if (!$birthdate) {
                //$validation_errors[] = "A data de nascimento não está no formato correto.";
            } else {
                $today = new \DateTime();
                if ($birthdate >= $today) {
                    $validation_errors[] = "A data de nascimento tem que ser anterior ao dia atual.";
                }
            }
        }

        // email
        if (empty($_POST['text_email'])) {
            $validation_errors[] = "Email é de preenchimento obrigatório.";
        } else {
            if (!filter_var($_POST['text_email'], FILTER_VALIDATE_EMAIL)) {
                $validation_errors[] = "Email não é válido.";
            }
        }

        // phone
        if (empty($_POST['text_phone'])) {
            $validation_errors[] = "Telefone é de preenchimento obrigatório.";
        } /*else {
            if(!preg_match("/^9{3}\d{8}$/", $_POST['text_phone'])){
                $validation_errors[] = "O telefone deve ter 9 no terceiro digito e ter 9 algarismos no total.";
            }
        }*/

        // check if there are validation errors to return to the form
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->cadastro();
            return;
        }

        // check if the client already exists with the same name
        $model = new ModelsMain();
        $results = $model->check_if_user_exists($_POST);

        if ($results['status']) {

            // a person with the same name exists for this agent. Returns a server error
            $_SESSION['server_error'] = "Já existe um cliente com este email.";
            $this->cadastro();
            return;
        } else {
            // add new client to the database
            $model->cadastrar_usuario($_POST);



            // return to the main clients page
            $this->login();
            return;
        }
    }

    // ======================================================= 
    public function logout()
    {

        $_SESSION['user'] = null;
        session_destroy();

        // go to main page
        $this->index();
        exit();
    }

    // ========================================= APP CONTROLLER AQUI =======================================

    // =============== CALCULOS CONTROLLER ===================
    public function calculos()
    {

        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

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

        $data['user'] = $_SESSION['user'];

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('calculos', $data);
        $this->view('shared/html_footer');
    }

    public function calculos_submit()
    {


        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->index();
            return;
        }

        // check if there are validation errors to return to the form
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->calculos();
            return;
        }
        echo "<pre>";
        print_r($_POST);


        $model = new UserModel();
        //$model->add_user_data($_POST);

        $this->userdata_table();
        return;
    }
    public function calculos_submitM()
    {


        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->index();
            return;
        }

        // check if there are validation errors to return to the form
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->calculos();
            return;
        }


        $model = new UserModel();
        $model->add_user_dataM($_POST);

        $this->userdata_table();
        return;
    }

    public function calculos_submitF()
    {


        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->index();
            return;
        }

        // check if there are validation errors to return to the form
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->calculos();
            return;
        }


        $model = new UserModel();
        $model->add_user_dataF($_POST);

        $this->userdata_table();
        return;
    }


    // =============== USER_DATA CONTROLLERS ===========================
    public function userdata_table()
    {
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];
        $id = $_SESSION['user']['id'];

        $model = new UserModel();
        $model->get_user_data($id);


        //erro aqui
        $data['user_data'] = $_SESSION['user_data'];

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('userdata_table', $data);
        $this->view('shared/html_footer');
    }


    // =============== PLANNER CONTROLLERS ===========================
    public function planner()
    {

        $data = $_SESSION['user'];

        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];
        $id = $_SESSION['user']['id'];

        $model = new UserModel();
        $model->get_user_data($id);


        //erro aqui
        $data['user_data'] = $_SESSION['user_data'];

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('planner', $data);
        $this->view('shared/html_footer');
    }

    public function planner_form()
    {

        $data = $_SESSION['user'];

        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];
        $id = $_SESSION['user']['id'];

        $model = new UserModel();
        $model->get_user_data($id);


        //erro aqui
        $data['user_data'] = $_SESSION['user_data'];

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('planner_form', $data);
        $this->view('shared/html_footer');
    }

    public function planner_submit()
    {

        $data = $_SESSION['user'];
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }


    }
}
