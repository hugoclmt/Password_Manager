<?php

class dbConfig
{
    private $host;
    private $dbName;
    private $user;
    private $password;
    private $pdo;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->dbName = 'passwordmanager';
        $this->user = 'root';
        $this->password = '';
        $this->pdo = null;

        $this->connect();
    }

    private function connect()
    {
        if($this->pdo == null) //si pdo est null
        {
            try{
                $dsn = 'mysql:host=' .$this->host . ';dbname=' .$this->dbName . ';charset=utf8'; //route pour la bd
                $this->pdo = new PDO($dsn,$this->user,$this->password); //creation du pdo
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch (PDOException $e){
                echo "Erreur de connexion a la bd";
            }
        }
    }

    public function getPDO()
    {
        if ($this->pdo == null)
        {
            $this->connect();
        }
        return $this->pdo;
    }
}