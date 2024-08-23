<?php

require_once 'C:\wamp64\www\projetPerso\Password_Manager\Backend\model\ModelAbstraite.class.php';
require_once 'C:\wamp64\www\projetPerso\Password_Manager\Backend\classes\Password.class.php';

class ModelPassword extends ModelAbstraite
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addPassword(Password $password,$key){
        $query = "INSERT INTO password (passwordEncrypted, siteName, siteURL, notes, created_at, salt, iv, idUser) VALUES (:passwordEncrypted, :siteName, :siteURL, :notes, :created_at, :salt, :iv, :idUser)";
        $req = $this->pdo->prepare($query);
        $req -> bindValue(':passwordEncrypted', openssl_encrypt($password->getPasswordEncrypted(), 'aes-256-cbc', $key, 0, $password->getIv()));
        $req -> bindValue(':siteName', $password->getSiteName());
        $req -> bindValue(':siteURL', $password->getSiteURL());
        $req -> bindValue(':notes', $password->getNotes());
        $req -> bindValue(':created_at', $password->getCreated_at());
        $req -> bindValue(':salt', $password->getSalt());
        $req -> bindValue(':iv', $password->getIv());
        $req -> bindValue(':idUser', $password->getId());
        if ($req->execute()){
            return true;
        }
        else {
            return false;
        }
    }


    public function getAllPassword(){
        $query = "SELECT * FROM password WHERE idUser = :idUser";
        $req = $this->pdo->prepare($query);
        $req -> bindValue(':idUser', htmlspecialchars($_SESSION['id']));
        $req -> execute();
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $passwords = [];
        foreach ($results as $result) {
            $passwords = new Password($result['passwordEncrypted'], $result['siteName'], $result['siteURL'], $result['created_at'], $result['notes']);
        }
        return $passwords;
    }

    public function modifierPassword(Password $password){

    }

    public function modifierSiteUrl(){

    }

    public function modifierSiteName()
    {

    }

    public function modifierNote(){

    }

    public function supprimerPassword()
    {

    }

    private function getPassword($id){
        $query = "SELECT * FROM password WHERE idPassword = :idPassword";
        $req = $this->pdo->prepare($query);
        $req -> bindValue(':idPassword',$id);
        $req->execute();
        $result = $req->fetch();
        return new Password($result['passwordEncrypted'],$result['siteName'],$result['siteUrl'],$result['created_at'],$result['notes']);
    }
}