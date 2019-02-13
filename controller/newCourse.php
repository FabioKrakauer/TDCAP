<?php

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

    //create courseDirectory
    mkdir("../courses/" . $courseID);

    // UPLOAD INICIAL SLIDE
    $inicialSlideName = str_replace(" ", "_", $inicialSlideNameTitle);

    $tempName = $_FILES["inicial_slide"]["tmp_name"];
    $type = explode("/", $_FILES["inicial_slide"]["type"])[1];
    $slideName = $courseID . "_" . $inicialSlideName . ".". $type;
    move_uploaded_file($_FILES["inicial_slide"]["tmp_name"], "../courses/$courseID/$slideName");

    $tempName = $_FILES["inicial_audio"]["tmp_name"];
    $type = explode("/", $_FILES["inicial_audio"]["type"])[1];
    $audioName = $courseID . "_" . $inicialSlideName . ".". $type;
    move_uploaded_file($_FILES["inicial_audio"]["tmp_name"], "../courses/$courseID/$audioName");

    $apresentationID = $database->insertGetLastID("INSERT INTO `slides` (`id`, `course_id`, `title`, `slide_image`, `slide_audio`, `orders`) VALUES (NULL, '$courseID', '$inicialSlideNameTitle', '$slideName', '$audioName', '0')");
    
    // UPLOAD END SLIDE
    $endSlideName = str_replace(" ", "_", $endSlideNameTitle);

    $tempName = $_FILES["end_slide"]["tmp_name"];
    $type = explode("/", $_FILES["end_slide"]["type"])[1];
    $slideName = $courseID . "_" . $endSlideName . ".". $type;
    move_uploaded_file($_FILES["end_slide"]["tmp_name"], "../courses/$courseID/$slideName");

    $tempName = $_FILES["end_slide"]["tmp_name"];
    $type = explode("/", $_FILES["end_audio"]["type"])[1];
    $audioName = $courseID . "_" . $endSlideName . ".". $type;
    move_uploaded_file($_FILES["end_audio"]["tmp_name"], "../courses/$courseID/$audioName");

    $conclusionID = $database->insertGetLastID("INSERT INTO `slides` (`id`, `course_id`, `title`, `slide_image`, `slide_audio`, `orders`) VALUES (NULL, '$courseID', '$endSlideNameTitle', '$slideName', '$audioName', '1001')");
    $updateCourse = $database->query("UPDATE `course` SET `inicial_slide`='$apresentationID',`end_slide`='$conclusionID' WHERE `id`='$courseID'");
    echo "Você criou o curso #$courseID ( $courseName ) com sucesso!";

}


