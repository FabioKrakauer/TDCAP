<?php

require_once '../config.inc.php';

global $database;

if(isset($_POST["action"])){
    $user = $_POST["studentId"];
    $course = $_POST["courseId"];
    $database->query("UPDATE `user_course` SET `disabled` = '1' WHERE `user_id`='$user' AND `course_id`='$course'");
    $_SESSION["message-user"] = "0;Você desabilitou o curso (#$course) do aluno (#$user) com sucesso!";
    header("Location: ../admin/");
}