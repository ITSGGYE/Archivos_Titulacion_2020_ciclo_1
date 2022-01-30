<?php 
    require_once '../modelo/ProductoSalidaM.php';

    
      //instancia
      $productoSalida = new ProductoSalidaM;
    

      // paginacion
      $cantidad_filas_bd = $productoSalida->obtener_filas_productoSalida();
      $cantidad_vista = 8;
      $cantidad_paginacion = ceil($cantidad_filas_bd / $cantidad_vista);
  
      //redireccionando el paginador cuando cargue el sitio
      if ( !$_GET ) {
          header('location:ProductoSalidaC.php?p1=1');
      }
  
      //obtener productos db
      //obteniendo limtes
      $inicio = ( $_GET['p1'] -1 ) * $cantidad_vista;
      $productoSalidas = $productoSalida->obtener_limite_productoSalida($inicio);
 
      $productoSalidas2 = $productoSalida->obtener_todos_productoSalida();
  
     //echo $foto; (imprime en un alert)
 
     //id
     error_reporting(0);
     $id_i = $_POST['id_i'];
 
    
     //eliminar categorias
     $productoSalida->eliminar_productoSalida($id_i);


    require_once '../vista/informe/informe2.php';


?>