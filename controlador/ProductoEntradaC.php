<?php 
    require_once '../modelo/EntradaProductoM.php';

    
      //instancia
      $entradaProducto = new EntradaProductoM;
    

      // paginacion
      $cantidad_filas_bd = $entradaProducto->obtener_filas_productoEntrada();
      $cantidad_vista = 8;
      $cantidad_paginacion = ceil($cantidad_filas_bd / $cantidad_vista);
  
      //redireccionando el paginador cuando cargue el sitio
      if ( !$_GET ) {
          header('location:ProductoEntradaC.php?p1=1');
      }
  
      //obtener productos db
      //obteniendo limtes
      $inicio = ( $_GET['p1'] -1 ) * $cantidad_vista;
      $entradaProductos = $entradaProducto->obtener_limite_productoEntrada($inicio);
 
      $entradaProductos2 = $entradaProducto->obtener_todos_productoEntrada();
  
     //echo $foto; (imprime en un alert)
 
     //id
     error_reporting(0);
     $id_i = $_POST['id_i'];
 
    
     //eliminar categorias
     $entradaProducto->eliminar_productoEntrada($id_i);


    require_once '../vista/informe/informe.php';


?>