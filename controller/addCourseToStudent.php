<?php

require_once '../config.inc.php';

global $database;

if(isset($_POST["studentId"]) && isset($_POST["studentCourse"])){
    $student = $_POST["studentId"];
    $course = $_POST["studentCourse"];
    $database->query("INSERT INTO `user_course` (`id`, `user_id`, `course_id`) VALUES (NULL, '$student', '$course')");
    echo "Você adicionou o curso para o aluno com sucesso!";

}