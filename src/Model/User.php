<?php

namespace Model;

class User
{
    public $id;
    public $name;
    public $prename;

    public $age;
    public $email;
    public $password;

    public $etatCivil;



    public function __construct($id, $name, $email, $password) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

}