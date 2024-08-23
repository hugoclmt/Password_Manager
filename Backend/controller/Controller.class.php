<?php

require_once '../../Backend/classes/Users.class.php';
require_once '../../Backend/model/ModelPassword/ModelPassword.class.php';
require_once '../../Backend/classes/Password.class.php';
require_once '../../Backend/model/ModelUser/ModelUser.class.php';


class Controller
{
    private $modelPassword;
    private $modelUser;

    public function __construct()
    {
        $this->modelPassword = new ModelPassword();
        $this->modelUser = new ModelUser();
    }


    public function addPassword($password,$siteName,$siteURL,$note)
    {
        if (!empty($password) || empty(!$siteName) || empty(!$siteURL) || empty(!$note)) {
            $password = htmlspecialchars($password);
            $siteName = htmlspecialchars($siteName);
            $siteURL = htmlspecialchars($siteURL);
            $note = htmlspecialchars($note);
            $date = date('Y-m-d H:i:s');
            $password = new Password($password, $siteName, $siteURL, $date, $note);
            $user = $this->modelUser->getUserById($_SESSION['id']);
            $key = hash_pbkdf2('sha256', $user->getPassword(), $user->getEmail(), 1000, 32, true);
            return $this->modelPassword->addPassword($password, $key);

        }else{
            return false;
        }
    }

    public function getAllPassword()
    {
        return $this->modelPassword->getAllPassword();
    }
}