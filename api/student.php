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
                    "inProgressCourses" => array(),
                    "notViewed" => array(),
                    "disabledCourses" => array(),
                    "first_access" => $user->getFirstAccess(),
                ];
                $userID = $user->getID();
                $coursesNotDisabled = $database->getFieldsValues("SELECT `course_id` FROM `user_course` WHERE `disabled`='0' AND `user_id` = '$userID'");
                foreach($coursesNotDisabled as $course){
                    if($user->getCourseProgress($id) == 0){
                        $array["notViewed"][$id] = $user->getCourseProgress($id);
                    }else{
                        $completed = $database->getFieldValue("SELECT `course_id`, `result` FROM `user_exam_result` WHERE `user_id`='$userID' AND `course_id` = '$id'");
                        if($completed == null){
                            $array["inProgressCourses"][$id] = $user->getCourseProgress($id);
                        }
                    }
                }
                foreach($user->getCourses() as $course){
                    array_push($array["course"], $course->getID());
                }
                $completededCourses = $database->getFieldsValues("SELECT `course_id`, `result` FROM `user_exam_result` WHERE `user_id`='$userID'");
                foreach($completededCourses as $completed){
                    $array["completed_courses"][$completed["course_id"]] = $completed["result"];
                }
                $disabledCourses = $database->getFieldsValues("SELECT `course_id` FROM `user_course` WHERE `user_id` = '$userID' AND `disabled`='1'");
                foreach($disabledCourses as $course){
                    array_push($array["disabledCourses"], $course["course_id"]);
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
                    "inProgressCourses" => array(),
                    "notViewed" => array(),
                    "disabledCourses" => array(),
                    "company" => $user->getCompany()->getID(),
                    "first_access" => $user->getFirstAccess(),
                ];
                $coursesNotDisabled = $database->getFieldsValues("SELECT `course_id` FROM `user_course` WHERE `disabled`='0' AND `user_id` = '$userID'");
                foreach($coursesNotDisabled as $course){
                    $id = $course["course_id"];
                    if($user->getCourseProgress($id) == 0){
                        $result["notViewed"][$id] = $user->getCourseProgress($id);
                    }else{
                        $completed = $database->getFieldValue("SELECT `course_id`, `result` FROM `user_exam_result` WHERE `user_id`='$userID' AND `course_id` = '$id'");
                        if($completed == null){
                            $result["inProgressCourses"][$id] = $user->getCourseProgress($id);
                        }
                    }
                }
                foreach($user->getCourses() as $course){
                    array_push($result["course"], $course->getID());
                }
                $disabledCourses = $database->getFieldsValues("SELECT `course_id` FROM `user_course` WHERE `user_id` = '$userID' AND `disabled`='1'");
                foreach($disabledCourses as $course){
                    array_push($result["disabledCourses"], $course["course_id"]);
                }
                $completededCourses = $database->getFieldsValues("SELECT `course_id`, `result` FROM `user_exam_result` WHERE `user_id`='$userID'");
                foreach($completededCourses as $completed){
                    $result["completed_courses"][$completed["course_id"]] = $completed["result"];
                }
                
            $json = json_encode($result, JSON_UNESCAPED_UNICODE);
            header('Content-Type: application/json');
            echo $json;
        }

    }

