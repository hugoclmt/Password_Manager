<?php
require_once './Backend/model/ModelUser/ModelUser.class.php';

class ModelUserConnexion extends ModelUser
{
    public function __construct()
    {
        parent::__construct();
    }

    public function connexion(Users $users)
    {
        $result = $this->verifierEmail($users->getEmail());
        if($result)
        {
            if(password_verify($users->getPassword(), $result['password']))
            {
                $_SESSION['id'] = $result['idUser'];
                return true; //Si le mdp est ok on retourne true
            }
            else
            {

                return false; //Si le mdp est incorrect on retourne false
            }
        }
        else
        {
            return null; // Si l'email n'existe pas on retourne null
        }
    }
}