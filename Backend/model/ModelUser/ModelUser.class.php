<?php

require '../ModelAbstraite.class.php';

class ModelUser extends ModelAbstraite
{
    public function __construct()
    {
        parent::__construct();
    }


    protected function verifierEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $req = $this->pdo->prepare($query);
        $req -> bindValue(':email', $email);
        $req -> execute();
        $result = $req->fetch();
        return $result;
    }


}