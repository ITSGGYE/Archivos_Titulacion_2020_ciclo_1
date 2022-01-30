<?php 

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'venta1.1';

//PARAMETROS
$conection = @mysqli_connect($host,$user,$password,$db);
if(!$conection){
	echo "Error en la conexión";
}

?>