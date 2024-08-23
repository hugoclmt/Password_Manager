<?php

class FailedLogins
{
    private $attemptedAt;
    private $ipAddress;
    private $idUser;


    public function __construct($idUser, $attemptedAt, $ipAddress)
    {
        $this->idUser  = $idUser;
        $this->attemptedAt = $attemptedAt;
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return mixed
     */
    public function getAttemptedAt()
    {
        return $this->attemptedAt;
    }

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }


}