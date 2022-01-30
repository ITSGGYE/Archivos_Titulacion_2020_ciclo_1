<?php
    require('../libreria/reporte/fpdf.php');

    class PDF extends FPDF
    {
    // Cabecera de página
    function Header()
    {
    
        // Arial bold 15
        $this->SetFont('Arial','B',10);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30,10,'Reporte De Mercaderia',0,0,'C');
        // Salto de línea
        $this->Ln(20);
        //cabeceras extras
        $this->Cell(30,50,'Fecha Entrada',1,0,'C', 0);
        $this->Cell(30,50,'Detalle',1,0,'C', 0);     
        $this->Cell(70,50,'Descripcion',1,0,'C', 0);             
        $this->Cell(30,50,'Cantidad',1,0,'C', 0);
        $this->Cell(30,50,'Total',1,1,'C', 0);
        
      
        
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
    
    
    require_once '../modelo/EntradaProductoM.php';
    $entradaProductoM = new EntradaProductoM;
    $reporte_entradaProductos = $entradaProductoM->obtener_todos_productoEntrada_assoc();

    foreach( $reporte_entradaProductos as $registro ){
        $pdf->Cell(30, -60, $registro['FechaEntrada'], 0, 0, 'C', 0);  
        $pdf->Cell(30, -60,  $registro['Detalle'], 0, 0, 'C', 0);  
        $pdf->Cell(70, -60,  $registro['Nombre'], 0, 0, 'C', 0);          
        $pdf->Cell(30, -60,  $registro['Cantidad'], 0, 0, 'C', 0);  
        $pdf->Cell(30, -60,  $registro['Total'], 0, 1, 'C', 0);  
        
        $pdf->Ln(1000);
 
    }
   

    $pdf->Output();

?>