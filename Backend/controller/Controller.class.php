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
        if (!empty($password)) {
            $password = $this->cryptPassword($password, $siteName, $siteURL, $note);
            if (!empty($password)) {
                return $this->modelPassword->addPassword($password);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function getAllPassword()
    {
        $passwords = $this->modelPassword->getAllPassword();
        $user = $this->modelUser->getUserById($_SESSION['id']);
        $key = substr(hash('sha256', $user->getPassword(), true), 0, 32);

        foreach ($passwords as $password) {
            $combinedData = base64_decode($password->getPasswordEncrypted());
            $iv_length = openssl_cipher_iv_length('aes-256-cbc');

            if (strlen($combinedData) < $iv_length) {
                echo "Erreur : Données chiffrées corrompues ou tronquées.";
                continue;
            }

            $iv = substr($combinedData, 0, $iv_length);
            $encryptedPassword = substr($combinedData, $iv_length);

            $decryptedPassword = openssl_decrypt($encryptedPassword, 'aes-256-cbc', $key, 0, $iv);

            if ($decryptedPassword === false) {
                echo "Erreur de déchiffrement : " . openssl_error_string();
            } else {
                $password->setPasswordEncrypted($decryptedPassword);
            }
        }
        return $passwords;
    }

    public function updatePassword($id, $passwordEncrypted, $siteName, $siteURL, $note)
    {
        $password = $this->cryptPassword($passwordEncrypted, $siteName, $siteURL, $note);
        $password->setId($id);
        if (!empty($password)) {
            return $this->modelPassword->updatePassword($password);
        } else {
            return null;
        }
    }

    public function deletePassword($id)
    {
        if (!empty($id)) {
            $id = htmlspecialchars($id);
            $password = $this->modelPassword->getPassword($id);
            $password->setId($id);
            return $this->modelPassword->deletePassword($password);
        } else {
            return null;
        }
    }

    private function cryptPassword($passwordEncrypted, $siteName, $siteURL, $note)
    {
        $passwordEncrypted = htmlspecialchars($passwordEncrypted);
        $siteName = htmlspecialchars($siteName);
        $siteURL = htmlspecialchars($siteURL);
        $note = htmlspecialchars($note);
        $date = date('Y-m-d H:i:s');
        $user = $this->modelUser->getUserById($_SESSION['id']);
        $key = substr(hash('sha256', $user->getPassword(), true), 0, 32);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptedPassword = openssl_encrypt($passwordEncrypted, 'aes-256-cbc', $key, 0, $iv);

        if ($encryptedPassword === false) {
            echo "Erreur de chiffrement : " . openssl_error_string();
            return null;
        }

        $combinedData = base64_encode($iv . $encryptedPassword);

        return new Password($combinedData, $siteName, $siteURL, $date, $note);
    }
}
