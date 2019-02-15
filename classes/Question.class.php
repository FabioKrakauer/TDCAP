<?php

$dir = realpath(__DIR__ . '/..');
require_once $dir.'/config.inc.php';
require_once 'Course.class.php';

class Question{

    private $id;
    private $course;
    private $question;
    private $alternatives;
    private $correctAlternative;

    function __construct($id){

        global $database;

        $fields = $database->getFieldValue("SELECT * FROM `course_test` WHERE `course_id`='$id'");
        $this->id = $fields["id"];
        $this->course = $fields["course_id"];
        $this->question = $fields["question"];
        $this->alternatives = ["1" => $fields["1_alternative"], "2" => $fields["2_alternative"], "3" => $fields["3_alternative"], "4" => $fields["4_alternative"]];
        $this->correctAlternative = $fields["correct_alternative"];

    }
    function getID(){
        return $this->id;
    }
    function getCourse(){
        return new Course($this->course);
    }
    function getQuestion(){
        return $this->question;
    }
    function getAlternatives(){
        return $this->alternatives;
    }
    function getCorrectAlternative(){
        return $this->correctAlternative;
    }
}