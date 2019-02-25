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
        echo "Suas senhas não conferem!";
    }else{
        global $database;
        $today = date("Y-m-d",time());
        $userID = $database->insertGetLastID("INSERT INTO `user` (`id`, `name`, `email`, `password`, `company`, `admin`, `created_at`) VALUES (NULL, '$name', '$email', '$password', '$company', '$admin', '$today')");
        $database->query("INSERT INTO `user_course` (`id`, `user_id`, `course_id`) VALUES (NULL, '$userID', '$course')");
        echo "Usuario criado com sucesso";
    }
}