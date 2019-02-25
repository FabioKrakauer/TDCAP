<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
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
                $array = [
                    "id" => $company->getID(),
                    "name" => $company->getName(),
                    "CNPJ" => $company->getCNPJ(),
                    "adress" => $company->getAdress(),
                    "phone" => $company->getPhone(),
                    "website" => $company->getWebsite(),
                    "contact" => $company->getContact(),
                    "email" => $company->getEmail()
                ];
                array_push($result, $array);
            }
            $json = json_encode($result, JSON_UNESCAPED_UNICODE);
            header('Content-Type: application/json');
            echo $json;
        }else{
            $field = $database->getFieldValue("SELECT `id` FROM `company` WHERE `id`='$id'");
            $company = new Company($field["id"]);
                $result = [
                    "id" => $company->getID(),
                    "name" => $company->getName(),
                    "CNPJ" => $company->getCNPJ(),
                    "adress" => $company->getAdress(),
                    "phone" => $company->getPhone(),
                    "website" => $company->getWebsite(),
                    "contact" => $company->getContact(),
                    "email" => $company->getEmail()
                ];
                
            $json = json_encode($result, JSON_UNESCAPED_UNICODE);
            header('Content-Type: application/json');
            echo $json;
        }
    }
