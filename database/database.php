<?php

class DbHelper
{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'newgoldplaceph';

    public function connect()
    {

        try {
            $dsn = 'mysql:host=' . $this->servername . ';dbname=' . $this->dbname;
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $error) {
            echo $error;
            die();
        }
    }
}
