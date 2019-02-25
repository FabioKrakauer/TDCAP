<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    $dir = realpath(__DIR__ . '/..');
    require_once $dir.'/config.inc.php';
    require_once APP_ROOT . '/classes/Course.class.php';

    if(isset($_GET["course"])){
        global $database;
        $id = $_GET["course"];
        if($id == 0){
            $fields = $database->getFieldsValues("SELECT `id` FROM `course`");
            $result = [];
            foreach($fields as $courseID){
                $course = new Course($courseID["id"]);
                $array = [
                    "id" => $course->getID(),
                    "name" => $course->getName(),
                    "company" => $course->getCompany()->getID(),
                    "inicial_slide" => $course->getInicialSlide()->getID(),
                    "end_slide" => $course->getEndSlide()->getID(),
                ];
                array_push($result, $array);
            }
                $json = json_encode($result, JSON_UNESCAPED_UNICODE);
                header('Content-Type: application/json');
                echo $json;
            }else{
                $field = $database->getFieldValue("SELECT `id` FROM `course` WHERE `id`='$id'");
                $course = new Course($field["id"]);
                $result = [
                    "id" => $course->getID(),
                    "name" => $course->getName(),
                    "company" => $course->getCompany()->getID(),
                    "inicial_slide" => $course->getInicialSlide()->getID(),
                    "end_slide" => $course->getEndSlide()->getID(),
                ];
                
            $json = json_encode($result, JSON_UNESCAPED_UNICODE);
            echo $json;
        }
    }