<?php


$dir = realpath(__DIR__ . '/..');
require_once $dir.'/config.inc.php';

class Course{

    private $id;
    private $name;
    private $slides;
    private $company;
    private $inicial_slide;
    private $inicial_audio;
    private $end_slide;
    private $end_audio;

    function __construct($id){
        global $database;

        $field = $database->getFieldValue("SELECT * FROM `course` WHERE `id`='$id'");
        $this->id = $field["id"];
        $this->name = $field["name"];
        $this->company = $field["company"];
        $this->inicial_slide = $field["inicial_slide"];
        $this->inicial_audio = $field["inicial_audio"];
        $this->end_slide = $field["end_slide"];
        $this->end_audio = $field["end_audio"];
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
    function getCompany(){
        return $this->company;
    }
    function getInicialSlideName(){
        return $this->inicial_slide;
    }
    function getEndlSlideName(){
        return $this->end_slide;
    }
    function getInicialAudioName(){
        return $this->inicial_audio;
    }
    function getEndAudioName(){
        return $this->end_audio;
    }
}