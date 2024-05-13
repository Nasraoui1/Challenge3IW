<?php

namespace Repository;
use config\DataBase;
use PDOException;

require_once '../config/Database.php';
require_once '../Model/User.php';
class UserRepository
{
    private $connection;

    public function __construct() {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function insertUser($name, $email, $password) {
        $stmt = $this->connection->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $name, $email, $passwordHash);
        $stmt->execute();
        return $stmt->insert_id;
    }

  /*  public function findUserByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($user = $result->fetch_assoc()) {
            return new User($user['id'], $user['name'], $user['email'], $user['password']);
        }
        return null;
    }*/

    public function deleteUserById($id) {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function modifyUserById($User, $id){
        try {
            $pdo = $this->connection;
            $query = $pdo->prepare(
                'UPDATE users SET nom_user = :Nom,prenom_user = :Prenom,Email_user = :Email,pseudo_user = :Pseudo,mot_de_passe = :Mot_de_passe,sexe_user = :Sexe,date_de_naissance_user = :Date_de_naissance,adresse_user = :Adresse,matricule_fiscale_user = :Matricule_fiscale,numero_telephone_user = :Telephone,type_produit = :Type_produit, image= :image WHERE id_user = :id'
            );
            $query->execute([
                'Nom'=> $User->getNom(),
                'Prenom' => $User->getPrenom(),
                'Email' => $User->getEmail(),
                'Pseudo' => $User->getPseudo(),
                'Mot_de_passe' => $User->getMot_de_passe(),
                'Sexe' => $User->getSexe(),
                'Date_de_naissance' => $User->getDate_de_naissance(),
                'Adresse' => $User->getAdresse(),
                'Matricule_fiscale' => $User->getMatricule_fiscale(),
                'Telephone' => $User->getTelephone(),
                'Type_produit' => $User->getType_produit(),
                'id' => $id,
                'image'=>$User->getImage()
            ]);
            echo $query->rowCount() . " Utilisateur modifié.";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

}