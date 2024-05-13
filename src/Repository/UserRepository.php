<?php

namespace Repository;

use config\DataBase;
use PDOException;
use Model\User;

require_once '../config/Database.php';
require_once '../Model/User.php';

class UserRepository
{

    private $connection;
    public function __construct() {
        $db = new Database();
        $this->connection = $db->getConnection();

    }

    public function insertUser($name, $email, $password, $prenom, $age, $etat_civil) {

        $errors = [];
        if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
            $errors[] = "Name must only contain letters and spaces.";
        }
        if (!preg_match("/^[a-zA-Z\s]+$/", $prenom)) {
            $errors[] = "Surname must only contain letters and spaces.";
        }

        if (empty($name) || strlen($name) > 100) {
            $errors[] = "Invalid name - either empty or too long.";
        }
        if (empty($prenom) || strlen($prenom) > 100) {
            $errors[] = "Invalid surname - either empty or too long.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }

        if (!filter_var($age, FILTER_VALIDATE_INT,
            array("options" => array("min_range" => 1))))
        {
            $errors[] = "Invalid age";
        }

        if (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters long";
        }

        $valid_etat_civil = ['single', 'married', 'divorced'];
        if (!in_array($etat_civil, $valid_etat_civil)) {
            $errors[] = "Invalid etat civil";
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $stmt = $this->connection->prepare("INSERT INTO utilisateur (nom, prenom, age, mail, password, etat_civil) VALUES (?, ?, ?, ?, ?, ?)");
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssiss", $name, $prenom, $age, $email, $passwordHash, $etat_civil);
        $stmt->execute();
        if ($stmt->error) {
            return ['success' => false, 'errors' => ['db_error' => $stmt->error]];
        }
        return ['success' => true, 'insert_id' => $stmt->insert_id];
    }


    public function AfficherUser($id = null) {
        try {
            $sql = 'SELECT * FROM utilisateur';
            if (!is_null($id)) {
                $sql .= ' WHERE id = ?';
            }
            $query = $this->connection->prepare($sql);
            if (!is_null($id)) {
                $query->bind_param("i", $id);
            }
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteUserById($id) {
        $stmt = $this->connection->prepare("DELETE FROM utilisateur WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function modifyUserById(User $User, $id) {
        $stmt = $this->connection->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, mail = ?, password = ?, etat_civil = ?, age = ? WHERE id = ?");
        $passwordHash = password_hash($User->getPassword(), PASSWORD_DEFAULT);
        $stmt->bind_param("ssssiii", $User->getNom(), $User->getPrenom(), $User->getMail(), $passwordHash, $User->getEtatCivil(), $User->getAge(), $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

}
