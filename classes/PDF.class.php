<?php
    require_once 'fpdf.php';
    
    class PDF extends FPDF{
        
        public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4'){
            parent::__construct($orientation, $unit, $size);
            $this->SetMargins(0, 0, 0);  
            
        }
        function Header(){
            $this->SetFont("Arial", "I", "10");
            $this->SetFillColor("25", "70", "132");
            $this->SetFont("Arial", "B", "10");
            $this->SetTextColor("255", "255", "255");
            $this->Cell(210, 30, utf8_decode("Transformando Conhecimento em Ação e Ação em Resultados"), 0, 1, "R", true);
            $this->Image(APP_ROOT."/img/logo.gif", 10, 5, 40, 20);
            $this->ln(15);
        }
        function Footer(){
            $this->SetMargins(10, 10, 10);  
            $this->SetY(-19);
            $this->SetFont("Arial", "BI", "10");
            $this->SetTextColor(165, 165, 165);
            $this->Cell(190, 20, utf8_decode("Pagina " . $this->PageNo()), 0, 0, "C", false);
        }
    }
    