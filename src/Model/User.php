<?php

namespace Model;

class User
{
    public $id;
    public $nom;
    public $prenom;
    public $age;
    public $mail;
    public $password;
    public $etat_civil;

    /**
     * @param $id
     * @param $nom
     * @param $prenom
     * @param $age
     * @param $mail
     * @param $password
     * @param $etat_civil
     */
    public function __construct($id, $nom, $prenom, $age, $mail, $password, $etat_civil)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->mail = $mail;
        $this->password = $password;
        $this->etat_civil = $etat_civil;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEtatCivil()
    {
        return $this->etat_civil;
    }

    /**
     * @param mixed $etat_civil
     */
    public function setEtatCivil($etat_civil): void
    {
        $this->etat_civil = $etat_civil;
    }



}