<?php

class Passworsd
{
    private $passwordEncrypted;
    private $siteName;
    private $siteURL;
    private $notes;
    private $created_at;


    public function __construct($passwordEncrypted, $siteName, $siteURL, $created_at, $notes = '')
    {
        $this->passwordEncrypted = $passwordEncrypted;
        $this->siteName = $siteName;
        $this->siteURL = $siteURL;
        $this->notes = $notes;
        $this->created_at = $created_at;
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
}