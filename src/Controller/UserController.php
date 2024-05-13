<?php

use Repository\UserRepository;

require_once '../config/Database.php';
require_once '../Repository/UserRepository.php';

class UserController
{
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function insertUser($name, $email, $password) {
        return $this->userRepository->insertUser($name, $email, $password);
    }

    public function getUserByEmail($email) {
        return $this->userRepository->findUserByEmail($email);
    }

    public function deleteUserById($id) {
        return $this->userRepository->deleteUserById($id);
    }
    public function modifyUser($User, $id) {
        return $this->userRepository->modifyUserById($User,$id);
    }

    public function affichage(){
        return $this->userRepository->AfficherUser();
    }


}