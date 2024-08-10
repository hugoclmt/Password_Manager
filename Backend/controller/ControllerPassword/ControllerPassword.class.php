<?php

require_once './Backend/model/ModelPassword/ModelPassword.class.php';

class ControllerPassword
{
    private $modelPassword;

    public function __construct()
    {
        $this->modelPassword = new ModelPassword();
    }

    public function getAllPassword()
    {
        return $this->modelPassword->getAllPassword();
    }
}