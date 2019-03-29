<?php

require_once 'config.inc.php';
require_once APP_ROOT . '/classes/Auth.class.php';
Auth::logout();

if(isset($_GET["page"])){
    if($_GET["page"] == 0){
        header("Location: admin/login.php");
        die();
    }else{
        header("Location: pages/login.php");
        die();
    }
}else{
    header("Location: pages/login.php");
    die();
}