<?php

require_once './Backend/classes/FailedLogins.class.php';
require_once './Backend/model/ModelAbstraite.class.php';

class ModelFailedLogin extends ModelAbstraite
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insererFailedLogin(FailedLogins $failedLogins)
    {
        $sql = "INSERT INTO failedlogins (attempted_at, ipAdress, idUser) VALUES (:attemptedAt, :ipAdress, :idUser)";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':attemptedAt', $failedLogins->getAttemptedAt());
        $query->bindValue(':ipAdress', $failedLogins->getIpAddress());
        $query->bindValue(':idUser', $failedLogins->getIdUser());
        $query->execute();
    }
}