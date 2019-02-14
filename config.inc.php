<?php

//Configurações do banco de dados!
$host = "localhost";
$dbname = "tdc";
$username = "root";
$password = "";
$port = 3306;

//Definição dos nomes para acesso
define("APP_ROOT", dirname(__FILE__));
define("APP_NAME", "tdc");
define("APP_URL", "localhost/tdc");

//Tamanho maximo para upload de arquivos
ini_set("upload_max_filesize", "1000M");    

//Defini banco de dados
require_once 'classes/Database.class.php';
$database = new DataBase();