<?php

class Password
{
    private $passwordEncrypted;
    private $siteName;
    private $siteURL;
    private $notes;
    private $created_at;
    private $idUser;

    public function __construct($passwordEncrypted, $siteName, $siteURL, $created_at, $notes = '')
    {
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

    public function getId(){
        return $this->idUser;
    }
}