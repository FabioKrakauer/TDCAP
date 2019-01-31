<?php 

require_once("../config.inc.php");

class DataBase{
    
    private $host;
    private $database;
    private $port;
    private $user;
    private $password;

    private $connection;

    public function __construct(){
        $this->host = $host;
        $this->database = $dbname;
        $this->user = $username;
        $this->password = $password;
        $this->port = $port;

        $this->connection = new PDO();

    }
}