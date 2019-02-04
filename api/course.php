<?php

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
                $result[$course->getID()] = [
                    "id" => $course->getID(),
                    "name" => $course->getName(),
                    "company" => $course->getCompany()->getID(),
                    "inicial_slide" => $course->getInicialSlideName(),
                    "inicial_audio" => $course->getInicialAudioName(),
                    "end_slide" => $course->getEndlSlideName(),
                    "end_audio" => $course->getEndAudioName()
                ];
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
                    "inicial_audio" => $course->getInicialAudioName(),
                    "end_slide" => $course->getEndlSlideName(),
                    "end_audio" => $course->getEndAudioName()
                ];
                
            $json = json_encode($result, JSON_PRETTY_PRINT);
            header('Content-Type: application/json');
            echo $json;
        }
    }