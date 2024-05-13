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
        $stmt = $this->connection->prepare("INSERT INTO utilisateur (nom, prenom, age, mail, password, etat_civil) VALUES (?, ?, ?, ?, ?, ?)");
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssiss", $name, $prenom, $age, $email, $passwordHash, $etat_civil);
        $stmt->execute();
        return $stmt->insert_id;
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
