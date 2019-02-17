<?php

require_once '../config.inc.php';
require_once APP_ROOT . "/classes/Question.class.php";
require_once APP_ROOT . "/classes/Auth.class.php";

global $database;

$totalQuestion = 0;
$correctAnswers = 0;
$user = Auth::user();

$course = new Course($_POST["courseID"]);
$courseID = $course->getID();

foreach($_POST as $questionID=>$answer){
    if($questionID != "action" && $questionID != "courseID" && $questionID != "time"){
        $totalQuestion++;
        $question = new Question($questionID);
        if($question->getCorrectAlternative() == $answer){
            $correctAnswers++;
        }
        $database->query("INSERT INTO `user_exam` (`id`, `user_id`, `question_id`, `course_id`, `answer`) VALUES (NULL, '".$user->getID()."', '".$question->getID()."', '$courseID', '$answer')");
    }
}
$result = $correctAnswers * 100;
if($result == 0){
    $result = 0;
}else{
    $result /= $totalQuestion;
}
$time = $_POST["time"];
$at = date("Y-m-d");
$database->query("INSERT INTO `user_exam_result` (`id`, `user_id`, `course_id`, `result`, `time`, `at`) VALUES (NULL, '".$user->getID()."', '$courseID', '$result', '$time', '$at')");
header("Location: http://" . APP_URL . "/pages/course.php?course=$courseID&slide=".$course->getInicialSlide()->getID());