<?php
namespace GymSolution\Models;
use GymSolution\System\Database;

use PDO;
use Throwable;

class Main extends Database
{
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function cadastrar_usuario( $post_data) {
        $nome = $post_data['text_name'];
        $email = $post_data['text_email'];
        $senha = $post_data['text_senha'];
        $telefone = $post_data['text_phone'];
        $idade = $post_data['text_idade'];
        $sexo = $post_data['radio_gender'];
        $nascimento = $post_data['text_birthdate'];
        
        

        
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, email, senha, telefone, idade, sexo, nascimento) VALUES (:nome, :email, aes_encrypt(:senha, :aes_cript), :telefone, :idade, :sexo, :nascimento)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':nascimento', $nascimento);
        $stmt->bindParam(':aes_cript', aes_cript);
        
        try{
            $stmt->execute();
        }catch(Throwable $e){
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }

    public function verificar_login($email, $senha) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);


        try{
            $stmt->execute();
        }catch(Throwable $e){
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            //se stiver mais de zero rows ele da status true
            return [
                'status' => true
            ];
            } else {
                
                return [
                    'status' => false
                ];
            }
        }
        
        public function get_user_data($email) {

        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        $data = [$usuario];
        
        return $data;
    }

    public function check_if_user_exists($post_data){

        $user_email = $post_data['text_email'];

        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $user_email);

        $stmt->execute();

        $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0){//se stiver mais de zero rows ele da status true
            return [
                'status' => true
            ];
        } else {
            return [
                'status' => false
            ];
        }  
    }


    public function set_token($email, $token){

        

        $stmt = $this->conn->prepare("UPDATE usuarios SET token_rec_pass = :token WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);

        try{
            $stmt->execute();
        }catch(Throwable $e){
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }

    }



    // UPDATES

    public function change_name($post_data) {
        $nome = $post_data['text_mudar_nome'];
        $id = $_SESSION['user']['id'];
    
        $stmt = $this->conn->prepare("UPDATE usuarios SET  nome = :nome UpdatedAt = NOW() WHERE id = :id");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id', $id);
        ;

        try{
            $stmt->execute();
        }catch(Throwable $e){
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }
    
    public function change_email($post_data) {
        $email = $post_data['text_email_novo'];
        $id = $_SESSION['user']['id'];
        
        $stmt = $this->conn->prepare("UPDATE usuarios SET  email = :email UpdatedAt = NOW() WHERE id = :id");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        ;

        try{
            $stmt->execute();
        }catch(Throwable $e){
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }

    public function change_senha($post_data) {
        $senha = $post_data['text_senha_nova'];
        $id = $_SESSION['user']['id'];
    
        // $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        
        $stmt = $this->conn->prepare("UPDATE usuarios SET  senha = :senha UpdatedAt = NOW() WHERE id = :id");
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':id', $id);
        ;

        try{
            $stmt->execute();
        }catch(Throwable $e){
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }
    
    public function change_data($post_data) {
        
        $nascimento = $post_data['mudar_data'];
        $id = $_SESSION['user']['id'];
        
        $stmt = $this->conn->prepare("UPDATE usuarios SET  nascimento = :nascimento UpdatedAt = NOW() WHERE id = :id");
        $stmt->bindParam(':nascimento', $nascimento);
        $stmt->bindParam(':id', $id);
        ;

        try{
            $stmt->execute();
        }catch(Throwable $e){
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }

    public function change_tel($post_data) {
        $telefone = $post_data['text_mudar_telefone'];
        $id = $_SESSION['user']['id'];
        
        $stmt = $this->conn->prepare("UPDATE usuarios SET  telefone = :telefone UpdatedAt = NOW() WHERE id = :id");
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':id', $id);
        ;

        try{
            $stmt->execute();
        }catch(Throwable $e){
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }
    
    public function change_sex($post_data) {
        $sexo = $post_data['update_genero'];
        $id = $_SESSION['user']['id'];
        
        $stmt = $this->conn->prepare("UPDATE usuarios SET  sexo = :sexo UpdatedAt = NOW() WHERE id = :id");
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':id', $id);
        ;

        try{
            $stmt->execute();
        }catch(Throwable $e){
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }

}