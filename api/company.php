<?php

    $dir = realpath(__DIR__ . '/..');
    require_once $dir.'/config.inc.php';
    require_once APP_ROOT . '/classes/Company.class.php';

    if(isset($_GET["company"])){
        global $database;
        $id = $_GET["company"];
        if($id == 0){
            $fields = $database->getFieldsValues("SELECT `id` FROM `company`");
            $result = [];
            foreach($fields as $companyID){
                $company = new Company($companyID["id"]);
                $result[$company->getID()] = [
                    "id" => $company->getID(),
                    "name" => utf8_encode($company->getName()),
                    "CNPJ" => $company->getCNPJ(),
                    "adress" => $company->getAdress(),
                    "phone" => $company->getPhone(),
                    "website" => utf8_encode($company->getWebsite()),
                    "contact" => $company->getContact(),
                    "email" => $company->getEmail()
                ];
            }
            $json = json_encode($result, JSON_PRETTY_PRINT);
            header('Content-Type: application/json');
            echo $json;
        }else{
            $field = $database->getFieldValue("SELECT `id` FROM `company` WHERE `id`='$id'");
            $company = new Company($field["id"]);
                $result = [
                    "id" => $company->getID(),
                    "name" => utf8_encode($company->getName()),
                    "CNPJ" => $company->getCNPJ(),
                    "adress" => $company->getAdress(),
                    "phone" => $company->getPhone(),
                    "website" => utf8_encode($company->getWebsite()),
                    "contact" => $company->getContact(),
                    "email" => $company->getEmail()
                ];
                
            $json = json_encode($result, JSON_PRETTY_PRINT);
            header('Content-Type: application/json');
            echo $json;
        }
    }
