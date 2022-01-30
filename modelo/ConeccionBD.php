<?php
class ConeccionBD
{

    public function conectar()
    {
        $servidor = '127.0.0.1';
        $usuario = 'root';
        $clave = '';
        $Bdatos = 'ferreteria_santos';
        $puerto = '3306';

        $cn = new mysqli($servidor, $usuario, $clave, $Bdatos, $puerto);
        return $cn;
    }
}

//cambios
$servidor = '127.0.0.1';
$usuario = 'root';
$clave = '';
$Bdatos = 'ferreteria_santos';

$cn = @mysqli_connect($servidor, $usuario, $clave, $Bdatos);

if (!$cn) {
    echo ('errorr en la coneccion');
}
