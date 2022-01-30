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

		<i> <title> MANUAL DE INSTRUCCIONES PARA EL PERSONAL ADMINISTRATIVO </title> </i>

		</p>

	 <p align="center">

	<i> <title>	<h1> SISTEMA DE INVENTARIO JUNIL </h1> </title> </i> </p>


<p> Cuenta de Usuario y Contraseña:

<p> <i>Iniciar Sesión.-</i> Para acceder al sistema, el usuario debe colocar el cargo al que pertenece en este caso (Administrador) y su contraseña que será entregada por la administradora de la Organización. </p> </p>

<td><img src="images/manual1/1.1.png" border="1" alt="1" width="600" height="210"></td>

<br> </br>
	
<p> Botones disponibles:

<p> <i>Ingresar:</i> Después que ya introdujo el usuario y la contraseña, pulse el botón “Ingresar” para poder acceder al Sistema de Inventario “JUNIL”. </p> </p>

<td><img src="images/manual1/2.png"  border="1" alt="1" width="600" height="210"></td>

<br> </br>

 <br> </br>

 <p> El sistema nos re direccionara a la página de inicio donde podremos visualizar los procesos de ayuda, usuarios, categorías, productos, iglesia, pedidos y el de cerrar sesión. </p>

 <img src="images/manual1/3.3.png" border="1" alt="1" width="600" height="227"> 

 <p> Al darle clic en (Inicio) botón mostrado en la figura anterior se visualizará esta pantalla donde nos mostrara un cuadro especificados por los valores que contiene cada servicio como lo son: pedidos, categorías, iglesias, productos.  </p>

<img src="images/manual1/4.jpg" border="1" alt="1" width="600" height="227"> 

<p>Luego podrá dar clic en la opción (ayuda) y se podrá visualizar esta página dando clic donde lo indica la flecha accederá al manual de usuario de administrador (a) del sistema de inventario “Junil”. </p>

<img src="images/manual1/5.png" border="1" alt="1" width="600" height="220"> 

<p> Dentro del menú también tenemos la opción USUARIOS y si le damos clic al botón nos re dirigirá a la página donde se verán los usuarios creados con las opciones correspondientes. </p>

<img src="images/manual1/6.png" border="1" alt="1" width="600" height="220"> 

<p> En la opcion de “Agregar usuario” debera ingresar nombre, codigo, contraseña,seleccionar su perfil y cargar una foto de referencia, luego dar clic en el boton “Guardar usuario” </p>

<img src="images/manual1/7.png" border="1" alt="1" width="600" height="220">

<p> También existe la opción de editar el usuario que es el botón que indica la flecha azul, donde nos saldrá un recuadro y podemos corregir o cambiar los datos del usuario, luego guardamos el cambio dándole clic al botón celeste que está dentro del recuadro </p>

<img src="images/manual1/8.png" border="1" alt="1" width="600" height="220">

<p> Otra opción que brinda el sistema “Junil” es eliminar el usuario al momento de acceder al botón que indica la flecha azul y si decide borrarlo dará clic en el botón “Si, borrar usuario” y automáticamente se eliminara, pero si accedió por error a la ventana dará clic en el botón “cancelar” y no se realizara ningún cambio.</p>

<img src="images/manual1/9.png" border="1" alt="1" width="600" height="220">

<p>Otro servicio que nos brinda el sistema “JUNIL” es la opción de Categorías donde al darle clic a la opción nos mostrara el listado de las categorías que tiene la Organización.</p>

<img src="images/manual1/10.png" border="1" alt="1" width="600" height="210">

<p>Y si desea agregar una nueva Categoría le da clic en el botón “Agregar categoría” como lo indica en la flecha azul y le aparecerá un recuadro donde debe ingresar el nombre de la categoría que desea agregar y le aparecerán dos botones donde escogerá si Guardar la categoría o salir.</p>

<img src="images/manual1/11.png" border="1" alt="1" width="600" height="210">

<p> También existe la opción de editar la categoría que es el botón que indica la flecha azul, donde nos saldrá un recuadro y podemos corregir o cambiar el nombre de la categoría, luego guardamos el cambio dándole clic al botón celeste que está dentro del recuadro. </p>

<img src="images/manual1/12.png" border="1" alt="1" width="600" height="210">

<p> Otra opción que brinda el sistema “Junil” es eliminar la categoría que se activara el recuadro al momento de acceder al botón que indica la flecha azul y si decide borrarla dará clic en el botón “Si, borrar categoría” y automáticamente se eliminara, pero si accedió por error a la ventana dará clic en el botón “cancelar” y no se realizara ningún </p>

<img src="images/manual1/13.png" border="1" alt="1" width="600" height="220">

<p>  Y otro botón que tiene el servicio de categoría es la opción de “buscar” donde dará clic y escribirá el nombre de la categoría que necesita y solo mostrará los resultados con el nombre ingresado como se muestra en la imagen.</p>

<img src="images/manual1/14.png" border="1" alt="1" width="600" height="220">

<p> Luego puede escoger la opción de (Productos) la cual mostrará todos los productos con los que cuenta la Organización.</p>

<img src="images/manual1/15.png" border="1" alt="1" width="600" height="220">

<p>Y si desea agregar un nuevo Producto le da clic en el botón “Agregar producto” como lo indica en la flecha azul y le aparecerá un recuadro donde debe seleccionar la categoría a la que pertenece el producto, ingresar el código del producto que desea agregar, la descripción, la cantidad del stock que tendrá el mismo, y los valores del mismo junto con el porcentaje y tendrá que subir una imagen como referencia del producto y aparecerán dos botones donde escogerá si Guardar el producto o salir.</p>

<img src="images/manual1/16.png" border="1" alt="1" width="600" height="220">

