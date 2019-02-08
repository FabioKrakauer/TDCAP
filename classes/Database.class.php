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
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->database.';port='.$this->port;
        try{
            $this->connection = new PDO($dsn, $this->user, $this->password);
            $this->connection->exec("set names utf8");
        }catch(PDOException $e){
            echo '<h1>Erro ao conectar a um banco de dados!</h3>';
            echo 'Contate um administrador!';
            // var_dump($e);
            die();
        }
    }
    function query($sql){
        return $this->connection->query($sql);
    }
    function getFieldsValues($sql){
        $sel = $this->query($sql);
        $fields = [];
        while($row = $sel->fetch()){
            array_push($fields, $row);
        }
        return $fields;
    }
    function getFieldValue($sql){
        $sel = $this->query($sql);
        if($row = $sel->fetch()){
            return $row;
        }
    }
    function getConnection(){
        return $this->connection;
    }
    function getLastInsertedID($query){
        $stm = $this->connection->prepare($query);
        $stm->execute();
        return $this->conn->lastInsertId();
    }
}