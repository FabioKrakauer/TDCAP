<?php

require_once '../../config.inc.php';
require_once APP_ROOT . "/classes/PDF.class.php";
require_once APP_ROOT . "/classes/Auth.class.php";

if(isset($_POST["user_id"]) && isset($_POST["course_id"])){
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->AliasNbPages();
    $pdf->Output();
}else{
    echo "<p>Erro ao indentificar o usuario ou o curso!</p>";    
}
