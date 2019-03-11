<?php
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
    require_once '../config.inc.php';
    require_once '../classes/Slide.class.php';

    global $database;

    if(isset($_POST["action"])){
        $slide = new Slide($_POST["slide_id"]);
        $newOrder = $_POST["slide_order"];
        $slideID = $slide->getID();
        if($_POST["action"] == "Salvar"){
            $database->query("UPDATE `slides` SET `orders`='$newOrder' WHERE `id`='$slideID'");
            $_SESSION["message-user"] = "0;Você editou o slide com sucesso!";
            header("Location: ../admin/");
        }else{
            delete_files("../courses/" . $_POST["course_id"] . "/" . $slide->getSlideAudio());
            delete_files("../courses/" . $_POST["course_id"] . "/" . $slide->getSlideImage());
            $database->query("DELETE FROM `slides` WHERE `id`='$slideID'");
            $_SESSION["message-user"] = "0;Slide removido com sucesso!";
            header("Location: ../admin/");
        }
    }
?>