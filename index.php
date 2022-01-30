<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/iglesias.controlador.php";
require_once "controladores/pedidos.controlador.php";
require_once "controladores/ayuda.controlador.php";
require_once "controladores/Ayuda1.controlador.php";
require_once "controladores/Ayuda2.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/iglesias.modelo.php";
require_once "modelos/pedidos.modelo.php";
require_once "modelos/ayuda.modelo.php";
require_once "modelos/Ayuda1.modelo.php";
require_once "modelos/Ayuda2.modelo.php";
require_once "extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();