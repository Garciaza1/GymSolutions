<?php
namespace GymSolution\System;
use PDO;
use PDOException;

class Database 
{
    private $host = MYSQL_HOST;
    private $dbname = MYSQL_DATABASE;
    private $user = MYSQL_USERNAME;
    private $pass = MYSQL_PASSWORD;
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->pass
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $error) {
            echo 'Erro de conexão: ' . $error->getMessage();
        }

        return $this->conn;
    }

}