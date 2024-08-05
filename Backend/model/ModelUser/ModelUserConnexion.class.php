<?php

class ModelUserConnexion extends ModelUser
{
    public function __construct()
    {
        parent::__construct();
    }

    public function connexion(Users $users)
    {
        $result = $this->verifierEmail($users->getEmail());
        if($result)
        {
            if(password_verify($users->getPassword(), $result['password']))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return null;
        }
    }
}