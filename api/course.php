<?php

    header("Access-Control-Allow-Origin: *");
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
                    "inicial_slide" => $course->getInicialSlideName(),
                    "end_slide" => $course->getEndlSlideName(),
                ];
                array_push($result, $array);
            }
                $json = json_encode($result, JSON_PRETTY_PRINT);
                header('Content-Type: application/json');
                echo $json;
            }else{
                $field = $database->getFieldValue("SELECT `id` FROM `course` WHERE `id`='$id'");
                $course = new Course($field["id"]);
                $result = [
                    "id" => $course->getID(),
                    "name" => $course->getName(),
                    "company" => $course->getCompany()->getID(),
                    "inicial_slide" => $course->getInicialSlideName(),
                    "end_slide" => $course->getEndlSlideName(),
                ];
                
            $json = json_encode($result, JSON_PRETTY_PRINT);
            header('Content-Type: application/json');
            echo $json;
        }
    }