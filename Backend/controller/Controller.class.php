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


    public function addPassword($password, $siteName, $siteURL, $note)
    {
        if (!empty($password) && !empty($siteName) && !empty($siteURL) && !empty($note)) {

            $password = htmlspecialchars($password);
            $siteName = htmlspecialchars($siteName);
            $siteURL = htmlspecialchars($siteURL);
            $note = htmlspecialchars($note);
            $date = date('Y-m-d H:i:s');

            $salt = random_bytes(32); 
            $iv_length = openssl_cipher_iv_length('aes-256-cbc');
            $iv = openssl_random_pseudo_bytes($iv_length); // IV pour AES

            $user = $this->modelUser->getUserById($_SESSION['id']);

            $key = hash_pbkdf2('sha256', $user->getPassword(), $salt, 1000, 32, true);

            $encryptedPassword = openssl_encrypt($password, 'aes-256-cbc', $key, 0, $iv);

            $passwordObject = new Password($encryptedPassword, $siteName, $siteURL, $date, $note, $salt, $iv);

            return $this->modelPassword->addPassword($passwordObject, $key);
        } else {
            return null;
        }
    }

    public function getAllPassword()
    {
        $passwords = $this->modelPassword->getAllPassword();
        $user = $this->modelUser->getUserById($_SESSION['id']);

        foreach ($passwords as $password) {
            $key = hash_pbkdf2('sha256', $user->getPassword(), $password->getSalt(), 1000, 32, true);

            $decryptedPassword = openssl_decrypt($password->getPasswordEncrypted(), 'aes-256-cbc', $key, 0, $password->getIv());

            $password->setPasswordEncrypted($decryptedPassword);
        }

        return $passwords;
    }

}