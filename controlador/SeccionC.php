<?php 
    require_once('../modelo/SeccionM.php');

    //instancia
    $seccionM = new SeccionM;

     // paginacion
     $cantidad_filas_bd = $seccionM->obtener_filas_secciones();
     $cantidad_vista = 17;
     $cantidad_paginacion = ceil($cantidad_filas_bd / $cantidad_vista);
 
     //redireccionando el paginador cuando cargue el sitio
     if ( !$_GET ) {
         header('location:SeccionC.php?p2=1');
     }
 
     //obtener productos db
     //obteniendo limtes
     $inicio = ( $_GET['p2'] -1 ) * $cantidad_vista;
     $secciones = $seccionM->obtener_limite_secciones($inicio);

     $secciones2 = $seccionM->obtener_todos_secciones();

      /*
        captura y procedimientos de datos post, ver, insertar, actualizar
    */
    error_reporting(0);    
    $nombre_i = $_POST['nombre_i'];
    $descripcion_i = ''; 
    $descripcion_i = $_POST['descripcion_i'];
 
    //echo $foto; (imprime en un alert)

    $id_u = $_POST['id_u'];
    $nombre_u = $_POST['nombre_u']; 
    $fecha_u = $_POST['fecha_u'];
    //$stock_u = ''; 
    $hora_u = $_POST['hora_u'];
    $descripcion_u = ''; 
    $descripcion_u = $_POST['descripcion_u'];

    //id
    $id_i = $_POST['id_i'];

    //insertar categorias
    if (isset($nombre_i)) {
        $seccionM->insertar_secciones($nombre_i, $descripcion_i);
    }
    

    //actualizar categorias
    $seccionM->actualizar_secciones($id_u, $nombre_u, $fecha_u, $hora_u,  $descripcion_u);
    
    //eliminar categorias
    $seccionM->eliminar_secciones($id_i);
   

    require_once('../vista/inventario/seccion.php');

?>