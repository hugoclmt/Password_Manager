<?php

class Password
{
    private $idPassword;
    private $passwordEncrypted;
    private $siteName;
    private $siteURL;
    private $notes;
    private $created_at;
    private $idUser;



    public function __construct($passwordEncrypted, $siteName, $siteURL, $created_at,$notes = '',$idPassword =0)
    {
        $this->idPassword = $idPassword;
        $this->passwordEncrypted = $passwordEncrypted;
        $this->siteName = $siteName;
        $this->siteURL = $siteURL;
        $this->notes = $notes;
        $this->created_at = $created_at;
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

    public function getIdUser(){
        return $this->idUser;
    }

    public function getId()
    {
        return $this->idPassword;
    }

    public function setId($id)
    {
        $this->idPassword = $id;
    }

}