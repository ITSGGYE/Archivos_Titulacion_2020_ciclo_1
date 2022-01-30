<?php 
    require_once '../modelo/OpinionPublicaM.php';

      //instancia
      $opinionPublica = new OpinionPublicaM;

      // paginacion
      $cantidad_filas_bd = $opinionPublica->obtener_filas_opinionPublica();
      $cantidad_vista = 8;
      $cantidad_paginacion = ceil($cantidad_filas_bd / $cantidad_vista);
  
      //redireccionando el paginador cuando cargue el sitio
      if ( !$_GET ) {
          header('location:OpinionPublicaC.php?p1=1');
      }
  
      //obtener productos db
      //obteniendo limtes
      $inicio = ( $_GET['p1'] -1 ) * $cantidad_vista;
      $opinionPublicas = $opinionPublica->obtener_limite_opinionPublica($inicio);
 
      $opinionPublicas2 = $opinionPublica->obtener_todos_opinionPublica();
  
     //echo $foto; (imprime en un alert)
 
     //id
     error_reporting(0);
     $id_i = $_POST['id_i'];
 
    
     //eliminar categorias
     $opinionPublica->eliminar_opinionPublica($id_i);


    require_once '../vista/nota/nota.php';


?>