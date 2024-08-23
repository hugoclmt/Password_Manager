<?php

require_once './Backend/classes/FailedLogins.class.php';
require_once './Backend/model/ModelAbstraite.class.php';

class ModelFailedLogin extends ModelAbstraite
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insererFailedLogin(FailedLogins $failedLogins)
    {

    }
}