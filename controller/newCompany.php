<?php
$dir = realpath(__DIR__ . '/..');
require_once $dir.'/config.inc.php';

if(isset($_POST["action"])){
    global $database;

    $name = $_POST["name"];
    $cnpj = $_POST["cnpj"];
    $adress = $_POST["adress"];
    $telephone = $_POST["telephone"];
    $website = $_POST["site"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];

    $id = $database->query("INSERT INTO `company` (`id`, `name`, `cnpj`, `adress`, `phone`, `website`, `contact`, `email`) VALUES (NULL, '$name', '$cnpj', '$adress', '$telephone', '$website', '$contact', '$email')");

    $_SESSION["message-user"] = "0;Você cadastrou a empresa $name com sucesso!";
    header("Location: ../admin/");


}
