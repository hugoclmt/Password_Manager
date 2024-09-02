<?php
require_once './Backend/model/ModelUser/ModelUser.class.php';
require_once './Backend/classes/FailedLogins.class.php';
require_once './Backend/model/ModelFailedLogins/ModelFailedLogin.class.php';

class ModelUserConnexion extends ModelUser
{
    private $modelFailedLogin;

    public function __construct()
    {
        parent::__construct();
        $this->modelFailedLogin = new ModelFailedLogin();
    }

    public function connexion(Users $users,$ip)
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
                $this->modelFailedLogin->insererFailedLogin(new FailedLogins($result['idUser'], date('Y-m-d H:i:s'), $ip));
                return false; //Si le mdp est incorrect on retourne false
            }
        }
        else
        {
            return null; // Si l'email n'existe pas on retourne null
        }
    }
}