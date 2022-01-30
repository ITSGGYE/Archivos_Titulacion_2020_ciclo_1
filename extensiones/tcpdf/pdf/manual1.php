<?php

class imprimirManual{

public $codigo;

public function traerImpresionManual(){


//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

$bloque1 = <<<EOF

	<table>

	<p align="center"> 

		<i> <title> MANUAL DE INSTRUCCIONES PARA EL PERSONAL DE SECRETARIA </title> </i> </p>

	 <p align="center">

	<i> <title>	<h1> SISTEMA DE INVENTARIO JUNIL </h1> </title> </i> </p>


<p> Cuenta de Usuario y Contraseña:

<p> <i>Iniciar Sesión.-</i> Para acceder al sistema, el usuario debe colocar el cargo al que pertenece en este caso (Secretaria) y su contraseña que será entregada por la administradora de la Organización. </p> </p>

<td><img src="images/manual2/34.1.png" border="1" alt="1" width="600" height="210"></td>

<br> </br>
	
<p> Botones disponibles:

<p> <i>Ingresar:</i> Después que ya introdujo el usuario y la contraseña, pulse el botón “Ingresar” para poder acceder al Sistema de Inventario “JUNIL”. </p> </p>

<td><img src="images/manual2/35.png"  border="1" alt="1" width="600" height="210"></td>

<br> </br>

 <br> </br>

<p> El sistema nos re direccionara a la página de inicio donde podremos visualizar los procesos de ayuda, usuarios, iglesias y pedidos. </p>

 <img src="images/manual2/36.png" border="1" alt="1" width="600" height="190"> 

 <p> Al darle clic en (Inicio) botón mostrado en la figura anterior se visualizará esta pantalla donde nos mostrará una imagen relacionada al cargo.  </p>
			
	 <img src="images/manual2/37.1.png" border="1" alt="1" width="600" height="190"> 

  <p> Luego podrá dar clic en la opción (ayuda) y se podrá visualizar esta página dando clic donde lo indica la flecha accederá al manual de usuario de la Secretaria del sistema de inventario “Junil”.  </p>
			
	 <img src="images/manual2/38.png" border="1" alt="1" width="600" height="190"> 

	 <p> El sistema “JUNIL” nos brinda es la opción de Iglesias donde al darle clic a la opción como nos indica la flecha azul, nos mostrara el listado de las iglesias registradas que tiene la Organización.  </p>
			
	 <img src="images/manual2/39.png" border="1" alt="1" width="600" height="227"> 

	  <p> Si desea agregar una nueva Iglesia le da clic en el botón “Agregar iglesia” como lo indica en la flecha azul y le aparecerá un recuadro donde debe ingresar el nombre, dirección de correo, teléfono y dirección de la iglesia que desea agregar y le aparecerán dos botones donde escogerá si Guardar la iglesia o salir.  </p>
			
	 <img src="images/manual2/40.png" border="1" alt="1" width="600" height="227"> 

	 <p> Dentro esta la opción de editar la iglesia que es el botón que indica la flecha azul, donde nos saldrá un recuadro y podemos corregir o cambiar los datos de la iglesia, luego guardamos el cambio dándole clic al botón celeste que está dentro del recuadro.  </p>
			
	 <img src="images/manual2/41.png" border="1" alt="1" width="600" height="190"> 

	  <p> Otro botón que tiene el servicio de iglesia es la opción de “buscar” donde dará clic y
escribirá el nombre de la iglesia que necesita y solo mostrará los resultados con el nombre
ingresado como se muestra en la imagen. </p>
			
	 <img src="images/manual2/42.png" border="1" alt="1" width="600" height="190"> 

	  <p> También existe la opción de mostrar el listado de las iglesias y estos pueden ser de 10,25,50 o 100 iglesias en la misma pantalla. </p>
			
	 <img src="images/manual2/43.png" border="1" alt="1" width="600" height="190"> 

	  <p> Otro servicio que nos brinda el sistema “JUNIL” es la opción de Pedidos donde al darle clic a la opción nos mostrara 2 opciones que podemos escoger como se muestra en la imagen.</p>
			
	 <img src="images/manual2/44.png" border="1" alt="1" width="600" height="300">

	 <p> Si desea crear un nuevo pedido le da clic a la opción “Crear pedido” como lo indica en la
flecha azul y le aparecerá un recuadro donde debe seleccionar los valores, la iglesia, el
método de pago y debe agregar los productos que necesite la iglesia y al final le aparecerá
el botón de Guardar el pedido. </p>
			
	 <img src="images/manual2/45.png" border="1" alt="1" width="600" height="300">

	  <p> Si accedemos al botón “Ticket” nos re direccionara a otra página donde nos mostrara el ticket que se le otorgara a la iglesia que realizo el pedido como se muestra en la imagen. </p>
			
	 <img src="images/manual2/46.png" border="1" alt="1" width="600" height="227">

	 <p> Si accedemos al botón que tiene por nombre “PDF” nos re direccionará a otra página como se muestra en la imagen mostrándonos una factura del pedido realizado. </p>

	 <img src="images/manual2/47.png" border="1" alt="1" width="600" height="227">

  <p> Y finalmente tenemos la opción de Salir</p>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');





// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('manual.pdf', 'D');
ob_end_clean();
$pdf->Output('manual.pdf');

}

}

$manual = new imprimirManual();
$manual -> codigo = $_GET["codigo"];
$manual -> traerImpresionManual();

?>