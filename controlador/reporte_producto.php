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
        $this->Cell(30,10,'Reporte De Productos',0,0,'C');
        // Salto de línea
        $this->Ln(20);
        //cabeceras extras
        $this->Cell(19,10,'Codigo',1,0,'C', 0);
        $this->Cell(45,10,'Nombre',1,0,'C', 0);
        $this->Cell(30,10,'Marca',1,0,'C', 0);
        $this->Cell(25,10,'Precio',1,0,'C', 0);
        $this->Cell(12,10,'Stock',1,0,'C', 0);
        $this->Cell(30,10,'Fecha Entrada',1,0,'C', 0);
        $this->Cell(30,10,'Hora Entrada',1,1,'C', 0);
        
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
    

    require_once '../modelo/ProductoM.php';
    $productoM = new ProductoM;
    $reporte_productos = $productoM->obtener_todos_productos_assoc();

    foreach( $reporte_productos as $registro ){
        $pdf->Cell(19, 8,  'Produc'.$registro['idProducto'], 1, 0, 'C', 0);  
        $pdf->Cell(45, 8,  $registro['Nombre'], 1, 0, 'C', 0);  
        $pdf->Cell(30, 8,  $registro['Marca'], 1, 0, 'C', 0);  
        $pdf->Cell(25, 8,  $registro['Precio'], 1, 0, 'C', 0);  
        $pdf->Cell(12, 8,  $registro['Stock'], 1, 0, 'C', 0);  
        $pdf->Cell(30, 8,  $registro['FechaRegistro'], 1, 0, 'C', 0);        
        $pdf->Cell(30, 8,  $registro['HoraRegistro'], 1, 1, 'C', 0);        
        
 
    }

    $pdf->Output();

?>