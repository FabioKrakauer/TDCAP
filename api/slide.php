<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    $dir = realpath(__DIR__ . '/..');
    require_once $dir.'/config.inc.php';
    require_once APP_ROOT . '/classes/Slide.class.php';

    if(isset($_GET["slide"])){
        global $database;
        $id = $_GET["slide"];
        if($id == 0){
            $slides = $database->getFieldsValues("SELECT `id` FROM `slides`");
            $result = [];
            foreach($slides as $slide){
                $slide = new Slide($slide["id"]);
                $array = [
                    "id" => $slide->getID(),
                    "title" => $slide->getTitle(),
                    "course" => $slide->getCourse()->getID(),
                    "slide" => $slide->getSlideImage(),
                    "audio" => $slide->getSlideAudio(),
                    "order" => $slide->getOrder(),
                ];
                array_push($result, $array);
            }
            $json = json_encode($result, JSON_UNESCAPED_UNICODE);
            header('Content-Type: application/json');
            echo $json;
        }else{
            $field = $database->getFieldValue("SELECT `id` FROM `slides` WHERE `id`='$id'");
            $slide = new Slide($field["id"]);
            $result = [
                "id" => $slide->getID(),
                "title" => $slide->getTitle(),
                "course" => $slide->getCourse()->getID(),
                "slide" => $slide->getSlideImage(),
                "audio" => $slide->getSlideAudio(),
                "order" => $slide->getOrder()
            ];
            $json = json_encode($result, JSON_UNESCAPED_UNICODE);
            header('Content-Type: application/json');
            echo $json;
        }
    }
?>