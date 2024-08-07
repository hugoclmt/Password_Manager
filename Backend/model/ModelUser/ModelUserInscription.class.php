<?php

require_once './Backend/model/ModelUser/ModelUser.class.php';

class ModelUserInscription extends ModelUser
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inscription(Users $users){
        if (!$this->verifierEmail($users->getEmail())) {
            $req = "INSERT INTO users (email, password, created_at, isActif)  VALUES (:email, :password, :created_at, :isActif)";
            $req = $this->pdo->prepare($req);
            $req->bindValue(':email', $users->getEmail());
            $req->bindValue(':password', $users->getPassword());
            $req->bindValue(':created_at', $users->getCreated_at());
            $req->bindValue(':isActif', $users->getIsActif(), PDO::PARAM_BOOL);
            if($req->execute()){
                return true;
            }
            else {
                return null;
            }
        }else {
            return false;
        }
    }
}