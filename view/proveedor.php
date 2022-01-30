<?php 
session_start();
if($_SESSION['rol'] != 1)
{
  header("location: ../");
}
include "../conexion.php";

if(!empty($_POST))
{
  $alert='';
  //VALIDAR CAMPOS DE FORMULARIO
  if(empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion']))
  {
    $alert='<div class="alert alert-danger" role="alert">Todos los campos son Obligatorios</div>';
  }else{

    $proveedor   = $_POST['proveedor'];
    $contacto    = $_POST['contacto'];
    $telefono    = $_POST['telefono'];
    $direccion   = $_POST['direccion'];
    $usuario_id  = $_SESSION['idUser'];

    $query_insert = mysqli_query($conection,"INSERT INTO proveedor(proveedor,contacto,telefono,direccion,usuario_id)
      VALUES('$proveedor','$contacto','$telefono','$direccion',$usuario_id)");
    
    if($query_insert){
      $alert='<div class="alert alert-primary" role="alert">Proveedor Registrado</div>';
    }else{
      $alert='<div class="alert alert-danger" role="alert">Error al registrar el Proveedor</div>';
    }
  }
  mysqli_close($conection);   
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
      <div class="card-header" align="center"><h3 align="center">Registro de Proveedor</h3></div>
      <div class="card-body">
        <form action="" method="post" class="form">
          <?php echo isset($alert) ? $alert : ''; ?>
          <label for="proveedor">Proveedor</label>
          <input type="text" name="proveedor" id="proveedor" placeholder="Nombre del Proveedor">
          <label for="contacto">Contacto</label>
          <input type="text" name="contacto" id="contacto" placeholder="Nombre del Contacto">
          <label for="telefono">Teléfono</label>
          <input type="number" name="telefono" id="telefono" placeholder="Teléfono">
          <label for="direccion">Dirección</label>
          <input type="text" name="direccion" id="direccion" placeholder="Dirección">
          <input type="submit" value="Guardar" class="btn_save">
        </form>
      </div>
    </div>
  </div>
</main>

<?php
include_once 'layouts/footer.php';
?> 