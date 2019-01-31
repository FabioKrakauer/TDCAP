<?php 

$dir = realpath(__DIR__ . '/..');
include_once $dir.'/config.inc.php';

class DataBase{
    
    private $host;
    private $database;
    private $port;
    private $user;
    private $password;

    private $connection;

    public function __construct(){
        global $host;
        global $dbname;
        global $username;
        global $password;
        global $port;

        $this->database = $dbname;
        $this->user = $username;
        $this->password = $password;
        $this->port = $port;
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->database;
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
        try{
            $this->connection = new PDO($dsn, $this->user, $this->password);
        }catch(PDOException $e){
            echo '<h1>Erro ao conectar a um banco de dados!</h3>';
            echo 'Contate um administrador!';
            die();
        }
    }
}