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
        $this->course = new Course($field["course_id"]);
        $this->title = $field["title"];
        $this->slide_image = $field["slide_image"];
        $this->slide_audio = $field["slide_audio"];
        $this->order = $field["orders"];
    }
}