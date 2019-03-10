<?php

require_once '../config.inc.php';

function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK );
        foreach( $files as $file ){
            delete_files( $file );      
        }
        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}

global $database;

if(isset($_POST["action"])){
    $id = $_POST["course_id"];
    $name = $_POST["name"];
    $company = $_POST["company"];
    if($_POST["action"] == "Remover"){
        delete_files("../courses/$id");
        $database->query("DELETE FROM `course` WHERE `id`='$id'");
        $database->query("DELETE FROM `course_test` WHERE `course_id`='$id'");
        $database->query("DELETE FROM `user_exam` WHERE `course_id`='$id'");
        $database->query("DELETE FROM `user_exam_result` WHERE `course_id`='$id'");
        $database->query("DELETE FROM `slides` WHERE `course_id`='$id'");

        $_SESSION["message-user"] = "0;Curso deletado com sucesso!";
        header("Location: ../admin/");
    }else{
        $database->query("UPDATE `course` SET `name`='$name',`company`='$company' WHERE `id`='$id'");
        $_SESSION["message-user"] = "0;Curso modificado com sucesso!";
        header("Location: ../admin/");
    }
}