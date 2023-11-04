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
    /*
    public function add_user_data($post_data){

        $UserId = $_SESSION['user']['id'];
        $altura = $post_data['altura'];
        $peso = $post_data['peso'];
        $cintura = $post_data['cintura'];
        $quadril = $post_data['quadril'];
        $pescoco = $post_data['pescoco'];
        $meta = $post_data['meta'];
        $peso = $post_data['peso'];
        $basal = $post_data['basal'];
        $braco = $post_data['braco'];
        $antebraco = $post_data['antebraco'];
        $cinturaEscapular = $post_data['cinturaescapular'];
        $perna = $post_data['perna'];
        $panturrilha = $post_data['panturrilha'];
        CreatedAt

        $stmt = $this->conn->prepare("INSERT INTO userdata (UserId, email, senha, telefone, idade, sexo, nascimento) VALUES (:UserId, :email, :senha, :telefone, :idade, :sexo, :nascimento)");

    }
    */

    // MASCULINO CALCULO
    public function add_user_dataM($post_data)
    {

        $UserId = $_SESSION['user']['id'];
        $altura = $post_data['altura'];
        $pescoco = $post_data['pescoco'];
        $cintura = $post_data['cintura'];

        $stmt = $this->conn->prepare("INSERT INTO userdata (UserId, altura, pescoco, cintura, CreatedAt) VALUES (:UserId, :altura, :pescoco, :cintura, NOW())");
        $stmt->bindParam(':UserId', $UserId);
        $stmt->bindParam(':altura', $altura);
        $stmt->bindParam(':pescoco', $pescoco);
        $stmt->bindParam(':cintura', $cintura);

        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }

    }

    // FEMININO CALCULO
    public function add_user_dataF($post_data)
    {

        $UserId = $_SESSION['user']['id'];
        $altura = $post_data['altura'];
        $pescoco = $post_data['pescoco'];
        $cintura = $post_data['cintura'];
        $quadril = $post_data['quadril'];

        $stmt = $this->conn->prepare("INSERT INTO userdata (UserId, altura, pescoco, cintura, quadril, CreatedAt) VALUES (:UserId, :altura, :pescoco, :cintura, :quadril, NOW())");

        $stmt->bindParam(':UserId', $UserId);
        $stmt->bindParam(':altura', $altura);
        $stmt->bindParam(':pescoco', $pescoco);
        $stmt->bindParam(':cintura', $cintura);
        $stmt->bindParam(':quadril', $quadril);


        try {
            $stmt->execute();
        } catch (Throwable $e) {
            echo '<pre>';
            print_r($stmt);
            echo '<br>';
            print_r($e);
        }

    }

    public function get_user_data($UserId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM userdata WHERE UserId = :UserId");
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

        $data = [$user_data];
        $_SESSION['user_data'] = $data;
        return $data;
    }
}
