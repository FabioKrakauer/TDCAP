<?php

$dir = realpath(__DIR__ . '/..');
require_once $dir.'/config.inc.php';

class User{

    private $id;
    private $name;
    private $email;
    private $password;
    private $company;
    private $courses;
    private $admin;
    private $first_access;

    function __construct($id){
        global $database;

        $fields = $database->getFieldValue("SELECT * FROM `user` WHERE `id`='$id'");
        $this->id = $fields["id"];
        $this->name = $fields["name"];
        $this->email = $fields["email"];
        $this->password = $fields["password"];
        $this->company = $fields["company"];
        $this->admin = $fields["admin"];
        $this->first_access = $fields["first_access"];
        
    }

    function getID(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getEmail(){
        return $this->email;
    }
    function getCompany(){
        return $this->company;
    }
    function isAdmin(){
        return $this->admin == 1;
    }
    function getFirstAccess(){
        return $this->first_access;
    }
}