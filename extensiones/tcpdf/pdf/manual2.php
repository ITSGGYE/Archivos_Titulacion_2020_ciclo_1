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

		<i> <title> MANUAL DE INSTRUCCIONES PARA EL PERSONAL DE BODEGA </title> </i> </p>

	 <p align="center">

	<i> <title>	<h1> SISTEMA DE INVENTARIO JUNIL </h1> </title> </i> </p>


<p> Cuenta de Usuario y Contraseña:

<p> <i>Iniciar Sesión.-</i> Para acceder al sistema, el usuario debe colocar el cargo al que pertenece en este caso (Jefe de Bodega) y su contraseña que será entregada por la administradora de la Organización.</p> </p>

<td><img src="images/manual3/47.1.png" border="1" alt="1" width="600" height="190"></td>

<br> </br>
	
<p> Botones disponibles:

<p> <i>Ingresar:</i></p> Después que ya introdujo el usuario y la contraseña, pulse el botón “Ingresar” para poder acceder al Sistema de Inventario “JUNIL”. </p>

<td><img src="images/manual3/48.png"  border="1" alt="1" width="600" height="190"></td>

<br> </br>

 <br> </br>

     <p> El sistema nos re direccionara a la página de inicio donde podremos visualizar los procesos de inicio, ayuda, categorías, y productos. </p>

 <img src="images/manual3/49.png" border="1" alt="1" width="600" height="190"> 

     <p> Al darle clic en (Inicio) botón mostrado en la figura anterior se visualizará esta pantalla donde nos mostrará una imagen relacionada al cargo. </p>
			
	 <img src="images/manual3/50.1.png" border="1" alt="1" width="600" height="190"> 

     <p>Luego podrá dar clic en la opción (ayuda) y se podrá visualizar esta página dando clic donde lo indica la flecha accederá al manual de usuario de la Secretaria del sistema de inventario “Junil”. </p>
			
	 <img src="images/manual3/51.png" border="1" alt="1" width="600" height="190"> 

	 <p> El sistema “JUNIL” nos brinda la opción de Categorías donde al darle clic a la opción nos mostrara el listado de las categorías que tiene la Organización. </p>
			
	 <img src="images/manual3/52.png" border="1" alt="1" width="600" height="227"> 

	  <p>Si desea agregar una nueva Categoría le da clic en el botón “Agregar categoría” como lo
indica en la flecha azul y le aparecerá un recuadro donde debe ingresar el nombre de la
categoría que desea agregar y le aparecerán dos botones donde escogerá si Guardar la
categoría o salir.</p>
			
	 <img src="images/manual3/53.png" border="1" alt="1" width="600" height="227"> 

	 <p>También existe la opción de editar la categoría que es el botón que indica la flecha azul, donde nos saldrá un recuadro y podemos corregir o cambiar el nombre de la categoría, luego guardamos el cambio dándole clic al botón celeste que está dentro del recuadro. </p>
			
	 <img src="images/manual3/54.png" border="1" alt="1" width="600" height="190"> 

	  <p>Y otro botón que tiene el servicio de categoría es la opción de “buscar” donde dará clic y escribirá el nombre de la categoría que necesita y solo mostrará los resultados con el nombre ingresado como se muestra en la imagen.</p>
			
	 <img src="images/manual3/55.png" border="1" alt="1" width="600" height="190"> 

	  <p>También existe la opción de mostrar el listado de las iglesias y estos pueden ser de 10,25,50 o 100 iglesias en la misma pantalla. </p>
			
	 <img src="images/manual3/56.png" border="1" alt="1" width="600" height="190"> 

	  <p> Luego puede escoger la opción de (Productos) la cual mostrará todos los productos
con los que cuenta la Organización </p>
			
	 <img src="images/manual3/57.png" border="1" alt="1" width="600" height="220">

	 <p> Y si desea agregar un nuevo Producto le da clic en el botón “Agregar producto” como lo
indica en la flecha azul y le aparecerá un recuadro donde debe seleccionar la categoría a la
que pertenece el producto, ingresar el código del producto que desea agregar, la
descripción, la cantidad del stock que tendrá el mismo, y los valores del mismo junto con el
porcentaje y tendrá que subir una imagen como referencia del producto y aparecerán dos
botones donde escogerá si Guardar el producto o salir.</p>
			
	 <img src="images/manual3/58.png" border="1" alt="1" width="600" height="220">

	  <p>También existe la opción de editar el producto que es el botón que indica la flecha azul,
donde nos saldrá un recuadro y podemos corregir o cambiar los datos ingresados del
producto, luego guardamos el cambio dándole clic al botón celeste que está dentro del
recuadro </p>
			
	 <img src="images/manual3/59.png" border="1" alt="1" width="600" height="227">

	 <p>Otra opción que brinda el sistema “Junil” es eliminar el producto esta opción se activara al
momento de acceder al botón que indica la flecha azul y si decide borrarla dará clic en el
botón “Si, borrar producto” y automáticamente se eliminara, pero si accedió por error a la
ventana dará clic en el botón “cancelar” y no se realizará ningún cambio.</p>

 <img src="images/manual3/60.png" border="1" alt="1" width="600" height="227">

  <p>Y otro botón que tiene el servicio de productos es la opción de “buscar” donde dará clic y
escribirá el nombre completo o parte del mismo que necesita y solo mostrará los resultados
con el nombre ingresado como se muestra en la imagen. </p>

 <img src="images/manual3/61.png" border="1" alt="1" width="600" height="227">

 <p>Dentro de productos también existe la opción de mostrar el listado de los productos
que está ubicada donde lo indica la flecha azul y estos pueden ser de 10,25,50 o 100
productos en la misma pantalla</p>

 <img src="images/manual3/62.png" border="1" alt="1" width="600" height="227">

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