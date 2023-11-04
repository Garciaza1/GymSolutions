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
        
        
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, email, senha, telefone, idade, sexo, nascimento) VALUES (:nome, :email, :senha, :telefone, :idade, :sexo, :nascimento)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':nascimento', $nascimento);

        try{
            $stmt->execute();
        }catch(Throwable $e){
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }
   // die('morreu aqui');


    public function verificar_login($email, $senha) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
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
}