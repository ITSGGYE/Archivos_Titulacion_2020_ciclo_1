<?php
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once '../pdf/vendor/autoload.php';
use Dompdf\Dompdf;

// Introducimos HTML de prueba
//$html = '<h1>Hola mundo!</h1>';
 
// Instanciamos un objeto de la clase DOMPDF.
$pdf = new DOMPDF();

$html= file_get_contents("http://localhost/PuntoStock/view/reporteProducto.php");
 
// Definimos el tamaño y orientación del papel que queremos.
$pdf->set_paper("A4", "portrait");
 
// Cargamos el contenido HTML.
$pdf->load_html(utf8_decode($html));
 
// Renderizamos el documento PDF.
$pdf->render();
 
// Enviamos el fichero PDF al navegador.
$pdf->stream('reporte.pdf');