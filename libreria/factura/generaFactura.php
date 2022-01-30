<?php

//print_r($_REQUEST);
//exit;
//echo base64_encode('2');
//exit;
session_start();
if (empty($_SESSION['active'])) {
	header('location: ../');
}

// include "../../conexion.php";
include "../../modelo/ConeccionBD.php";
require_once '../pdf/vendor/autoload.php';

use Dompdf\Dompdf;

if (empty($_REQUEST['cl']) || empty($_REQUEST['f'])) {
	echo "No es posible generar la factura.";
} else {
	$codCliente = $_REQUEST['cl'];
	$noFactura = $_REQUEST['f'];
	$anulada = '';

	$query_info  = mysqli_query($cn, "SELECT * FROM informacion");
	$respuesta_info  = mysqli_num_rows($query_info);
	if ($respuesta_info > 0) {
		$informacion = mysqli_fetch_assoc($query_info);
	}


	// $query = mysqli_query($conection, "SELECT f.nofactura, DATE_FORMAT(f.fecha, '%d/%m/%Y') as fecha, DATE_FORMAT(f.fecha,'%H:%i:%s') as  hora, f.codcliente, f.estatus,
	// 											 v.nombre as vendedor,
	// 											 cl.nit, cl.nombre, cl.telefono,cl.direccion
	// 										FROM factura f
	// 										INNER JOIN usuario v
	// 										ON f.usuario = v.idusuario
	// 										INNER JOIN cliente cl
	// 										ON f.codcliente = cl.idcliente
	// 										WHERE f.nofactura = $noFactura AND f.codcliente = $codCliente  AND f.estatus != 10 ");

	$query = mysqli_query($cn, "SELECT f.id_factura, DATE_FORMAT(f.fecha, '%d/%m/%Y') as fecha, DATE_FORMAT(f.fecha,'%H:%i:%s') as  hora, f.id_cliente, f.estatus,
												 CONCAT(v.Nombres, ' ', v.Apellidos) as vendedor,
												 cl.cedula, cl.nombre, cl.telefono,cl.direccion
											FROM factura f
											INNER JOIN administrador v
											ON f.id_admin = v.idAdministrador
											INNER JOIN cliente_venta cl
											ON f.id_cliente = cl.id_cliente
											WHERE f.id_factura = $noFactura AND f.id_cliente = $codCliente  AND f.estatus != 10 ");

	$result = mysqli_num_rows($query);
	if ($result > 0) {

		$factura = mysqli_fetch_assoc($query);
		$no_factura = $factura['id_factura'];

		if ($factura['estatus'] == 2) {
			$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
		}

		// $query_productos = mysqli_query($conection, "SELECT p.descripcion,dt.cantidad,dt.precio_venta,(dt.cantidad * dt.precio_venta) as precio_total
		// 												FROM factura f
		// 												INNER JOIN detallefactura dt
		// 												ON f.nofactura = dt.nofactura
		// 												INNER JOIN producto p
		// 												ON dt.codproducto = p.codproducto
		// 												WHERE f.nofactura = $no_factura ");
		$query_productos = mysqli_query($cn, "SELECT p.Nombre,dt.cantidad,dt.precio_total,(dt.cantidad * dt.precio_total) as precio_final
		 												FROM factura f
		 												INNER JOIN detalle_factura dt
		 												ON f.id_factura = dt.id_factura
		 												INNER JOIN producto p
		 												ON dt.id_producto = p.idProducto
														 WHERE f.id_factura = $no_factura");

		$result_detalle = mysqli_num_rows($query_productos);

		ob_start();
		include(dirname('__FILE__') . '/factura.php');
		$html = ob_get_clean();

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();

		$dompdf->loadHtml($html);
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('letter', 'portrait');
		// Render the HTML as PDF
		$dompdf->render();
		// Output the generated PDF to Browser
		$dompdf->stream('factura_' . $noFactura . '.pdf', array('Attachment' => 0));
		exit;
	}
}
