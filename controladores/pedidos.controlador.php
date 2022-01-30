<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorPedidos{

	/*=============================================
	MOSTRAR PEDIDOS
	=============================================*/

	static public function ctrMostrarPedidos($item, $valor){

		$tabla = "pedidos";

		$respuesta = ModeloPedidos::mdlMostrarPedidos($tabla, $item, $valor);
 
		return $respuesta;

	}

	/*=============================================
	CREAR PEDIDOS
	=============================================*/

	static public function ctrCrearPedido(){

		if(isset($_POST["nuevoPedido"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DE LAS IGLESIAS Y REDUCIR EL STOCK Y AUMENTAR LOS PEDIDOS DE LOS PRODUCTOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

					echo'<script>

				swal({
					  type: "error",
					  title: "El pedido no se ejecuta si no hay productos",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "pedidos";

								}
							})

				</script>';

				return;
			}


			$listaProductos = json_decode($_POST["listaProductos"], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

			   array_push($totalProductosComprados, $value["cantidad"]);
				
			   $tablaProductos = "productos";

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";

			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "pedidos";
				$valor1a = $value["cantidad"] + $traerProducto["pedidos"];

			    $nuevasPedidos = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaIglesias = "iglesias";

			$item = "id";
			$valor = $_POST["seleccionarIglesia"];

			$traerIglesia = ModeloIglesias::mdlMostrarIglesias($tablaIglesias, $item, $valor);

			$item1a = "compras";
				
			$valor1a = array_sum($totalProductosComprados) + $traerIglesia["compras"];

			$comprasIglesia = ModeloIglesias::mdlActualizarIglesia($tablaIglesias, $item1a, $valor1a, $valor);

			$item1b = "ultima_compra";

			date_default_timezone_set('America/Bogota');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;

			$fechaIglesia = ModeloIglesias::mdlActualizarIglesia($tablaIglesias, $item1b, $valor1b, $valor);

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "pedidos";

			$datos = array("id_secretaria"=>$_POST["idSecretaria"],
						   "id_iglesia"=>$_POST["seleccionarIglesia"],
						   "codigo"=>$_POST["nuevoPedido"],
						   "productos"=>$_POST["listaProductos"],
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalPedido"],
						   "metodo_pago"=>$_POST["listaMetodoPago"]);

			$respuesta = ModeloPedidos::mdlIngresarPedido($tabla, $datos);

			if($respuesta == "ok"){

	// $impresora = "epson20";

				// $conector = new WindowsPrintConnector($impresora);

				// $imprimir = new Printer($conector);

				// $imprimir -> text("Hola Mundo"."\n");

				// $imprimir -> cut();

				// $imprimir -> close();

				/**$impresora = "epson20";

				$conector = new WindowsPrintConnector($impresora);

				$printer = new Printer($conector);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer -> text(date("Y-m-d H:i:s")."\n");//Fecha de la factura

				$printer -> feed(1); //Alimentamos el papel 1 vez*/

				/**$printer -> text("Inventory System"."\n");//Nombre de la empresa

				$printer -> text("NIT: 71.759.963-9"."\n");//Nit de la empresa

				$printer -> text("Dirección: Calle 44B 92-11"."\n");//Dirección de la empresa

				$printer -> text("Teléfono: 300 786 52 49"."\n");//Teléfono de la empresa

				$printer -> text("FACTURA N.".$_POST["nuevaVenta"]."\n");//Número de factura

				$printer -> feed(1); //Alimentamos el papel 1 vez*/

				/**$printer -> text("Cliente: ".$traerCliente["nombre"]."\n");//Nombre del cliente

				$tablaVendedor = "usuarios";
				$item = "id";
				$valor = $_POST["idVendedor"];

				$traerVendedor = ModeloUsuarios::mdlMostrarUsuarios($tablaVendedor, $item, $valor);

				$printer -> text("Vendedor: ".$traerVendedor["nombre"]."\n");//Nombre del vendedor

				$printer -> feed(1); //Alimentamos el papel 1 vez*/

				/**foreach ($listaProductos as $key => $value) {

					$printer->setJustification(Printer::JUSTIFY_LEFT);

					$printer->text($value["descripcion"]."\n");//Nombre del producto

					$printer->setJustification(Printer::JUSTIFY_RIGHT);

					$printer->text("$ ".number_format($value["precio"],2)." Und x ".$value["cantidad"]." = $ ".number_format($value["total"],2)."\n");

				}

				$printer -> feed(1); //Alimentamos el papel 1 vez*/			
				
				/**$printer->text("NETO: $ ".number_format($_POST["nuevoPrecioNeto"],2)."\n"); //ahora va el neto

				$printer->text("IMPUESTO: $ ".number_format($_POST["nuevoPrecioImpuesto"],2)."\n"); //ahora va el impuesto

				$printer->text("--------\n");

				$printer->text("TOTAL: $ ".number_format($_POST["totalVenta"],2)."\n"); //ahora va el total

				$printer -> feed(1); //Alimentamos el papel 1 vez*/	

				/**$printer->text("Muchas gracias por su compra"); //Podemos poner también un pie de página

				$printer -> feed(3); //Alimentamos el papel 3 veces*/

				/**$printer -> cut(); //Cortamos el papel, si la impresora tiene la opción

				$printer -> pulse(); //Por medio de la impresora mandamos un pulso, es útil cuando hay cajón moneder

				$printer -> close();*/

	
				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "El pedido ha sido guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "pedidos";

								}
							})

				</script>';

			}

		}

	}

	/*=============================================
	EDITAR PEDIDO
	=============================================*/

	static public function ctrEditarPedido(){

		if(isset($_POST["editarPedido"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y DE LAS IGLESIAS
			=============================================*/
			$tabla = "pedidos";

			$item = "codigo";
			$valor = $_POST["editarPedido"];

			$traerPedido = ModeloPedidos::mdlMostrarPedidos($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerPedido["productos"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerPedido["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "id";
					$valor = $value["id"];
					$orden = "id";

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

					$item1a = "pedidos";
					$valor1a = $traerProducto["pedidos"] - $value["cantidad"];

					$nuevasPedidos = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}

				$tablaIglesias = "iglesias";

				$itemIglesia = "id";
				$valorIglesia = $_POST["seleccionarIglesia"];

				$traerIglesia = ModeloIglesias::mdlMostrarIglesias($tablaIglesias, $itemIglesia, $valorIglesia);

				$item1a = "compras";
				$valor1a = $traerIglesia["compras"] - array_sum($totalProductosComprados);		

				$comprasIglesia = ModeloIglesias::mdlActualizarIglesia($tablaIglesias, $item1a, $valor1a, $valorIglesia);

				/*=============================================
				ACTUALIZAR LAS COMPRAS DE LAS IGLESIAS Y REDUCIR EL STOCK Y AUMENTAR LOS PEDIDOS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos_2 = json_decode($listaProductos, true);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2 = "id";
					$valor_2 = $value["id"];
					$orden = "id";

					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);

					$item1a_2 = "pedidos";
					$valor1a_2 = $value["cantidad"] + $traerProducto_2["pedidos"];

					$nuevosPedidos_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $value["stock"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				$tablaIglesias_2 = "iglesias";

				$item_2 = "id";
				$valor_2 = $_POST["seleccionarIglesia"];

				$traerIglesia_2 = ModeloIglesias::mdlMostrarIglesias($tablaIglesias_2, $item_2, $valor_2);

				$item1a_2 = "compras";

				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerIglesia_2["compras"];

				$comprasIglesia_2 = ModeloIglesias::mdlActualizarIglesia($tablaIglesias_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Bogota');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaIglesia_2 = ModeloIglesias::mdlActualizarIglesia($tablaIglesias_2, $item1b_2, $valor1b_2, $valor_2);

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("id_secretaria"=>$_POST["idSecretaria"],
						   "id_iglesia"=>$_POST["seleccionarIglesia"],
						   "codigo"=>$_POST["editarPedido"],
						   "productos"=>$listaProductos,
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalPedido"],
						   "metodo_pago"=>$_POST["listaMetodoPago"]);


			$respuesta = ModeloPedidos::mdlEditarPedido($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "El pedido ha sido editado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "pedidos";

								}
							})

				</script>';

			}

		}

	}


	/*=============================================
	ELIMINAR PEDIDO
	=============================================*/

	static public function ctrEliminarPedido(){

		if(isset($_GET["idPedido"])){

			$tabla = "pedidos";

			$item = "id";
			$valor = $_GET["idPedido"];

			$traerPedido = ModeloPedidos::mdlMostrarPedidos($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaIglesias = "iglesias";

			$itemPedidos = null;
			$valorPedidos = null;

			$traerPedidos = ModeloPedidos::mdlMostrarPedidos($tabla, $itemPedidos, $valorPedidos);

			$guardarFechas = array();

			foreach ($traerPedidos as $key => $value) {
				
				if($value["id_iglesia"] == $traerPedido["id_iglesia"]){

					array_push($guardarFechas, $value["fecha"]);

				}

			}

			if(count($guardarFechas) > 1){

				if($traerPedido["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdIglesia = $traerPedido["id_iglesia"];

					$comprasIglesia = ModeloIglesias::mdlActualizarIglesia($tablaIglesias, $item, $valor, $valorIdIglesia);

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdIglesia = $traerPedido["id_iglesia"];

					$comprasIglesia = ModeloIglesias::mdlActualizarIglesia($tablaIglesias, $item, $valor, $valorIdIglesia);

				}


			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdIglesia = $traerPedido["id_iglesia"];

				$comprasIglesia = ModeloIglesias::mdlActualizarIglesia($tablaIglesias, $item, $valor, $valorIdIglesia);

			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y DE LAS IGLESIAS
			=============================================*/

			$productos =  json_decode($traerPedido["productos"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];
				$orden = "id";

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "pedidos";
				$valor1a = $traerProducto["pedidos"] - $value["cantidad"];

				$nuevasPedidos = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["cantidad"] + $traerProducto["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaIglesias = "iglesias";

			$itemIglesia = "id";
			$valorIglesia = $traerPedido["id_iglesia"];

			$traerIglesia = ModeloIglesias::mdlMostrarIglesias($tablaIglesias, $itemIglesia, $valorIglesia);

			$item1a = "compras";
			$valor1a = $traerIglesia["compras"] - array_sum($totalProductosComprados);

			$comprasIglesia = ModeloIglesias::mdlActualizarIglesia($tablaIglesias, $item1a, $valor1a, $valorIglesia);

			/*=============================================
			ELIMINAR PEDIDO
			=============================================*/

			$respuesta = ModeloPedidos::mdlEliminarPedido($tabla, $_GET["idPedido"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El pedido ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "pedidos";

								}
							})

				</script>';

			}		
		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasPedidos($fechaInicial, $fechaFinal){

		$tabla = "pedidos";

		$respuesta = ModeloPedidos::mdlRangoFechasPedidos ($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "pedidos";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$pedidos = ModeloPedidos::mdlRangoFechasPedidos($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$pedidos = ModeloPedidos::mdlMostrarPedidos($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL 
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");
		
			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>IGLESIA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>SECRETARIA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($pedidos as $row => $item){

				$iglesia = ControladorIglesias::ctrMostrarIglesias("id", $item["id_iglesia"]);
				$secretaria = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_secretaria"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$iglesia["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$secretaria["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

			 	$productos =  json_decode($item["productos"], true);

			 	foreach ($productos as $key => $valueProductos) {
			 			
			 			echo utf8_decode($valueProductos["cantidad"]."<br>");
			 		}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

		 		foreach ($productos as $key => $valueProductos) {
			 			
		 			echo utf8_decode($valueProductos["descripcion"]."<br>");
		 		
		 		}

		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>	
					<td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
		 			</tr>");


			}


			echo "</table>";

		}

	}


	/*=============================================
	SUMA TOTAL PEDIDOS
	=============================================*/

	public function ctrSumaTotalPedidos(){

		$tabla = "pedidos";

		$respuesta = ModeloPedidos::mdlSumaTotalPedidos($tabla);

		return $respuesta;

	}

	/*=============================================
	DESCARGAR XML
	=============================================*/

	static public function ctrDescargarXML(){

		if(isset($_GET["xml"])){


			$tabla = "pedidos";
			$item = "codigo";
			$valor = $_GET["xml"];

			$pedidos = ModeloPedidos::mdlMostrarPedidos($tabla, $item, $valor);

			// PRODUCTOS

			$listaProductos = json_decode($pedidos["productos"], true);

			// IGLESIAS

			$tablaIglesias = "iglesias";
			$item = "id";
			$valor = $pedidos["id_iglesia"];

			$traerIglesia = ModeloIglesias::mdlMostrarIglesias($tablaIglesias, $item, $valor);

			// SECRETARIA

			$tablaSecretaria = "usuarios";
			$item = "id";
			$valor = $pedidos["id_secretaria"];

			$traerSecretaria = ModeloUsuarios::mdlMostrarUsuarios($tablaSecretaria, $item, $valor);

			//http://php.net/manual/es/book.xmlwriter.php

			$objetoXML = new XMLWriter();

			$objetoXML->openURI($_GET["xml"].".xml"); //Creación del archivo XML

			$objetoXML->setIndent(true); //recibe un valor booleano para establecer si los distintos niveles de nodos XML deben quedar indentados o no.

			$objetoXML->setIndentString("\t"); // carácter \t, que corresponde a una tabulación

			$objetoXML->startDocument('1.0', 'utf-8');// Inicio del documento
			
			// $objetoXML->startElement("etiquetaPrincipal");// Inicio del nodo raíz

			// $objetoXML->writeAttribute("atributoEtiquetaPPal", "valor atributo etiqueta PPal"); // Atributo etiqueta principal

			// 	$objetoXML->startElement("etiquetaInterna");// Inicio del nodo hijo

			// 		$objetoXML->writeAttribute("atributoEtiquetaInterna", "valor atributo etiqueta Interna"); // Atributo etiqueta interna

			// 		$objetoXML->text("Texto interno");// Inicio del nodo hijo
			
			// 	$objetoXML->endElement(); // Final del nodo hijo
			
			// $objetoXML->endElement(); // Final del nodo raíz


			$objetoXML->writeRaw('<fe:Invoice xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">');

			$objetoXML->writeRaw('<ext:UBLExtensions>');

			foreach ($listaProductos as $key => $value) {
				
				$objetoXML->text($value["descripcion"].", ");
			
			}

			

			$objetoXML->writeRaw('</ext:UBLExtensions>');

			$objetoXML->writeRaw('</fe:Invoice>');

			$objetoXML->endDocument(); // Final del documento

			return true;	
		}

	}

}