<p>También existe la opción de editar el producto que es el botón que indica la flecha azul, donde nos saldrá un recuadro y podemos corregir o cambiar los datos ingresados del producto, luego guardamos el cambio dándole clic al botón celeste que está dentro del recuadro.</p>

<img src="images/manual1/17.png" border="1" alt="1" width="600" height="205">

<p> Otra opción que brinda el sistema “Junil” es eliminar el producto esta opción se activara al momento de acceder al botón que indica la flecha azul y si decide borrarla dará clic en el botón “Si, borrar producto” y automáticamente se eliminara, pero si accedió por error a la ventana dará clic en el botón “cancelar” y no se realizara ningún cambio. </p>

<img src="images/manual1/18.png" border="1" alt="1" width="600" height="200">

<p> Y otro botón que tiene el servicio de productos es la opción de “buscar” donde dará clic y escribirá el nombre completo o parte del mismo que necesita y solo mostrará los resultados con el nombre ingresado como se muestra en la imagen. </p>

<img src="images/manual1/19.png" border="1" alt="1" width="600" height="200">

<p> Dentro de productos también existe la opción de mostrar el listado de los productos que esta ubicada donde lo indica la flecha azul y estos pueden ser de 10,25,50 o 100 productos en la misma pantalla.  </p>

<img src="images/manual1/20.png" border="1" alt="1" width="600" height="220">

<p> Otro servicio que nos brinda el sistema “JUNIL” es la opción de Iglesias donde al darle clic a la opción nos mostrara el listado de las iglesias registradas que tiene la Organización. </p>

<img src="images/manual1/21.png" border="1" alt="1" width="600" height="220">

<p>Si desea agregar una nueva Iglesia le da clic en el botón “Agregar iglesia” como lo indica en la flecha azul y le aparecerá un recuadro donde debe ingresar el nombre, dirección de correo, teléfono y dirección de la iglesia que desea agregar y le aparecerán dos botones donde escogerá si Guardar la iglesia o salir. </p>

<img src="images/manual1/22.png" border="1" alt="1" width="600" height="200">

<p>Dentro esta la opción de editar la iglesia que es el botón que indica la flecha azul, donde nos saldrá un recuadro y podemos corregir o cambiar los datos de la iglesia, luego guardamos el cambio dándole clic al botón celeste que está dentro del recuadro</p>

<img src="images/manual1/23.png" border="1" alt="1" width="600" height="200">

<p>Otra opción que brinda el sistema “Junil” es eliminar la iglesia opción que se activara con el recuadro al momento de acceder al botón que indica la flecha azul y si decide borrarla dará clic en el botón “Si, borrar iglesia” y automáticamente se eliminara, pero si accedió por error a la ventana dará clic en el botón “cancelar” y no se realizara ningún cambio.</p>

<img src="images/manual1/24.png" border="1" alt="1" width="600" height="200">

<p> También existe la opción de mostrar el listado de las iglesias y estos pueden ser de 10,25,50 o 100 iglesias en la misma pantalla. </p>

<img src="images/manual1/25.png" border="1" alt="1" width="600" height="220">

<p>Y otro botón que tiene el servicio de iglesia es la opción de “buscar” donde dará clic y escribirá el nombre de la iglesia que necesita y solo mostrará los resultados con el nombre ingresado como se muestra en la imagen</p>

<img src="images/manual1/26.png" border="1" alt="1" width="600" height="220">

<p> Otro servicio que nos brinda el sistema “JUNIL” es la opción de Pedidos donde al darle clic a la opción nos mostrara 3 opciones que podemos escoger como se muestra en la imagen. </p>

<img src="images/manual1/27.png" border="1" alt="1" width="600" height="200">

<p>Si desea crear un nuevo pedido le da clic a la opción “Crear pedido” como lo indica en la flecha azul y le aparecerá un recuadro donde debe seleccionar los valores, la iglesia, el método de pago y debe agregar los productos que necesite la iglesia y al final le aparecerá el botón de Guardar el pedido.</p>

<img src="images/manual1/28.png" border="1" alt="1" width="600" height="200">

<p>También existe la opción de editar el pedido, donde nos saldrá un recuadro y podemos corregir o cambiar los datos que tiene el pedido, luego guardamos el cambio dándole clic al botón “Guardar cambios” que está dentro del recuadro.</p>

<img src="images/manual1/29.png" border="1" alt="1" width="600" height="200">



<p>Otra opción que brinda el sistema “Junil” es eliminar el pedido que se ha registrado, opción que activara el recuadro al momento de acceder al botón que indica la flecha azul y si decide borrarla dará clic en el botón “Si, borrar pedido” y automáticamente se eliminara, pero si accedió por error a la ventana dará clic en el botón “cancelar” y no se realizara ningún cambio.</p>

<img src="images/manual1/30.png" border="1" alt="1" width="600" height="225">

<p>Si accedemos al botón “Ticket” nos re direccionara a otra página donde nos mostrara el ticket que se le otorgara a la iglesia que realizo el pedido como se muestra en la imagen.</p>

<img src="images/manual1/31.png" border="1" alt="1" width="600" height="225">

<p>Si accedemos al botón que tiene por nombre “PDF” nos re direccionará a otra página como se muestra en la imagen mostrándonos una factura del pedido realizado.</p>

<img src="images/manual1/32.png" border="1" alt="1" width="600" height="220">

<p>Si escogemos la opción de Reporte de pedido nos enviara a esta pantalla donde podemos escoger la fecha para generar el reporte y descargarlo en Excel. </p>

<img src="images/manual1/33.png" border="1" alt="1" width="600" height="220">

<p>Y finalmente tenemos la opción de Salir </p>

</tr>

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