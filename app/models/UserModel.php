<?php

namespace GymSolution\Models;

use GymSolution\System\Database;
use PDO;
use Throwable;

class UserModel extends Database
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }


    // com calculo no controller
    public function add_user_data($post_data)
    {

        $UserId = $_SESSION['user']['id'];
        $altura = $post_data['altura'];
        $peso = $post_data['peso'];
        $cintura = $post_data['cintura'];
        $quadril = $post_data['quadril'];
        $pescoco = $post_data['pescoco'];
        $meta = $post_data['meta'];
        $braco = $post_data['braco'];
        $antebraco = $post_data['antebraco'];
        $cinturaEscapular = $post_data['cinturaEscapular'];
        $perna = $post_data['perna'];
        $panturrilha = $post_data['panturrilha'];
        $gordura = $post_data['gordura'];
        $basal = $post_data['basal'];


        $stmt = $this->conn->prepare("INSERT INTO userdata (UserId, altura, pescoco, cintura, quadril, meta, peso, braco, antebraco, cinturaEscapular, perna, panturrilha, gordura, basal, CreatedAt) VALUES (:UserId, :altura, :pescoco, :cintura, :quadril, :meta, :peso, :braco, :antebraco, :cinturaEscapular, :perna, :panturrilha, :gordura, :basal, NOW())");

        $stmt->bindParam(':UserId', $UserId, PDO::PARAM_INT);
        $stmt->bindParam(':altura', $altura, PDO::PARAM_INT);
        $stmt->bindParam(':pescoco', $pescoco, PDO::PARAM_INT);
        $stmt->bindParam(':cintura', $cintura, PDO::PARAM_INT);
        $stmt->bindParam(':quadril', $quadril, PDO::PARAM_INT);
        $stmt->bindParam(':meta', $meta);// não pode ser int
        $stmt->bindParam(':peso', $peso, PDO::PARAM_INT);
        $stmt->bindParam(':basal', $basal, PDO::PARAM_INT);
        $stmt->bindParam(':braco', $braco, PDO::PARAM_INT);
        $stmt->bindParam(':antebraco', $antebraco, PDO::PARAM_INT);
        $stmt->bindParam(':cinturaEscapular', $cinturaEscapular, PDO::PARAM_INT);
        $stmt->bindParam(':perna', $perna, PDO::PARAM_INT);
        $stmt->bindParam(':panturrilha', $panturrilha, PDO::PARAM_INT);
        $stmt->bindParam(':gordura', $gordura, PDO::PARAM_INT);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }

    // sem calculo no controller
    public function add_user_data_2($post_data)
    {

        $UserId = $_SESSION['user']['id'];
        $altura = $post_data['text_altura'];
        $peso = $post_data['text_peso'];
        $cintura = $post_data['text_cintura'];
        $quadril = $post_data['text_quadril'];
        $pescoco = $post_data['text_pescoco'];
        $meta = $post_data['text_meta'];
        $braco = $post_data['text_braco'];
        $antebraco = $post_data['text_antebraco'];
        $cinturaEscapular = $post_data['text_cinturaEscapular'];
        $perna = $post_data['text_perna'];
        $panturrilha = $post_data['text_panturrilha'];
        $gordura = $post_data['text_gordura'];
        $basal = $post_data['text_basal'];

        
        $stmt = $this->conn->prepare("INSERT INTO userdata (UserId, altura, pescoco, cintura, quadril, meta, peso, braco, antebraco, cinturaEscapular, perna, panturrilha, gordura, basal, CreatedAt) VALUES (:UserId, :altura, :pescoco, :cintura, :quadril, :meta, :peso, :braco, :antebraco, :cinturaEscapular, :perna, :panturrilha, :gordura, :basal, NOW())");

        $stmt->bindParam(':UserId', $UserId, PDO::PARAM_INT);
        $stmt->bindParam(':altura', $altura, PDO::PARAM_INT);
        $stmt->bindParam(':pescoco', $pescoco, PDO::PARAM_INT);
        $stmt->bindParam(':cintura', $cintura, PDO::PARAM_INT);
        $stmt->bindParam(':quadril', $quadril, PDO::PARAM_INT);
        $stmt->bindParam(':meta', $meta);// não pode ser int
        $stmt->bindParam(':peso', $peso, PDO::PARAM_INT);
        $stmt->bindParam(':basal', $basal, PDO::PARAM_INT);
        $stmt->bindParam(':braco', $braco, PDO::PARAM_INT);
        $stmt->bindParam(':antebraco', $antebraco, PDO::PARAM_INT);
        $stmt->bindParam(':cinturaEscapular', $cinturaEscapular, PDO::PARAM_INT);
        $stmt->bindParam(':perna', $perna, PDO::PARAM_INT);
        $stmt->bindParam(':panturrilha', $panturrilha, PDO::PARAM_INT);
        $stmt->bindParam(':gordura', $gordura, PDO::PARAM_INT);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }
    }

    //pega todos os dados não deletados
    public function get_user_data($UserId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM userdata WHERE UserId = :UserId and DeletedAt is null");
        $stmt->bindParam(':UserId', $UserId);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }

        $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $user_data;
    }

    // pega os dados not null deletados
    public function get_user_data_delete($UserId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM userdata WHERE UserId = :UserId and DeletedAt is not null");
        $stmt->bindParam(':UserId', $UserId);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }

        $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $user_data;
    }
    
    // ultimo inssert userdata da pessoa
    public function get_last_user_data($UserId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM userdata WHERE UserId = :UserId and DeletedAt is null ORDER BY id DESC LIMIT 1");
        $stmt->bindParam(':UserId', $UserId);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }

        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user_data;
    }

    // para fazer o edit 
    public function get_1_data_user($id){

        $stmt = $this->conn->prepare("SELECT * FROM userdata WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }

        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user_data;
    }

    //UPDATES

    public function soft_delete($id){

        $stmt = $this->conn->prepare("UPDATE userdata SET DeletedAt = NOW() WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }

    }
    
    public function data_user_edit($post_data, $id){
        

        $id = $_GET['id'];
        //$UserId = $_SESSION['user']['id'];
        $altura = $post_data['text_altura'];
        $peso = $post_data['text_peso'];
        $cintura = $post_data['text_cintura'];
        $quadril = $post_data['text_quadril'];
        $pescoco = $post_data['text_pescoco'];
        $meta = $post_data['text_meta'];
        $braco = $post_data['text_braco'];
        $antebraco = $post_data['text_antebraco'];
        $cinturaEscapular = $post_data['text_cinturaEscapular'];
        $perna = $post_data['text_perna'];
        $panturrilha = $post_data['text_panturrilha'];
        $gordura = $post_data['text_gordura'];
        $basal = $post_data['text_basal'];
        
        // Utilize uma consulta UPDATE com SET e WHERE para especificar as condições
        $stmt = $this->conn->prepare("UPDATE userdata SET altura = :altura, pescoco = :pescoco, cintura = :cintura, quadril = :quadril, meta = :meta, peso = :peso, basal = :basal, braco = :braco, antebraco = :antebraco, cinturaEscapular = :cinturaEscapular, perna = :perna, panturrilha = :panturrilha, gordura = :gordura, UpdatedAt = NOW() WHERE id = :id");
        
        // Faça as ligações dos parâmetros corretamente
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':altura', $altura, PDO::PARAM_INT);
        $stmt->bindParam(':pescoco', $pescoco, PDO::PARAM_INT);
        $stmt->bindParam(':cintura', $cintura, PDO::PARAM_INT);
        $stmt->bindParam(':quadril', $quadril, PDO::PARAM_INT);
        $stmt->bindParam(':meta', $meta); // Neste ponto, é assumido que 'meta' é uma string, ajuste se necessário
        $stmt->bindParam(':peso', $peso, PDO::PARAM_INT);
        $stmt->bindParam(':basal', $basal, PDO::PARAM_INT);
        $stmt->bindParam(':braco', $braco, PDO::PARAM_INT);
        $stmt->bindParam(':antebraco', $antebraco, PDO::PARAM_INT);
        $stmt->bindParam(':cinturaEscapular', $cinturaEscapular, PDO::PARAM_INT);
        $stmt->bindParam(':perna', $perna, PDO::PARAM_INT);
        $stmt->bindParam(':panturrilha', $panturrilha, PDO::PARAM_INT);
        $stmt->bindParam(':gordura', $gordura, PDO::PARAM_INT);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }


    }

    

}
