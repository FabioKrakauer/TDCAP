<?php

require_once '../config.inc.php';

if(isset($_POST["action"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $course = $_POST["course"];
    $company = $_POST["company"];
    $password = md5($_POST["password"]);
    $password_confir = md5($_POST["password-conf"]);
    $admin = $_POST["adminRadio"];

    if($password != $password_confir){
        $_SESSION["message-user"] = "1;As senhas não conferem!";
        header("Location: ../admin/");
    }else{
        global $database;
        $today = date("Y-m-d",time());
        $userID = $database->insertGetLastID("INSERT INTO `user` (`id`, `name`, `email`, `password`, `company`, `admin`, `created_at`) VALUES (NULL, '$name', '$email', '$password', '$company', '$admin', '$today')");
        $database->query("INSERT INTO `user_course` (`id`, `user_id`, `course_id`) VALUES (NULL, '$userID', '$course')");
        $_SESSION["message-user"] = "0;Aluno criado com sucesso!";
        header("Location: ../admin/");
    }
}