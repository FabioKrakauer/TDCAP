<?php

require_once '../config.inc.php';

global $database;

if(isset($_POST["action"])){
    $user = $_POST["studentId"];
    $course = $_POST["courseId"];
    $database->query("DELETE FROM `user_course` WHERE `user_id`='$user' AND `course_id`='$course'");
    $database->query("DELETE FROM `user_exam` WHERE `user_id`='$user' AND `course_id`='$course'");
    $database->query("DELETE FROM `user_exam_result` WHERE `user_id`='$user' AND `course_id`='$course'");
    $database->query("DELETE FROM `user_slides` WHERE `user_id`='$user' AND `course_id`='$course'");
    $_SESSION["message-user"] = "0;Você removeu o curso (#$course) do aluno (#$user) com sucesso!";
    header("Location: ../admin/");
}