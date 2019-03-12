<?php

require_once '../config.inc.php';

global $database;

if(isset($_POST)){
    $course = $_POST["course_id"];
    $question = $_POST["question"];
    $correct = $_POST["correct_alternative"];
    $first = $_POST["1_alternative"];
    $second = $_POST["2_alternative"];
    $third = $_POST["3_alternative"];
    $forth = $_POST["4_alternative"];

    $database->query("INSERT INTO `course_test` (`id`, `course_id`, `question`, `1_alternative`, `2_alternative`, `3_alternative`, `4_alternative`, `correct_alternative`) VALUES (NULL, '$course', '$question', '$first', '$second', '$third', '$forth', '$correct')");
    $_SESSION["message-user"] = "0;Pergunta criada com sucesso!";
    header("Location: ../admin/");
}