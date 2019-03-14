<?php

require_once '../config.inc.php';

global $database;

if(isset($_POST["action"])){
    $question = $_POST["question_id"];
    $title = $_POST["question"];
    $correct = $_POST["correct_alternative"];
    $first = $_POST["1_alternative"];
    $second = $_POST["2_alternative"];
    $third = $_POST["3_alternative"];
    $fourth = $_POST["4_alternative"];

    if($_POST["action"] == "Remover"){
        $database->query("DELETE FROM `course_test` WHERE `id`='$question'");
        $database->query("DELETE FROM `user_exam` WHERE `question_id`='$question'");
        $_SESSION["message-user"] = "0;Pergunta deletada com sucesso!";
        header("Location: ../admin/");
    }else{
        $database->query("UPDATE `course_test` SET `question`='$title',`1_alternative`='$first',`2_alternative`='$second',`3_alternative`='$third',`4_alternative`='$fourth',`correct_alternative`='$correct' WHERE `id`='$question'");
        $_SESSION["message-user"] = "0;Pergunta alterada com sucesso!";
        header("Location: ../admin/");
    }
}