<?php

require_once '../config.inc.php';

if(isset($_POST["action"])){
    $id = $_POST["studentId"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $company = $_POST["studentCompany"];
    $password = $_POST["password"];
    $password_confirmation = $_POST["password-conf"];

    if($password != $password_confirmation){
        $_SESSION["message-user"] = "2;As senha não conferem!";
        exit(header("Location: ../admin/"));      
    }
    $password = md5($password);
    global $database;

    $database->query("UPDATE `user` SET `name`='$name',`email`='$email',`password`='$password',`company`='$company' WHERE `id`='$id'");
    $_SESSION["message-user"] = "0;Você editou o aluno $name com sucesso!";
    header("Location: ../admin/");
}