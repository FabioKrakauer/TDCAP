<?php

function validateImage($type){
    if($type == "png"){
        return true;
    }else if($type == "jpg"){
        return true;
    }else if($type == "jpeg"){
        return true;
    }else{
        return false;
    }
}
function validateAudio($type){
    return $type == "mp3";
}
require_once '../config.inc.php';

global $database;

if(isset($_POST["action"])){
    $uploadFailed = ["slide" => 0, "audio" => 0];
    $courseID = $_POST["course_id"];
    $name = $_POST["name"];
    $order = $_POST["position"];

    $tempName = $_FILES["slide"]["tmp_name"];
    $type = explode("/", $_FILES["slide"]["type"])[1];
    $slideName = $courseID . "_" . $name . ".". $type;
    if(!validateImage($type)){
        $uploadFailed["slide"] = 1;
    }

    $tempName = $_FILES["audio"]["tmp_name"];
    $type = explode("/", $_FILES["audio"]["type"])[1];
    $audioName = $courseID . "_" . $name . ".". $type;
    if(!validateAudio($type)){
        $uploadFailed["audio"] = 1;
    }

    if($uploadFailed["slide"] == 1){
        $_SESSION["message-user"] = "2;O slide não pode ser neste formato! Ele deve ser em PNG, JPG, JPEG";
        header("Location: ../admin/");
        die();
    }else if($uploadFailed["audio"] == 1){
        $_SESSION["message-user"] = "2;O audio não pode ser neste formato! Ele deve ser em MP3";
        header("Location: ../admin/");
        die();
    }
    $id = $database->insertGetLastID("INSERT INTO `slides` (`id`, `course_id`, `title`, `slide_image`, `slide_audio`, `orders`) VALUES (NULL, '$courseID', '$name', '$slideName', '$audioName', '$order')");
    move_uploaded_file($_FILES["slide"]["tmp_name"], "../courses/$courseID/$slideName");
    move_uploaded_file($_FILES["audio"]["tmp_name"], "../courses/$courseID/$audioName");

    $_SESSION["message-user"] = "0;Slide adicionado com sucesso!";
    header("Location: ../admin/");
}