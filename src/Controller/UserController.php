<?php

namespace Controller;

use Repository\UserRepository;
use Model\User;

require_once '../config/Database.php';
require_once '../Repository/UserRepository.php';

class UserController
{
    private UserRepository $userRepository;

    /**
     * UserController constructor.
     * Dependency Injection of UserRepository to facilitate testing and flexibility.
     * @param UserRepository $userRepository Instance of UserRepository.
     */
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Inserts a user into the database.
     * @param string $nom
     * @param string $prenom
     * @param string $password
     * @param string $mail
     * @param string $etat_civil
     * @param int $age
     * @return int ID of the inserted user.
     */
    public function insertUser(string $nom, string $prenom, string $password, string $mail, string $etat_civil, int $age): int {
        return $this->userRepository->insertUser($nom, $prenom, $password, $mail, $etat_civil, $age);
    }

    /**
     * Retrieves a user by email.
     * @param string $mail Email of the user to find.
     * @return User|null User object or null if not found.
     */
    public function getUserByEmail(string $mail): ?User {
        return $this->userRepository->findUserByEmail($mail);
    }

    /**
     * Deletes a user by ID.
     * @param int $id ID of the user to delete.
     * @return bool True if the user was deleted, false otherwise.
     */
    public function deleteUserById(int $id): bool {
        return $this->userRepository->deleteUserById($id);
    }

    /**
     * Modifies an existing user in the database.
     * @param User $user User object containing updated data.
     * @param int $id ID of the user to update.
     * @return bool True if the update was successful, false otherwise.
     */
    public function modifyUser(User $user, int $id): bool {
        return $this->userRepository->modifyUserById($user, $id);
    }

    /**
     * Fetches all users from the database.
     * @return array An array of User objects.
     */
    public function affichage(): array {
        return $this->userRepository->AfficherUser();
    }
}
