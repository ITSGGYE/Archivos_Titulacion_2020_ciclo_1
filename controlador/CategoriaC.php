<?php 
    require_once('../modelo/CategoriaM.php');

    //instancia
    $categoriaM = new CategoriaM;

     // paginacion
     $cantidad_filas_bd = $categoriaM->obtener_filas_categorias();
     $cantidad_vista = 17;
     $cantidad_paginacion = ceil($cantidad_filas_bd / $cantidad_vista);
 
     //redireccionando el paginador cuando cargue el sitio
     if ( !$_GET ) {
         header('location:CategoriaC.php?p1=1');
     }
 
     //obtener productos db
     //obteniendo limtes
     $inicio = ( $_GET['p1'] -1 ) * $cantidad_vista;
     $categorias = $categoriaM->obtener_limite_categorias($inicio);

     $categorias2 = $categoriaM->obtener_todos_categorias();

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
        $categoriaM->insertar_categorias($nombre_i, $descripcion_i);
    }
    

    //actualizar categorias
    $categoriaM->actualizar_categorias($id_u, $nombre_u, $fecha_u, $hora_u,  $descripcion_u);
    
    //eliminar categorias
    $categoriaM->eliminar_categorias($id_i);
   

    require_once('../vista/inventario/categoria.php');

?>