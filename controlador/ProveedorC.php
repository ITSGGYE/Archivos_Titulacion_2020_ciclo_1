<?php 
    require_once('../modelo/ProveedorM.php');

    //instancia
    $proveedorM = new ProveedorM;

     // paginacion
     $cantidad_filas_bd = $proveedorM->obtener_filas_proveedores();
     $cantidad_vista = 17;
     $cantidad_paginacion = ceil($cantidad_filas_bd / $cantidad_vista);
 
     //redireccionando el paginador cuando cargue el sitio
     if ( !$_GET ) {
         header('location:ProveedorC.php?p3=1');
     }
 
     //obtener productos db
     //obteniendo limtes
     $inicio = ( $_GET['p3'] -1 ) * $cantidad_vista;
     $proveedores = $proveedorM->obtener_limite_proveedores($inicio);

     $proveedores2 = $proveedorM->obtener_todos_proveedores();

      /*
        captura y procedimientos de datos post, ver, insertar, actualizar
    */
    error_reporting(0);    
    $nombre_i = $_POST['nombre_i'];
    $correo_i = '';
    $correo_i = $_POST['correo_i'];
    $direccion_i = '';
    $direccion_i = $_POST['direccion_i'];
    $telefono_i = '';
    $telefono_i = $_POST['telefono_i'];
    $fecha_i = $_POST['fecha_i'];
    $hora_i = $_POST['hora_i'];
    $especialidad_i = '';
    $especialidad_i = $_POST['especialidad_i'];
    $descripcion_i = ''; 
    $descripcion_i = $_POST['descripcion_i'];
 
    //echo $foto; (imprime en un alert)
    $id_u = $_POST['id_u'];
    $nombre_u = $_POST['nombre_u'];    
    $correo_u = $_POST['correo_u'];
    $direccion_u = $_POST['direccion_u'];
    $telefono_u = $_POST['telefono_u'];
    $fecha_u = $_POST['fecha_u'];
    $hora_u = $_POST['hora_u'];
    $especialidad_u = $_POST['especialidad_u'];
    $descripcion_u = $_POST['descripcion_u'];

    //id
    $id_i = $_POST['id_i'];

    //insertar categorias
    if (isset($nombre_i)) {
        $proveedorM->insertar_proveedores($nombre_i, $correo_i, $direccion_i, $telefono_i, $especialidad_i, $descripcion_i);
    }
    

    //actualizar categorias
    $proveedorM->actualizar_proveedor($id_u, $nombre_u, $correo_u, $direccion_u, $telefono_u, $fecha_u, $hora_u, $especialidad_u, $descripcion_u);
    
    //eliminar categorias
    $proveedorM->eliminar_proveedor($id_i);
   

    require_once('../vista/inventario/proveedor.php');

?>