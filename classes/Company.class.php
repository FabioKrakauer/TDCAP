<?php

$dir = realpath(__DIR__ . '/..');
require_once $dir.'/config.inc.php';

class Company{

    private $id;
    private $name;
    private $cnpj;
    private $adress;
    private $phone;
    private $website;
    private $contact;
    private $email;

    function __construct($id){
        global $database;
        $field = $database->getFieldValue("SELECT * FROM `company` WHERE `id`='$id'");

        $this->id = $field["id"];
        $this->name = $field["name"];
        $this->cnpj = $field["cnpj"];
        $this->adress = $field["adress"];
        $this->phone = $field["phone"];
        $this->website = $field["website"];
        $this->contact = $field["contact"];
        $this->email = $field["email"];
    }
    function getID(){
        return $this->id;
    }
    function getName(){
        if($this->name == null){
            return "Empresa não encontrada!";
        }
        return $this->name;
    }
    function getCNPJ(){
        return $this->cnpj;
    }
    function getAdress(){
        return $this->adress;
    }
    function getPhone(){
        return $this->phone;
    }
    function getWebsite(){
        return $this->website;
    }
    function getContact(){
        return $this->contact;
    }
    function getEmail(){
        return $this->email;
    }
}