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

    public function __construct($passwordEncrypted, $siteName, $siteURL, $created_at, $salt, $iv,$notes = '')
    {
        $this->passwordEncrypted = $passwordEncrypted;
        $this->siteName = $siteName;
        $this->siteURL = $siteURL;
        $this->notes = $notes;
        $this->created_at = $created_at;
        $this->salt = $salt;
        $this->iv = $iv;
        $this->idUser = $_SESSION['id'];
    }

    public function getPasswordEncrypted()
    {
        return $this->passwordEncrypted;
    }

    public function setPasswordEncrypted($newPassword)
    {
        $this->passwordEncrypted = $newPassword;
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