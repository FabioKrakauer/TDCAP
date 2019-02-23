<?php

require_once '../config.inc.php';
global $database;

if(isset($_POST["action"])){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $cnpj = $_POST["cnpj"];
    $adress = $_POST["adress"];
    $telephone = $_POST["telephone"];
    $site = $_POST["site"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];

    $database->query("UPDATE `company` SET `name`='$name',`cnpj`='$cnpj',`adress`='$adress',`phone`='$telephone',`website`='$site',`contact`='$contact',`email`='$email' WHERE `id`='$id'");
    echo "Empresa editada!";
}