<?php

class Password
{
    private $passwordEncrypted;
    private $siteName;
    private $siteURL;
    private $notes;
    private $created_at;
    private $idUser;
    private $salt;
    private $iv;

    public function __construct($passwordEncrypted, $siteName, $siteURL, $created_at, $notes = '')
    {
        $this->passwordEncrypted = $passwordEncrypted;
        $this->siteName = $siteName;
        $this->siteURL = $siteURL;
        $this->notes = $notes;
        $this->created_at = $created_at;
        $this->salt = random_bytes(32);
        $this->iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $this->idUser = $_SESSION['id'];
    }

    public function getPasswordEncrypted()
    {
        return $this->passwordEncrypted;
    }

    public function getSiteName()
    {
        return $this->siteName;
    }

    public function getSiteURL()
    {
        return $this->siteURL;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getIv()
    {
        return $this->iv;
    }

    public function getId(){
        return $this->idUser;
    }
}