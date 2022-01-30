<?php
    require('../libreria/reporte/fpdf.php');

    class PDF extends FPDF
    {
    // Cabecera de página
    function Header()
    {
    
        // Arial bold 15
        $this->SetFont('Arial','B',11);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30,10,'Reporte De Ventas',0,0,'C');
        // Salto de línea
        $this->Ln(20);
        //cabeceras extras
                
        $this->Cell(35,20,'Fecha',1,0,'C', 0);
        $this->Cell(30,20,'Detalle',1,0,'C', 0);
        $this->Cell(40,20,'Nombre',1,0,'C', 0);
        $this->Cell(30,20,'Precio',1,0,'C', 0);
        $this->Cell(30,20,'Cantidad',1,0,'C', 0);
        $this->Cell(30,20,'Total',1,1,'C', 0);
        
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',9);    
    

    require_once '../modelo/ProductoSalidaM.php';
    $productoSalidaM = new ProductoSalidaM;
    $reporte_productosSalida = $productoSalidaM->obtener_todos_productoSalida_assoc();

    foreach( $reporte_productosSalida as $registro ){        
        $pdf->Cell(35, -10,  $registro['FechaSalida'], 0, 0, 'C', 0);  
        $pdf->Cell(30, -10,  $registro['Detalle'], 0, 0, 'C', 0);  
        $pdf->Cell(40, -10,  $registro['Nombre'], 0, 0, 'C', 0);  
        $pdf->Cell(30, -10,  $registro['Precio'], 0, 0, 'C', 0);         
        $pdf->Cell(30, -10,  $registro['Cantidad'], 0, 0, 'C', 0);         
        $pdf->Cell(30, -10,  $registro['Total'], 0, 1, 'C', 0);        
        $pdf->Ln(1000);
    }

    $pdf->Output();

?>