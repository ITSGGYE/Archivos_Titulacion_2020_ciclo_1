<?php
$subtotal 	= 0;
$iva 	 	= 0;
$impuesto 	= 0;
$tl_sniva   = 0;
$total 		= 0;
 //print_r($configuracion); ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Factura</title>
 	<!--<link rel="stylesheet" href="style.css">-->
 </head>
 <style type="text/css">
 	
 	@page {
 		margin-top: 0.3em;
 		
 	}
 	body{
 		font-size: xx-small;
 	}
 	.img{
 		text-align: center;
 	}
 	#factura_head{
 		text-align: center;
 	}
 	.label_gracias{
 		font-family: verdana;
 		font-weight: bold;
 		text-align: center;
 		margin-top: 20px;
 	}
 	.textright{
 		text-align: right;
 	}
 	.textleft{
 		text-align: left;
 	}
 	.textcenter{
 		text-align: center;
 	}
 	.h3{
 		text-align: center;
 		background:  #009975;
 		color: #FFF;
 	}
 	.round{
 		text-align: center;
 	}
 	.info_empresa{
 		text-align: center;
 	}
 	.anulada{
 		position: absolute;
 		top: 40%;
 		transform: translateX(-15%) translateY(-15%);
 	}

 </style>

 <body class="factura">
 	<?php echo $anulada; ?>
 	<div id="page_pdf">
 		<br>
 		<div class="img">
 			<img src="img/icono2.png" style="width: 55px;">
 		</div>

 		<table id="factura_head">
 			<tr>
 				<td class="info_empresa">
 					<?php
 					if($result_config > 0){
 						$iva = $configuracion['iva'];
 						?>
 						<div class="round">
 							<p><strong><?php echo strtoupper($configuracion['nombre']); ?></strong></p>
 							<p><?php echo $configuracion['razon_social']; ?></p>
 							<p><?php echo $configuracion['direccion']; ?></p>
 							<p>Ruc: <?php echo $configuracion['nit']; ?></p>
 							<p>Teléfono: <?php echo $configuracion['telefono']; ?></p>
 							<p>Email: <?php echo $configuracion['email']; ?></p>
 						</div>
 						<?php
 					}
 					?>
 				</td>
 			</tr>
 		</table>

 		<div class="round">
 			<p class="h3">Detalle de la factura</p>
 			<p>No. Factura: <strong><?php echo $factura['nofactura']; ?></strong></p>
 			<p>Fecha: <?php echo $factura['fecha']; ?></p>
 			<p>Hora: <?php echo $factura['hora']; ?></p>
 			<p>Vendedor: <?php echo $factura['vendedor']; ?></p>
 		</div>

 		<table id="factura_cliente">
 			<tr>
 				<td class="info_cliente">
 					<div class="round">
 						<p class="h3">Datos del Cliente</p>
 						<table class="datos_cliente">
 							<thead>
 								<tr>
 									<th>Cedula</th>
 									<th>Teléfono</th>
 									<th>Nombre</th>
 									<th>Dirección</th>
 								</tr>
 							</thead>
 							<tbody>
 								<td><?php echo $factura['nit']; ?></td>
 								<td><?php echo $factura['telefono']; ?></td>
 								<td><?php echo $factura['nombre']; ?></td>
 								<td><?php echo $factura['direccion']; ?></td>
 							</tbody>
 						</table>
 					</div>
 				</td>
 			</tr>
 		</table>
 		<br>

 		<p class="h3">Detalle de Venta</p>

 		<table id="factura_detalle">
 			<thead>
 				<tr>
 					<th width="30px">Cant.</th>
 					<th class="textleft" width="35px">Producto</th>
 					<th class="textright" width="25px">P.Unitario</th>
 					<th class="textright" width="40px">P.Total</th>
 				</tr>
 			</thead>

 			<tbody id="detalle_productos">

 				<?php

 				if($result_detalle > 0){

 					while ($row = mysqli_fetch_assoc($query_productos)){
 						?>
 						<tr>
 							<td class="textcenter"><?php echo $row['cantidad']; ?></td>
 							<td><?php echo $row['descripcion']; ?></td>
 							<td class="textright"><?php echo $row['precio_venta']; ?></td>
 							<td class="textright"><?php echo $row['precio_total']; ?></td>
 						</tr>
 						<?php
 						$precio_total = $row['precio_total'];
 						$subtotal = round($subtotal + $precio_total, 2);
 					}
 				}

 				$impuesto 	= round($subtotal * ($iva / 100), 2);
 				$tl_sniva 	= round($subtotal - $impuesto,2 );
 				$total 		= round($tl_sniva + $impuesto,2);
 				?>
 			</tbody>
 			<tfoot id="detalle_totales">
 				<tr>
 					<td colspan="3" class="textright"><span>SUBTOTAL </span></td>
 					<td class="textright"><span><?php echo $tl_sniva; ?></span></td>
 				</tr>
 				<tr>
 					<td colspan="3" class="textright"><span>IVA (<?php echo $iva; ?> %)</span></td>
 					<td class="textright"><span><?php echo $impuesto; ?></span></td>
 				</tr>
 				<tr>
 					<td colspan="3" class="textright"><span>TOTAL </span></td>
 					<td class="textright"><span><?php echo $total; ?></span></td>
 				</tr>
 			</tfoot>
 		</table>

 		<div>
 			<h4 class="label_gracias">¡Gracias por su Compra!</h4>
 		</div>

 	</div>

 </body>
 </html>