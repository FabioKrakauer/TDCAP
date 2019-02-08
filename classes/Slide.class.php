<?php

$dir = realpath(__DIR__ . '/..');
require_once $dir.'/config.inc.php';
require_once 'Course.class.php';
require_once 'Company.class.php';

class Slide{

    private $id;
    private $course;
    private $title;
    private $slide_image;
    private $slide_audio;
    private $order;

    function __construct($id){
        global $database;

        $field = $database->getFieldValue("SELECT * FROM `slides` WHERE `id`='$id'");
        $this->id = $field["id"];
        $this->course = $field["course_id"];
        $this->title = $field["title"];
        $this->slide_image = $field["slide_image"];
        $this->slide_audio = $field["slide_audio"];
        $this->order = $field["orders"];
    }
    function getID(){
        return $this->id;
    }
    function getTitle(){
        return $this->title;
    }
    function getCourse(){
        return new Course($this->course);
    }
    function getSlideImage(){
        return $this->slide_image;
    }
    function getSlideAudio(){
        return $this->slide_audio;
    }
    function getOrder(){
        return $this->order;
    }
    function getPathImage(){
        return APP_URL . "/courses/" . $this->getCourse()->getID() . "/" . $this->getSlideImage();
    }
    function getPathAudio(){
        return APP_URL . "/courses/" . $this->getCourse()->getID() . "/" . $this->getSlideAudio();
    }
}