<?php

require_once "../../../controladores/pedidos.controlador.php";
require_once "../../../modelos/pedidos.modelo.php";

require_once "../../../controladores/iglesias.controlador.php";
require_once "../../../modelos/iglesias.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DEL PEDIDO

$itemPedido = "codigo";
$valorPedido = $this->codigo;

$respuestaPedido = ControladorPedidos::ctrMostrarPedidos($itemPedido, $valorPedido);

$fecha = substr($respuestaPedido["fecha"],0,-8);
$productos = json_decode($respuestaPedido["productos"], true);
$neto = number_format($respuestaPedido["neto"],2);
$impuesto = number_format($respuestaPedido["impuesto"],2);
$total = number_format($respuestaPedido["total"],2);

//TRAEMOS LA INFORMACIÓN DE LA IGLESIA

$itemIglesia = "id";
$valorIglesia = $respuestaPedido["id_iglesia"];

$respuestaIglesia = ControladorIglesias::ctrMostrarIglesias($itemIglesia, $valorIglesia);

//TRAEMOS LA INFORMACIÓN DE LA SECRETARIA

$itemSecretaria = "id";
$valorSecretaria = $respuestaPedido["id_secretaria"];

$respuestaSecretaria = ControladorUsuarios::ctrMostrarUsuarios($itemSecretaria, $valorSecretaria);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'A7');

//---------------------------------------------------------

$bloque1 = <<<EOF

<table style="font-size:9px; text-align:center">

	<tr>
		
		<td style="width:160px;">
	
			<div>
			
				Fecha: $fecha

				<br><br>
				MATRIZ CUADRANGULAR

				<br>
				Dirección: Capitan Najera y Pio Montufar

				<br>
				Teléfono: 0997938795

				<br>
				Recibo N.$valorPedido

				<br><br>					
				Iglesia: $respuestaIglesia[nombre]

				<br>
				Secretaria: $respuestaSecretaria[nombre]

				<br>

			</div>

		</td>

	</tr>


</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


foreach ($productos as $key => $item) {

$valorUnitario = number_format($item["precio"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque2 = <<<EOF

<table style="font-size:9px;">

	<tr>
	
		<td style="width:160px; text-align:left">
		$item[descripcion] 
		</td>

	</tr>

	<tr>
	
		<td style="width:160px; text-align:right">
		$ $valorUnitario Und * $item[cantidad]  = $ $precioTotal
		<br>
		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque3 = <<<EOF

<table style="font-size:9px; text-align:right">

	<tr>
	
		<td style="width:80px;">
			 NETO: 
		</td>

		<td style="width:80px;">
			$ $neto
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 IMPUESTO: 
		</td>

		<td style="width:80px;">
			$ $impuesto
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			 --------------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 TOTAL: 
		</td>

		<td style="width:80px;">
			$ $total
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			<br>
			<br>
			Muchas gracias por su pedido
		</td>

	</tr>

</table>



EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
ob_end_clean();
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();
?>