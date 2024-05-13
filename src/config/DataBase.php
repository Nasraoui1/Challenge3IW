<?php

namespace config;

use PDO;
use PDOException;

class DataBase
{
    private $host = "localhost";
    private $db_name = "";
    private $username = "";
    private $password = "";
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
                $this->conn = new PDO("pgsql:host=".
                $this->host . ";dbname= " .
                $this->db_name,
                $this->username,
                $this->password);

            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

}