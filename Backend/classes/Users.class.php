<?php

class Users
{
    private $email;
    private $password;
    private $created_at;
    private $isActif;

    public function __construct( $email, $password, $created_at ='')
    {
        $this->email = $email;
        $this->password = $this->hashPassword($password);
        $this->created_at = $created_at;
        $this->isActif = true;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function getIsActif()
    {
        return $this->isActif;
    }

    public function setIsActif($isActif)
    {
        $this->isActif = $isActif;
    }

    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}