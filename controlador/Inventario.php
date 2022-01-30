<?php
require_once('../modelo/ProductoM.php');
require_once('../modelo/ProveedorM.php');
require_once('../modelo/CategoriaM.php');
require_once('../modelo/SeccionM.php');

//instancias
$productoM = new ProductoM;
$proveedorM = new ProveedorM;
$categoriaM = new CategoriaM;
$seccionM = new SeccionM;

// paginacion
$cantidad_filas_bd = $productoM->obtener_filas_productos();
$cantidad_vista = 15;
$cantidad_paginacion = ceil($cantidad_filas_bd / $cantidad_vista);

//redireccionando el paginador cuando cargue el sitio
if (!$_GET) {
    header('location:Inventario.php?p=1');
}

//obtener productos db
//obteniendo limtes
session_start();
$inicio = ($_GET['p'] - 1) * $cantidad_vista;
$id_comprovante = '';
// obtener producto por id $id_comprovante = $_SESSION['id_comprovante'];
$productos = $productoM->obtener_limite_productos($inicio);

$productos2 = $productoM->obtener_todos_productos();

/*
        captura y procedimientos de datos post, ver, insertar, actualizar
    */
error_reporting(0);
$nombre_i = $_POST['nombre_i'];
$marca_i = '';
$marca_i = $_POST['marca_i'];
$precio_i = $_POST['precio_i'];
$stock_i = '';
$stock_i = $_POST['stock_i'];
$proveedor_i = $_POST['proveedor_i'];
$categoria_i = $_POST['categoria_i'];
$seccion_i = $_POST['seccion_i'];
$descripcion_i = '';
$descripcion_i = $_POST['descripcion_i'];
$foto_i = $_FILES['imagen_i'];

$nombre_encriptado = md5($foto_i['tmp_name']) . '.jpg';
$ruta = '../libreria/img/galeria/' . $nombre_encriptado;
move_uploaded_file($foto_i['tmp_name'], $ruta);
//echo $foto; (imprime en un alert)

$id_u = $_POST['id_u'];
$nombre_u = $_POST['nombre_u'];
//$marca_u = ''; 
$marca_u = $_POST['marca_u'];
$precio_u = $_POST['precio_u'];
//$stock_u = ''; 
$stock_u = $_POST['stock_u'];
$fecha_u = $_POST['fecha_u'];
$hora_u = $_POST['hora_u'];
$proveedor_u = $_POST['proveedor_u'];
$categoria_u = $_POST['categoria_u'];
$seccion_u = $_POST['seccion_u'];
//$descripcion_u = ''; 
$descripcion_u = $_POST['descripcion_u'];
$foto_u = $_FILES['imagen_u'];

$nombre_encriptado2 = md5($foto_u['tmp_name']) . '.jpg';
$ruta2 = '../libreria/img/galeria/' . $nombre_encriptado2;
move_uploaded_file($foto_u['tmp_name'], $ruta2);


//-----------ESTA PARTE ES LA ORIGINAL-------------
// $id_u2 = $_POST['id_u2'];
// $nombre_u2 = $_POST['nombre_u2'];
// //$marca_u = ''; 
// $marca_u2 = $_POST['marca_u2'];
// $precio_u2 = $_POST['precio_u2'];
// //$stock_u = ''; 
// $stock_u2 = $_POST['stock_u2'];    

// ------------MODIFICACIONES-------------
$id_u2 = $_POST['id_u2'];
$nombre_u2 = $_POST['nombre_u2'];
//$marca_u = ''; 
$marca_u2 = $_POST['marca_u2'];
$precio_u2 = $_POST['precio_u2'];
//$stock_u = ''; 
$stock_u2 = $_POST['stock'];



/*  $fecha_u2 = $_POST['fecha_u2'];
    $hora_u2 = $_POST['hora_u2'];
    $proveedor_u2 = $_POST['proveedor_u2'];    
    $categoria_u2 = $_POST['categoria_u2'];
    $seccion_u2 = $_POST['seccion_u2'];
    //$descripcion_u = ''; 
    $descripcion_u2 = $_POST['descripcion_u'];
    $foto_u2 = $_FILES['imagen_u']; */

$nombre_encriptado2_2 = md5($foto_u['tmp_name']) . '.jpg';
$ruta2_2 = '../libreria/img/galeria/' . $nombre_encriptado2_2;
move_uploaded_file($foto_u['tmp_name'], $ruta2_2);


$id_i = $_POST['id_i'];

//insertar productos
$productoM->insertar_productos($nombre_i, $marca_i, $precio_i, $stock_i, $proveedor_i, $categoria_i, $seccion_i, $descripcion_i, $nombre_encriptado);

//actualizar productos
$productoM->actualizar_productos($id_u, $nombre_u, $marca_u, $precio_u, $stock_u, $fecha_u, $hora_u, $proveedor_u, $categoria_u, $seccion_u, $descripcion_u, $nombre_encriptado2);
$productoM->generar_salida($id_u2, $nombre_u2, $marca_u2, $precio_u2, $stock_u2); /* proceso de venta */

//eliminar productos
$productoM->eliminar_productos($id_i);

//obtener proveedores db
$proveedores = $proveedorM->obtener_todos_proveedores();

//obtener categorias db
$categorias = $categoriaM->obtener_todos_categorias();

//obtener secciones db
$secciones = $seccionM->obtener_todos_secciones();


require_once('../vista/inventario/inventario.php');
