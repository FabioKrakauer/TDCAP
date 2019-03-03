<?php

require_once '../config.inc.php';

global $database;

if(isset($_POST["studentId"]) && isset($_POST["studentCourse"])){
    $student = $_POST["studentId"];
    $course = $_POST["studentCourse"];
    $database->query("INSERT INTO `user_course` (`id`, `user_id`, `course_id`) VALUES (NULL, '$student', '$course')");
    $_SESSION["message-user"] = "0;Você adicionou o curso (#$course) para o aluno (#$student) com sucesso!";
    header("Location: ../admin/");

}