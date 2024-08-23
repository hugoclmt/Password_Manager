<?php
require_once './Backend/model/ModelUser/ModelUserConnexion.class.php';
require_once './Backend/model/ModelUser/ModelUserInscription.class.php';
class ControllerAuth
{
    private $modelUserConnexion;
    private $modelUserInscription;

    public function __construct()
    {
        $this->modelUserConnexion = new ModelUserConnexion();
        $this->modelUserInscription = new ModelUserInscription();
    }

    public function connexion($email, $password)
    {
        if (!empty($email) || empty(!$password)) {
            $email = htmlspecialchars($email);
            $password = htmlspecialchars($password);
            $user = new Users($email, $password);
            $result = $this->modelUserConnexion->connexion($user);
            if ($result) {
                $_SESSION['connected'] = true;
                header('Location: ./Frontend/userAuthentificated/indexUserAuthentificated.php');
                exit();
            } else {
                return false;
            }

        }
        return false;
    }

    public function inscription($email, $password)
    {
        if (!empty($email) || empty(!$password)) {
            $email = htmlspecialchars($email);
            $password = htmlspecialchars($password);
            $created_at = date('Y-m-d');
            $user = new Users($email, $password, $created_at);
            $user->hashPassword();
            $result = $this->modelUserInscription->inscription($user);
            if ($result) {
                $_SESSION['connected'] = true;
                header('Location: ./Frontend/userAuthentificated/indexUserAuthentificated.php');
                exit();
            } else {
                return false;
            }
        }

        return false;
    }

}