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
        $this->password = $password;
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

    private function setpassword($password)
    {
        $this->password = $password ;
    }

    public function hashPassword()
    {
        $this->setpassword(password_hash($this->password, PASSWORD_DEFAULT));
    }
}