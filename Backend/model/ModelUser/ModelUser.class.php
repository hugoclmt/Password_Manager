<?php

require_once './Backend/model/ModelAbstraite.class.php';

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
        return $req->fetch();
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $req = $this->pdo->prepare($query);
        $req -> bindValue(':id', $id);
        $req -> execute();
        if ($req->rowCount() == 1) {
            return new Users($req->fetch()['email'], $req->fetch()['password'], $req->fetch()['created_at']);
        }
        else {
            return false;
        }
    }


}