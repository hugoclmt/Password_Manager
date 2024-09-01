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

            $user = $this->modelUser->getUserById($_SESSION['id']);
            $key = $user->getPassword();
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            $encryptedPassword = openssl_encrypt($password, 'aes-256-cbc', $key, $options=0, $iv);

            $combinedData = base64_encode($iv . $encryptedPassword);

            $passwordObject = new Password($combinedData, $siteName, $siteURL, $date, $note);

            return $this->modelPassword->addPassword($passwordObject);
        } else {
            return null;
        }
    }

    public function getAllPassword()
    {
        $passwords = $this->modelPassword->getAllPassword();
        $user = $this->modelUser->getUserById($_SESSION['id']);

        foreach ($passwords as $password) {
            $key = $user->getPassword();  // La clé de chiffrement

            $combinedData = base64_decode($password->getPasswordEncrypted());


            $iv_length = openssl_cipher_iv_length('aes-256-cbc');
            $iv = substr($combinedData, 0, $iv_length);


            $encryptedPassword = substr($combinedData, $iv_length);


            $decryptedPassword = openssl_decrypt($encryptedPassword, 'aes-256-cbc', $key, $options=0, $iv);


            $password->setPasswordEncrypted($decryptedPassword);
        }

        return $passwords;

    }

}