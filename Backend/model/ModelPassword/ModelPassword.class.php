<?php

require_once './Backend/model/ModelAbstraite.class.php';
require_once './Backend/classes/Password.class.php';

class ModelPassword extends ModelAbstraite
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPassword(){
        $query = "SELECT * FROM password WHERE idUser = :idUser";
        $req = $this->pdo->prepare($query);
        $req -> bindValue(':idUser', htmlspecialchars($_SESSION['id']));
        $req -> execute();
        $results = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $result) {
            $passwords[] = new Password($result['passwordEncrypted'], $result['siteName'], $result['siteURL'], $result['created_at'], $result['notes']);
        }
        return $passwords;
    }
}