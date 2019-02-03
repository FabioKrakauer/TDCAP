<?php

require_once '../config.inc.php';
require_once APP_ROOT . '/classes/Auth.class.php';

if(isset($_POST["action"])){
    $result = Auth::validate($_POST["email"], md5($_POST["password"]));
    if($result == -1){
        exit(header("Location: ../pages/login.php?error=E-mail ou senha invalidos!"));
    }else{
        exit(header("Location: ../index.php"));
    }
}