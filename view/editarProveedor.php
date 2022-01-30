<?php 
  
  session_start();
  if($_SESSION['rol'] != 1)
  {
    header("location: ./");
  }

  include "../conexion.php";

 if (!empty($_POST)) {
  $alert = "";
  //VALIDAR CAMPOS DE FORMULARIO
  if (empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
    $alert = '<div class="alert alert-danger" role="alert">Todos los campos son Obligatorios</div>';
  } else {
    $idproveedor = $_GET['id'];
    $proveedor = $_POST['proveedor'];
    $contacto = $_POST['contacto'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql_update = mysqli_query($conection, "UPDATE proveedor 
                                            SET proveedor = '$proveedor',
                                             contacto = '$contacto' , 
                                             telefono = $telefono, 
                                             direccion = '$direccion' 
                                            WHERE codproveedor = $idproveedor");
    if ($sql_update) {
      $alert = '<div class="alert alert-primary" role="alert">Actualizado Correctamente</div>';;
    } else {
      $alert = '<div class="alert alert-danger" role="alert">Error al editar Proveedor</div>';
    }
  }
}

  //MOSTRAR DATOS DE PROVEEDOR EN FORMULARIO
  if(empty($_REQUEST['id']))
  {
    header('Location: listaProveedor.php');
    mysqli_close($conection);
  }
  $codproveedor = $_REQUEST['id'];

  $sql= mysqli_query($conection,"SELECT * FROM proveedor 
                                WHERE codproveedor = $codproveedor 
                                AND estatus = 1 ");
  mysqli_close($conection);
  $result_sql = mysqli_num_rows($sql);

  if($result_sql == 0){
    header('Location: listaProveedor.php');
  }else{
    
    while ($data = mysqli_fetch_array($sql)) {
      
      $codproveedor = $data['codproveedor'];
      $proveedor       = $data['proveedor'];
      $contacto   = $data['contacto'];
      $telefono  = $data['telefono'];
      $direccion = $data['direccion'];
    }
  }
?>


<?php
include_once 'layouts/header.php';
include_once 'layouts/nav.php';
?>

<link href="../view/css/style.css" rel="stylesheet" type="text/css"/>
<main class="app-content">
  <div class="form_register">
  <div class="card bg-light mb-3">
  <div class="card-header" align="center"><h3 align="center">Editar Proveedor <a href="../view/listaProveedor.php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a></h3></div>
  <div class="card-body">
      <form action="" method="post" class="form">
       <?php echo isset($alert) ? $alert : ''; ?>
       <input type="hidden" name="id" value="<?php echo $codproveedor ?>">
       <label for="proveedor">Proveedor</label>
       <input type="text" name="proveedor" id="proveedor" placeholder="Nombre del Proveedor" value="<?php echo $proveedor ?>">
       <label for="contacto">Contacto</label>
       <input type="text" name="contacto" id="contacto" placeholder="Nombre Completo del Contacto" value="<?php echo $contacto ?>">
       <label for="telefono">Teléfono</label>
       <input type="number" name="telefono" id="telefono" placeholder="Teléfono" value="<?php echo $telefono ?>">
       <label for="direccion">Dirección</label>
       <input type="text" name="direccion" id="direccion" placeholder="Dirección Completa" value="<?php echo $direccion ?>">
       <input type="submit" value="Actualizar Proveedor" class="btn_save">
     </form>
     </div>
</div>
</div>
</main>

 <?php
 include_once 'layouts/footer.php';
 ?> 

