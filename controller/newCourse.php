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
require_once APP_ROOT . "/classes/User.class.php";
require_once APP_ROOT . "/classes/Course.class.php";
require_once APP_ROOT . "/classes/Auth.class.php";

global $database;

if(isset($_POST["action"])){
    //get fields from form
    $courseName = $_POST["name"];
    $company = $_POST["company"];
    $inicialSlideNameTitle = $_POST["inicial_name"];
    $endSlideNameTitle = $_POST["end_name"];

    //insert in database
    $courseID = $database->insertGetLastID("INSERT INTO `course` (`id`, `name`, `company`, `inicial_slide`, `end_slide`) VALUES (NULL, '$courseName', '$company', '0', '0')");


    $uploadFailed["inicialSlide"] = 0;
    $uploadFailed["inicialAudio"] = 0;
    $uploadFailed["endSlide"] = 0;
    $uploadFailed["endAudio"] = 0;

    $inicialSlideName = str_replace(" ", "_", $inicialSlideNameTitle);

    $tempName = $_FILES["inicial_slide"]["tmp_name"];
    $type = explode("/", $_FILES["inicial_slide"]["type"])[1];
    $apresentationSlideName = $courseID . "_" . $inicialSlideName . ".". $type;
    if(!validateImage($type)){
        $uploadFailed["inicialSlide"] = 1;
    }

    $tempName = $_FILES["inicial_audio"]["tmp_name"];
    $type = explode("/", $_FILES["inicial_audio"]["type"])[1];
    $apresentationAudioName = $courseID . "_" . $inicialSlideName . ".". $type;
    if(!validateAudio($type)){
        $uploadFailed["inicialAudio"] = 1;
    }
    
    $endSlideName = str_replace(" ", "_", $endSlideNameTitle);

    $tempName = $_FILES["end_slide"]["tmp_name"];
    $type = explode("/", $_FILES["end_slide"]["type"])[1];
    $conclusionSlideName = $courseID . "_" . $endSlideName . ".". $type;
    if(!validateImage($type)){
        $uploadFailed["endSlide"] = 1;
    }

    $tempName = $_FILES["end_slide"]["tmp_name"];
    $type = explode("/", $_FILES["end_audio"]["type"])[1];
    $conclusionAudioName = $courseID . "_" . $endSlideName . ".". $type;
    if(!validateAudio($type)){
        $uploadFailed["endAudio"] = 1;
    }

    if($uploadFailed["inicialSlide"] == 1){
        $_SESSION["message-user"] = "2;Erro: O slide INICIAL não pode ser neste formato! Ele deve ser em PNG, JPG, JPEG";
        header("Location: ../admin/");
        $database->query("DELETE FROM `course` WHERE `id`='$courseID'");
        die();
    }else if($uploadFailed["inicialAudio"] == 1){
        $database->query("DELETE FROM `course` WHERE `id`='$courseID'");
        $_SESSION["message-user"] = "2;O audio INICIAL não pode ser neste formato! Ele deve ser em MP3";
        header("Location: ../admin/");
        die();
    }else if($uploadFailed["endSlide"] == 1){
        $database->query("DELETE FROM `course` WHERE `id`='$courseID'");
        $_SESSION["message-user"] = "2;Erro: O slide FINAL não pode ser neste formato! Ele deve ser em PNG, JPG, JPEG";
        header("Location: ../admin/");
        die();
    }else if($uploadFailed["endAudio"] == 1){
        $database->query("DELETE FROM `course` WHERE `id`='$courseID'");
        $_SESSION["message-user"] = "2;O audio FINAL não pode ser neste formato! Ele deve ser em MP3";
        header("Location: ../admin/");
        die();
    }else{
        
        //create courseDirectory
        mkdir("../courses/" . $courseID);
        
        //INSERT SLIDES
        $apresentationID = $database->insertGetLastID("INSERT INTO `slides` (`id`, `course_id`, `title`, `slide_image`, `slide_audio`, `orders`) VALUES (NULL, '$courseID', '$inicialSlideNameTitle', '$apresentationSlideName', '$apresentationAudioName', '0')");
        $conclusionID = $database->insertGetLastID("INSERT INTO `slides` (`id`, `course_id`, `title`, `slide_image`, `slide_audio`, `orders`) VALUES (NULL, '$courseID', '$endSlideNameTitle', '$conclusionSlideName', '$conclusionAudioName', '1001')");
    
        //UPDATE COURSE IN DATABASE
        $updateCourse = $database->query("UPDATE `course` SET `inicial_slide`='$apresentationID',`end_slide`='$conclusionID' WHERE `id`='$courseID'");
    
        //UPLOAD FILES
        move_uploaded_file($_FILES["inicial_slide"]["tmp_name"], "../courses/$courseID/$apresentationSlideName");
        move_uploaded_file($_FILES["inicial_audio"]["tmp_name"], "../courses/$courseID/$apresentationAudioName");
        move_uploaded_file($_FILES["end_slide"]["tmp_name"], "../courses/$courseID/$conclusionSlideName");
        move_uploaded_file($_FILES["end_audio"]["tmp_name"], "../courses/$courseID/$conclusionAudioName");

        $_SESSION["message-user"] = "0;Você criou o curso $courseName com sucesso!";
        header("Location: ../admin/");
    }
}


