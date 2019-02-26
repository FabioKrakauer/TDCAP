<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    $dir = realpath(__DIR__ . '/..');
    require_once $dir.'/config.inc.php';
    require_once APP_ROOT . '/classes/User.class.php';

    if(isset($_GET["student"])){
        $id = $_GET["student"];
        global $database;
        $result = [];
        if($id == 0){
            $field = $database->getFieldsValues("SELECT `id` FROM `user`");
            foreach($field as $row){
                $user = new User($row["id"]);
                $userID = $row["id"];
                $array = [
                    "id" => $user->getID(),
                    "name" => $user->getName(),
                    "email" => $user->getEmail(),
                    "course" => array(),
                    "company" => $user->getCompany()->getID(),
                    "completed_courses" => array(),
                    "first_access" => $user->getFirstAccess(),
                ];
                foreach($user->getCourses() as $course){
                    $id = $course->getID();
                    array_push($array["course"], $id);
                }
                $completededCourses = $database->getFieldsValues("SELECT `course_id` FROM `user_exam_result` WHERE `user_id`='$userID'");
                foreach($completededCourses as $completed){
                    array_push($array["completed_courses"], $completed["course_id"]);
                }
                array_push($result, $array);
            
            }
            $json = json_encode($result, JSON_UNESCAPED_UNICODE);
            header('Content-Type: application/json');
            echo $json;
        }else{
            $field = $database->getFieldValue("SELECT `id` FROM `user` WHERE `id`='$id'");
            $user = new User($field["id"]);
            $userID = $field["id"];
                $result = [
                    "id" => $user->getID(),
                    "name" => $user->getName(),
                    "email" => $user->getEmail(),
                    "course" => array(),
                    "completed_courses" => array(),
                    "company" => $user->getCompany()->getID(),
                    "first_access" => $user->getFirstAccess(),
                ];
                foreach($user->getCourses() as $course){
                    $id = $course->getID();
                    array_push($result["course"], $id);
                }
                $completededCourses = $database->getFieldsValues("SELECT `course_id` FROM `user_exam_result` WHERE `user_id`='$userID'");
                foreach($completededCourses as $completed){
                    array_push($result["completed_courses"], $completed["course_id"]);
                }
                
            $json = json_encode($result, JSON_UNESCAPED_UNICODE);
            header('Content-Type: application/json');
            echo $json;
        }

    }

