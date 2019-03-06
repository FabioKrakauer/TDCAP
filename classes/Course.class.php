<?php


$dir = realpath(__DIR__ . '/..');
require_once $dir.'/config.inc.php';
require_once 'Company.class.php';
require_once 'Question.class.php';
require_once 'Slide.class.php';

class Course{

    private $id;
    private $name;
    private $slides;
    private $company;
    private $inicial_slide;
    private $inicial_audio;
    private $end_slide;
    private $end_audio;
    private $questions;

    function __construct($id){
        global $database;

        $field = $database->getFieldValue("SELECT * FROM `course` WHERE `id`='$id'");
        $this->id = $field["id"];
        $this->name = $field["name"];
        $this->slides = [];
        $this->questions = [];
        $this->company = new Company($field["company"]);
        $this->inicial_slide = $field["inicial_slide"];
        $this->end_slide = $field["end_slide"];

        $slidesFields = $database->getFieldsValues("SELECT `id` FROM `slides` WHERE `course_id`='$this->id'");

        foreach($slidesFields as $slides){
            array_push($this->slides, new Slide($slides["id"]));
        }
        
        $questions = $database->getFieldsValues("SELECT `id` FROM `course_test` WHERE `course_id`='$this->id'");
        foreach($questions as $question){
            array_push($this->questions, new Question($question["id"]));
        }
    }
    function getID(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getSlides(){
        return $this->slides;
    }
    function getQuestions(){
        return $this->questions;
    }
    function getCompany(){
        return $this->company;
    }
    function getInicialSlide(){
        return new Slide($this->inicial_slide);
    }
    function getEndSlide(){
        return new Slide($this->end_slide);
    }
}