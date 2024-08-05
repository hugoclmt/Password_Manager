<?php

require '../config/dbConfig.class.php';

abstract class ModelAbstraite
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = (new dbConfig())->getPDO();
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}