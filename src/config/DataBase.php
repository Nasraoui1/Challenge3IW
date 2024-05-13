<?php
namespace config;

use PDO;
use PDOException;

class Database {
    private $host = "localhost";
    private $db_name = "user";
    private $username = "";
    private $password = "";
    private $conx;

    /**
     * Get the database connection
     *
     * @return PDO|null
     */
    public function getConnection() {
        $this->conx = null;

        try {

                $dsn = "mysql:host=" .
                $this->host . ";dbname=" .
                $this->db_name . ";charset=utf8";

            $this->conx = new PDO($dsn, $this->username, $this->password);
            $this->conx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conx;
    }
}
