<?php

//Configurações do banco de dados!
$host = "localhost";
$dbname = "tdc";
$username = "root";
$password = "root";
$port = 8888;

//Definição dos nomes para acesso
define("APP_ROOT", dirname(__FILE__));
define("APP_NAME", "TDCAP");
define("APP_URL", "localhost/TDCAP");

//Tamanho maximo para upload de arquivos
ini_set("upload_max_filesize", "100M");

//Defini banco de dados
require_once 'classes/Database.class.php';
$database = new DataBase();