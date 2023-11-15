<?php

namespace GymSolution\Controllers;

use GymSolution\Controllers\BaseController;
use GymSolution\Models\Main as ModelsMain;
use GymSolution\Models\UserModel;

class Main extends BaseController
{

    public function home() //PUBLICO
    {

        // check if there is no active user in session and blocks if hasn't
        if (check_session()) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }



        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('home_page');
        $this->view('shared/html_footer');
    }

    // =======================================================     
    public function acesso_negado()
    {

        if (isset($_SESSION['erro'])) $data['erro'] = $_SESSION['erro'];
        $data['request'] = $_REQUEST;
        $data['session'] = $_SESSION;
        $data['cookie'] = $_COOKIE;
        $data['get'] = $_GET;

        $this->view('shared/html_header');
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

            if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

                // add new client to the database
                $model->cadastrar_usuario($_POST);

                // return to the main clients page
                $this->login();
                return;
            } else {

                // a person with the same name exists for this agent. Returns a server error
                $_SESSION['server_error'] = "O token não foi validado prencha novamente";
                $this->cadastro();
                return;
            }
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





    // =============== PERFIL CONTROLLER ===================

    public function perfil()
    {
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
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

        $data['user'] = $_SESSION['user'];
        $id = $_SESSION['user']['id'];

        $model = new UserModel();
        $data['user_data'] = $model->get_last_user_data($id);

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('perfil', $data);
        $this->view('shared/html_footer');
    }

    public function perfil_submit()
    {
        // check if there is already an active session
        if (!check_session()) {
            $this->index();
            return;
        }

        // check if there was a post request
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->perfil();
            return;
        }

        //UPDATE DO NOME =============
        if (isset($_POST['update_name'])) {

            if (empty($_POST['text_mudar_nome'])) {
                $validation_errors[] = "o nome precisa ser preenchido";
            }
            $nome = $_POST['text_mudar_nome'];

            if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

                $model = new ModelsMain();
                $model->change_name($nome);

                $this->perfil();
                return;
            } else {
                $_SESSION['server_error'] = "O token não foi validado prencha novamente";
                $this->perfil();
                return;
            }
        }

        //UPDATE DO SENHA =============
        // trocar de método para pagina so de senha
        if (isset($_POST['update_senha'])) {

            // get form data
            $senha_atual = $_POST['text_senha_atual'];
            if (!password_verify($_SESSION['user']['senha'], $senha_atual)) {
                $validation_errors[] = 'A password antiga não confere.';
            }


            $password = $_POST['text_senha_nova'];
            // check if password is valid
            if (strlen($password) < 6 || strlen($password) > 12) {
                $validation_errors[] = 'A password deve ter entre 6 e 12 caracteres.';
            }

            if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

                $model = new ModelsMain();
                $model->change_name($password);

                $this->perfil();
                return;
            } else {

                $_SESSION['server_error'] = "O token não foi validado prencha novamente";
                $this->perfil();
                return;
            }

        }

        // VALIDAÇÃO DO EMAIL =========
        if (isset($_POST['update_email'])) {


            // get form data
            $email = $_POST['text_email'];
            // check if username is valid email and between 5 and 50 chars
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validation_errors[] = 'O email tem que ser válido.';
            }

            // check if username is between 5 and 50 chars
            if (strlen($email) < 5 || strlen($email) > 50) {
                $validation_errors[] = 'O email deve ter entre 5 e 50 caracteres.';
            }

            // check if there are validation errors
            if (!empty($validation_errors)) {
                $_SESSION['validation_errors'] = $validation_errors;
                $this->perfil();
                return;
            }

            if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

                $model = new ModelsMain();
                $model->change_name($email);

                $this->perfil();
                return;
            } else {
                
                $_SESSION['server_error'] = "O token não foi validado prencha novamente";
                $this->perfil();
                return;
            }
        }

        //UPDATE DO DATA =============
        if (isset($_POST['update_data'])) {

            if (empty($_POST['mudar_data'])) {
                $_SESSION['validation_errors'] = "a data precisa ser preenchida";
            }

            // check if birthdate is valid and is older than today
            $birthdate = \DateTime::createFromFormat('d-m-Y', $_POST['text_birthdate']);
            if (!$birthdate) {
                $validation_errors[] = "A data de nascimento não está no formato correto.";
            } else {
                $today = new \DateTime();
                if ($birthdate >= $today) {
                    $validation_errors[] = "A data de nascimento tem que ser anterior ao dia atual.";
                }
            }

            $nascimento = $_POST['mudar_data'];

            if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

                $model = new ModelsMain();
                $model->change_name($nascimento);

                $this->perfil();
                return;
            } else {
                
                $_SESSION['server_error'] = "O token não foi validado prencha novamente";
                $this->perfil();
                return;
            }
        }

        //UPDATE DO TELEFONE =============
        if (isset($_POST['update_telefone'])) {

            if (empty($_POST['text_mudar_telefone'])) {
                $_SESSION['validation_errors'] = "o telefone precisa ser preenchido";
            }
            $telefone = $_POST['text_mudar_telefone'];

            if (preg_match('/^(\d{2})(\d{5})(\d{4})$/', $telefone, $matches)) {
                $telefone_formatado = "({$matches[1]}) {$matches[2]}-{$matches[3]}";
                echo $telefone_formatado;
            }

            if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

                $model = new ModelsMain();
                $model->change_name($telefone_formatado);

                $this->perfil();
                return;
            } else {
                
                $_SESSION['server_error'] = "O token não foi validado prencha novamente";
                $this->perfil();
                return;
            }
        }

        //UPDATE DO SEXO =============
        if (isset($_POST['update_genero'])) {

            if (empty($_POST['radio_gender'])) {
                $_SESSION['validation_errors'] = "o genero precisa ser preenchido";
            }

            $sexo = $_POST['radio_gender'];

            if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

                $model = new ModelsMain();
                $model->change_name($sexo);

                $this->perfil();
                return;
            } else {
                
                $_SESSION['server_error'] = "O token não foi validado prencha novamente";
                $this->perfil();
                return;
            }
        }
    }


    public function user_profile()
    {
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];
        $id = $_SESSION['user']['id'];

        $model = new UserModel();
        $data['user_data'] = $model->get_last_user_data($id);

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('user_profile', $data);
        $this->view('shared/html_footer');
    }

    // =============== CALCULOS CONTROLLER ===========================

    public function calculos() //pagina sobre a saúde e metabolismo PUBLICO
    {

        if ($_SESSION['user']) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }

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

    public function calculos_forms() // identifica por sexo em js PUBLICO
    {

        if ($_SESSION['user']) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('calculos_forms', $data);
        $this->view('shared/html_footer');
    }

    public function novas_medidas() //aponta para o calculo_submit
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
        $this->view('novas_medidas', $data);
        $this->view('shared/html_footer');
    }

    public function medidas_submit() //recebe de novas_medidas
    {


        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->index();
            return;
        }


        // Verifica se foi feita uma requisição POST
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // Inicializa o array de erros de validação
        $validation_errors = [];

        //valida todos os campos tendo que preenchelos.
        $campos = ['altura', 'peso', 'cintura', 'quadril', 'pescoco', 'braco', 'antebraco', 'panturrilha', 'perna', 'cinturaEscapular'];
        foreach ($campos as $campo) {
            // Verifica se o campo está vazio
            if (empty($_POST['text_' . $campo])) {
                $validation_errors[] = ucfirst($campo) . ' é obrigatório.';
            }
        }

        // Validação do campo de meta
        if (empty($_POST['text_meta'])) {
            $validation_errors[] = 'A meta é obrigatória.';
        }


        // Se houver erros de validação, redireciona de volta ao formulário com os erros
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->novas_medidas(); // ou o nome da função que exibe o formulário
            return;
        }

        // reformatação dos campos....
        $_POST['text_braco'];
        $_POST['text_antebraco'];
        $_POST['text_panturrilha'];
        $_POST['text_perna'];
        $_POST['text_cinturaEscapular'];
        $_POST['text_meta'];

        $sexo = $_SESSION['user']['sexo'];
        $idade = $_SESSION['user']['idade'];

        $altura = $_POST['text_altura'];
        $peso = $_POST['text_peso'];
        $cintura = $_POST['text_cintura'];
        $quadril = $_POST['text_quadril'];
        $pescoco = $_POST['text_pescoco'];

        // os calculos ficarão aqui e serão colocados na tebela

        // Cálculo do Percentual de Gordura (%)
        if ($sexo == 'm') {
            $gorduram = 86.010 * log10($cintura - $pescoco) - 70.041 * log10($altura) + 36.76;
            $gordura = $gorduram;
        } else {
            $gorduraf = 163.205 * log10($cintura + $quadril - $pescoco) - 97.684 * log10($altura) - 78.387;
            $gordura = $gorduraf;
        }


        // Cálculo do Metabolismo Basal
        if ($sexo == 'm') {
            $basal = 88.362 + (13.397 * $peso) + (4.799 * $altura) - (5.677 * $idade);
        } else {
            $basal = 447.593 + (9.247 * $peso) + (3.098 * $altura) - (4.330 * $idade);
        }


        $post_data = array(
            'braco' => $_POST['text_braco'],
            'antebraco' => $_POST['text_antebraco'],
            'panturrilha' => $_POST['text_panturrilha'],
            'perna' => $_POST['text_perna'],
            'cinturaEscapular' => $_POST['text_cinturaEscapular'],
            'meta' => $_POST['text_meta']
        );
        $post_data['sexo'] = $sexo;
        $post_data['idade'] = $idade;
        $post_data['altura'] = $altura;
        $post_data['peso'] = $peso;
        $post_data['cintura'] = $cintura;
        $post_data['quadril'] = $quadril;
        $post_data['pescoco'] = $pescoco;
        $post_data['basal'] = $basal;
        $post_data['gordura'] = $gordura;


        $model = new UserModel();
        $model->add_user_data($post_data);

        $this->user_profile();
        return;
    }


    // =============== USER_DATA CONTROLLERS ==============================

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
        $data['user_data'] = $model->get_user_data($id);

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('userdata_table', $data);
        $this->view('shared/html_footer');
    }

    public function medidas_delete($item_id)
    {

        // Verifique se o ID foi passado
        if (!isset($_GET['id'])) {
            $_SESSION['erro'] = "Erro no Id passado!";
            $this->index();
            return;
        }

        $item_id = $_GET['id'];


        $model = new UserModel();
        $model->soft_delete($item_id);

        $this->userdata_table();
        return;
    }


    public function medidas_edit($item_id)
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
        $id = $_SESSION['user']['id'];

        $model = new UserModel();
        $data['user_data'] = $model->get_user_data($id);

        // Verifique se o ID foi passado
        if (!isset($_GET['id'])) {
            $_SESSION['erro'] = "Erro no Id passado!";
            $this->index();
            return;
        }

        $item_id = $_GET['id'];

        $model = new UserModel();
        $data['user_data_id'] = $model->get_1_data_user($item_id);



        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('medidas_edit', $data);
        $this->view('shared/html_footer');
    }

    public function medidas_edit_submit($id)
    {

        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->index();
            return;
        }


        // Verifica se foi feita uma requisição POST
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // Inicializa o array de erros de validação
        $validation_errors = [];

        //valida todos os campos tendo que preenchelos.
        $campos = ['altura', 'peso', 'cintura', 'quadril', 'pescoco', 'braco', 'antebraco', 'panturrilha', 'perna', 'cinturaEscapular'];
        foreach ($campos as $campo) {
            // Verifica se o campo está vazio
            if (empty($_POST['text_' . $campo])) {
                $validation_errors[] = ucfirst($campo) . ' é obrigatório.';
            }
        }

        // Validação do campo de meta
        if (empty($_POST['text_meta'])) {
            $validation_errors[] = 'A meta é obrigatória.';
        }


        // Se houver erros de validação, redireciona de volta ao formulário com os erros
        if (!empty($validation_errors)) {
            $_SESSION['validation_errors'] = $validation_errors;
            $this->medidas_edit($id);
            return;
        }


        $model = new UserModel();
        $model->data_user_edit($_POST, $id);

        $this->userdata_table();
        return;
    }


    public function user_data()
    {
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];
        $id = $_SESSION['user']['id'];

        $model = new UserModel();
        $data['user_data'] = $model->get_user_data($id);

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('userdata_table', $data);
        $this->view('shared/html_footer');
    }



    // =============== ESTATISTICAS CONTROLLER  ===========================

    public function estatisticas()
    {

        $data['user'] = $_SESSION['user'];
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];
        $id = $_SESSION['user']['id'];

        $model = new UserModel();
        $data['user_data'] = $model->get_user_data($id);

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('estatisticas', $data);
        $this->view('shared/html_footer');
    }



    // =============== PLANNER CONTROLLERS ===========================

    public function planner()
    {


        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];
        $id = $_SESSION['user']['id'];

        $model = new UserModel();
        $data['user_data'] = $model->get_user_data($id);

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('planner', $data);
        $this->view('shared/html_footer');
    }

    public function planner_form()
    {

        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }

        $data['user'] = $_SESSION['user'];
        $id = $_SESSION['user']['id'];

        $model = new UserModel();
        $data['user_data'] = $model->get_user_data($id);

        $this->view('shared/html_header');
        $this->view('navbar', $data);
        $this->view('planner_form', $data);
        $this->view('shared/html_footer');
    }

    public function planner_submit()
    {

        $data['user'] = $_SESSION['user'];
        // check if there is no active user in session and blocks if hasn't
        if (!check_session()) {
            $this->login();
            return;
        }
    }
}
