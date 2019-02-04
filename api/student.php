<?php

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
                $result[$row["id"]] = [
                    "id" => $user->getID(),
                    "name" => utf8_encode($user->getName()),
                    "email" => utf8_encode($user->getEmail()),
                    "course" => array(),
                    "company" => $user->getCompany()->getID(),
                    "first_access" => $user->getFirstAccess(),
                ];
                foreach($user->getCourses() as $course){
                    $id = $course->getID();
                    array_push($result[$row["id"]]["course"], $id);
                }
            
            }
            $json = json_encode($result, JSON_PRETTY_PRINT);
            header('Content-Type: application/json');
            echo $json;
        }else{
            $field = $database->getFieldValue("SELECT `id` FROM `user` WHERE `id`='$id'");
            $user = new User($field["id"]);
                $result = [
                    "id" => $user->getID(),
                    "name" => utf8_encode($user->getName()),
                    "email" => utf8_encode($user->getEmail()),
                    "course" => array(),
                    "company" => $user->getCompany(),
                    "first_access" => $user->getFirstAccess(),
                ];
                foreach($user->getCourses() as $course){
                    $id = $course->getID();
                    array_push($result["course"], $id);
                }
                
            $json = json_encode($result, JSON_PRETTY_PRINT);
            header('Content-Type: application/json');
            echo $json;
        }

    }

