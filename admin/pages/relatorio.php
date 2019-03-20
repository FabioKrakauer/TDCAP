<?php

require_once '../../config.inc.php';
require_once APP_ROOT . "/classes/PDF.class.php";
require_once APP_ROOT . "/classes/Auth.class.php";
require_once APP_ROOT . "/classes/Course.class.php";
require_once APP_ROOT . "/classes/Question.class.php";
require_once APP_ROOT . "/classes/User.class.php";

if(isset($_POST["user_id"]) && isset($_POST["course_id"])){
    global $database;

    $user = new User($_POST["user_id"]);
    $course = new Course($_POST["course_id"]);
    $userID = $user->getID();
    $courseID = $course->getID();
    $examResult = $database->getFieldValue("SELECT * FROM `user_exam_result` WHERE `user_id`='$userID' AND `course_id`='$courseID'");
    
    $time = $examResult["time"];
    $time = $time / 60;
    $time = number_format($time, 2, ",", ".");
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true);
    $pdf->setCellMargin(10);
    $pdf->AliasNbPages();
    $pdf->SetFont("Arial", "", "10");
    $pdf->SetDrawColor("25", "70", "132");
    $pdf->Cell(105, 8, utf8_decode("Aluno: " . $user->getName()), 1, "", false);
    $pdf->Cell(105, 8, utf8_decode("Curso: " .$course->getName()), 1, 1);
    $pdf->Cell(70, 8, utf8_decode("Tempo de prova: " . $time . " minutos"), 1, "", false);
    $pdf->Cell(70, 8, utf8_decode("Nota final: " .$examResult["result"] . "%"), 1, 0);
    $pdf->Cell(70, 8, utf8_decode("Dia da prova: " .date("d/m/Y", strtotime($examResult["at"]))), 1, 1);
    $pdf->ln(4);
    $pdf->SetFont("Arial", "B", 14);
    $pdf->Cell(210, 10, utf8_decode("Relatório final!"), 0, 1, "C");
    
    $questions = $database->getFieldsValues("SELECT `question_id`,`answer` FROM `user_exam` WHERE `user_id`='$userID' AND `course_id`='$courseID'");
    $pdf->ln(2);
    $pdf->Cell(210, 1, "", 1, 1, "C", true);
    $questionsQuantity = 0;
    foreach($questions as $questionID){
        $questionsQuantity++;
        $question = new Question($questionID["question_id"]);
        $pdf->ln(4);
        $pdf->SetFont("Arial", "BI", 12);
        $pdf->MultiCell(210, 8, utf8_decode("Questão ". $questionsQuantity." - " . $question->getQuestion()));
        $pdf->SetFont("Arial", "", 11);
        $pdf->MultiCell(210, 5, utf8_decode("Resposta certa: " . $question->getAlternatives()[$question->getCorrectAlternative()]),0);
        $pdf->MultiCell(210, 5, utf8_decode("Resposta do aluno: " . $question->getAlternatives()[$questionID["answer"]]),0);
        $pdf->SetFont("Arial", "I", 10);
        if($questionID["answer"] == $question->getCorrectAlternative()){
            $pdf->MultiCell(210, 5, utf8_decode("Pontuação: 100"),0);
        }else{
            $pdf->MultiCell(210, 5, utf8_decode("Pontuação: 0"),0);
        }
        $pdf->ln(2);
        $pdf->Cell(210, 1, "", 1, 1, "C", true);
    }
    $pdf->Output();
}else{
    echo "<p>Erro ao indentificar o usuario ou o curso!</p>";    
}
