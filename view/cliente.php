<?php

session_start();

include "../conexion.php";

if(!empty($_POST))
{
  $alert='';
    //VALIDAR CAMPOS DE FORMULARIO
  if(empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion']))
  {
    $alert='<div class="alert alert-danger" role="alert">Todo los campos son Obligatorios</div>';
  }else{

   $nit         = $_POST['nit'];
   $nombre      = $_POST['nombre'];
   $telefono    = $_POST['telefono'];
   $direccion   = $_POST['direccion'];
   $usuario_id  = $_SESSION['idUser'];

   $result = 0;

   //NO SE DUPLIQUE INFORMACION EXISTENTE
   if (is_numeric($nit) and $nit !=0) 
   {
    $query = mysqli_query($conection,"SELECT * FROM cliente WHERE nit = '$nit' ");
    $result = mysqli_fetch_array($query);
  }
  if ($result > 0) {
    $alert = '<div class="alert alert-danger" role="alert">El numero de Cedula ya Existe</div>';
  }else{ 
    //REGISTRO DE CLIENTE
    $query_insert = mysqli_query($conection,"INSERT INTO cliente(nit,nombre,telefono,direccion,usuario_id)
                                            VALUES('$nit','$nombre','$telefono','$direccion',$usuario_id)");
    if($query_insert){
     $alert = '<div class="alert alert-primary" role="alert">Cliente Registrado</div>';
   } else {
    $alert = '<div class="alert alert-danger" role="alert">Error al registrar Cliente</div>';
  }
}
mysqli_close($conection);    
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
      <div class="card-header" align="center"><h3 align="center">Registro de Cliente</h3></div>
      <div class="card-body">
        <form action="" method="post" class="form">
          <?php echo isset($alert) ? $alert : ''; ?>
          <label for="nit">Cedula</label>
          <input type="number" name="nit" id="nit" placeholder="Numero de Cedula">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
          <label for="telefono">Teléfono</label>
          <input type="number" name="telefono" id="telefono" placeholder="Teléfono">
          <label for="direccion">Dirección</label>
          <input type="text" name="direccion" id="direccion" placeholder="Dirección Completa">
          <input type="submit" value="Guardar Cliente" class="btn_save">
        </form>
      </div>
    </div>
  </div>
</main>
<?php
include_once 'layouts/footer.php';
?> 