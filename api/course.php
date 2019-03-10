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
                    "slides" => array(),
                    "inicial_slide" => $course->getInicialSlide()->getID(),
                    "end_slide" => $course->getEndSlide()->getID(),
                    "questions" => array(),
                ];
                $courseReallyID = $course->getID();
                $slides = $database->getFieldsValues("SELECT `id` FROM `slides` WHERE `course_id`='$courseReallyID' ORDER BY `orders` ASC");
                foreach($slides as $slide){
                    array_push($array["slides"], $slide["id"]);
                }
                $questions = $database->getFieldsValues("SELECT * FROM `course_test` WHERE `course_id`='$courseReallyID'");
                foreach($questions as $question){
                    $questionArray = [
                        "title" => $question["question"],
                        "firstAlternative" => $question["1_alternative"],
                        "secondAlternative" => $question["2_alternative"],
                        "thirdAlternative" => $question["3_alternative"],
                        "fourthAlternative" => $question["4_alternative"],
                        "correct_alternative" => $question["correct_alternative"],
                        "id" => $question["id"]
                    ];
                    array_push($array["questions"], $questionArray);
                }
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
                    "slides" => array(),
                    "company" => $course->getCompany()->getID(),
                    "inicial_slide" => $course->getInicialSlide()->getID(),
                    "end_slide" => $course->getEndSlide()->getID(),
                    "questions" => array(),
                ];
                $courseReallyID = $course->getID();
                $slides = $database->getFieldsValues("SELECT `id` FROM `slides` WHERE `course_id`='$courseReallyID' ORDER BY `orders` ASC");
                foreach($slides as $slide){
                    array_push($result["slides"], $slide["id"]);
                }
                $questions = $database->getFieldsValues("SELECT * FROM `course_test` WHERE `course_id`='$courseReallyID'");
                foreach($questions as $question){
                    $questionArray = [
                        "title" => $question["question"],
                        "firstAlternative" => $question["1_alternative"],
                        "secondAlternative" => $question["2_alternative"],
                        "thirdAlternative" => $question["3_alternative"],
                        "fourthAlternative" => $question["4_alternative"],
                        "correct_alternative" => $question["correct_alternative"],
                        "id" => $question["id"]
                    ];
                    array_push($result["questions"], $questionArray);
                }
            $json = json_encode($result, JSON_UNESCAPED_UNICODE);
            echo $json;
        }
    }