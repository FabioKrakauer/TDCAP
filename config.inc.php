<?php

//Configurações do banco de dados!
$host = "localhost";
$dbname = "tdccap_prework";
$username = "root";
$password = "";
$port = 3306;

//Definição dos nomes para acesso
define("APP_ROOT", dirname(__FILE__));
define("APP_NAME", "TDC");
define("APP_URL", "localhost/TDCAP");

ini_set("upload_max_filesize", "100M");

require_once 'classes/Database.class.php';
$database = new DataBase();
