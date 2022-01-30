<?php 
    require_once('../modelo/ClienteM.php');

    //instancia
    $clienteM = new ClienteM;

     // paginacion
     $cantidad_filas_bd = $clienteM->obtener_filas_clientes();
     $cantidad_vista = 17;
     $cantidad_paginacion = ceil($cantidad_filas_bd / $cantidad_vista);
 
     //redireccionando el paginador cuando cargue el sitio
     if ( !$_GET ) {
         header('location:ClienteC.php?p6=1');
     }
 
     //obtener productos db
     //obteniendo limtes
     $inicio = ( $_GET['p6'] -1 ) * $cantidad_vista;
     $clientes = $clienteM->obtener_limite_clientes($inicio);

     $clientes2 = $clienteM->obtener_todos_clientes();

      /*
        captura y procedimientos de datos post, ver, insertar, actualizar
    */
    error_reporting(0);    
    $nombre_i = $_POST['nombre_i'];
    $apellido_i = ''; 
    $apellido_i = $_POST['apellido_i'];
    $telefono_i = '';
    $telefono_i = $_POST['Telefono'];
    $correo_i = $_POST['Correo_i'];
    $descripcion_i = $_POST[''];
    $descripcion_i = $_POST['descripcion_i'];
 
    //echo $foto; (imprime en un alert)

    $id_u = $_POST['id_u'];
    $nombre_u = $_POST['nombre_u']; 
    $apellido_u = $_POST['apellido_u']; 
    $telefono_u = $_POST['telefono_u']; 
    $correo_u = $_POST['correo_u']; 
    $fecha_u = $_POST['fecha_u'];
    $descripcion_u = $_POST['descripcion_u']; 
    //$stock_u = ''; 
    $hora_u = $_POST['hora_u'];
    $descripcion_u = ''; 
    $descripcion_u = $_POST['descripcion_u'];

    //id
    $id_i = $_POST['id_i'];

    //insertar categorias
    if (isset($nombre_i)) {
        $clienteM->insertar_clientes($nombre_i, $apellido_i, $telefono_i, $correo_i, $descripcion_i);
    }
    

    //actualizar categorias
    $clienteM->actualizar_clientes($id_u, $nombre_u, $apellido_u, $telefono_u, $correo_u, $fecha_u,  $descripcion_u);
    
    //eliminar categorias
    $clienteM->eliminar_clientes($id_i);
   

    require_once('../vista/inventario/cliente.php');

?>