<?php

require_once 'C:\wamp64\www\projetPerso\Password_Manager\Backend\model\ModelAbstraite.class.php';
require_once 'C:\wamp64\www\projetPerso\Password_Manager\Backend\classes\Password.class.php';

class ModelPassword extends ModelAbstraite
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addPassword(Password $password){
        $query = "INSERT INTO password (passwordEncrypted, siteName, siteURL, notes, created_at, idUser) VALUES (:passwordEncrypted, :siteName, :siteURL, :notes, :created_at,:idUser)";
        $req = $this->pdo->prepare($query);
        $req -> bindValue(':passwordEncrypted', $password->getPasswordEncrypted());
        $req -> bindValue(':siteName', $password->getSiteName());
        $req -> bindValue(':siteURL', $password->getSiteURL());
        $req -> bindValue(':notes', $password->getNotes());
        $req -> bindValue(':created_at', $password->getCreated_at());
        $req -> bindValue(':idUser', $password->getIdUser());
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
            $passwords[] = new Password($result['passwordEncrypted'], $result['siteName'], $result['siteURL'], $result['created_at'],$result['notes'],$result['idPassword']);
        }
        return $passwords;
    }

    public function updatePassword(Password $password){
        $query = "UPDATE password SET passwordEncrypted = :passwordEncrypted, siteName = :siteName, siteURL = :siteURL, notes = :notes WHERE idPassword = :idPassword";
        $req = $this->pdo->prepare($query);
        $req -> bindValue(':idPassword', $password->getId());
        $req -> bindValue(':passwordEncrypted', $password->getPasswordEncrypted());
        $req -> bindValue(':siteName', $password->getSiteName());
        $req -> bindValue(':siteURL', $password->getSiteURL());
        $req -> bindValue(':notes', $password->getNotes());
        if ($req->execute()){
            return true;
        }
        else {
            return false;
        }
    }

    public function deletePassword(Password $password)
    {
        $query = "DELETE FROM password WHERE idPassword = :idPassword";
        $req = $this->pdo->prepare($query);
        $req -> bindValue(':idPassword', $password->getId());
        if ($req->execute()){
            return true;
        }
        else {
            return false;
        }
    }

    public function getPassword($id) {
        $query = "SELECT * FROM password WHERE idPassword = :idPassword";
        $req = $this->pdo->prepare($query);
        $req->bindValue(':idPassword', $id);
        $req->execute();
        $result = $req->fetch();

        if ($result === false) {

            return null;
        }

        return new Password($result['passwordEncrypted'], $result['siteName'], $result['siteURL'], $result['created_at'], $result['notes']);
    }

}