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
  //VALIDAR CAMPOS DEL FORMULARIO
  if( empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion']))
  {
    $alert='<div class="alert alert-danger" role="alert">Todos los campos son Obligatorios</div>';
  }else{

    $idCliente = $_POST['id'];
    $nit    = $_POST['nit'];
    $nombre = $_POST['nombre'];
    $telefono  = $_POST['telefono'];
    $direccion   = $_POST['direccion'];
    
    $result = 0;

    //NO SE DUPLIQUE INFORMACION EXISTENTE 
    if (is_numeric($nit) and $nit !=0) 
    {
      $query = mysqli_query($conection,"SELECT * FROM cliente 
        WHERE (nit = '$nit' AND idcliente != $idCliente) ");

      $result = mysqli_fetch_array($query);
    }
    if($result > 0){
      $alert='<div class="alert alert-danger" role="alert">La Cedula ya existe, Ingrese otra</div>';
    }else{

      if($nit == '')
      {
        $nit = 0;
      }
      $sql_update = mysqli_query($conection,"UPDATE cliente
        SET nit='$nit',nombre = '$nombre', telefono='$telefono',direccion='$direccion'
        WHERE idcliente= $idCliente ");

      if($sql_update){
        $alert='<div class="alert alert-primary" role="alert">Actualizado Correctamente</div>';
      }else{
        $alert='<div class="alert alert-danger" role="alert">Error al editar Cliente</div>';
      }
    }
  }
}

//MOSTRAR DATOS EN EL FORMULARIO
if(empty($_REQUEST['id']))
{
  header('Location: listaCliente.php');
  mysqli_close($conection);
}
$idcliente = $_REQUEST['id'];

$sql= mysqli_query($conection,"SELECT * FROM cliente WHERE idcliente = $idcliente and estatus = 1 ");
mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
  header('Location: listaCliente.php');
}else{
  
  while ($data = mysqli_fetch_array($sql)) {
    
    $idcliente = $data['idcliente'];
    $nit       = $data['nit'];
    $nombre    = $data['nombre'];
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
      <div class="card-header" align="center"><h3 align="center">Editar Cliente <a href="../view/listaCliente.php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a></h3></div>
      <div class="card-body">
        <form action="" method="post" class="form">
          <?php echo isset($alert) ? $alert : ''; ?>
          <input type="hidden" name="id" value="<?php echo $idcliente; ?>">
          <label for="nit">Cedula</label>
          <input type="number" name="nit" id="nit" placeholder="Numero de Cedula"  value="<?php echo $nit; ?>">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo"  value="<?php echo $nombre; ?>">
          <label for="telefono">Teléfono</label>
          <input type="number" name="telefono" id="telefono" placeholder="Teléfono"  value="<?php echo $telefono; ?>">
          <label for="direccion">Dirección</label>
          <input type="text" name="direccion" id="direccion" placeholder="Dirección Completa"  value="<?php echo $direccion; ?>">
          <input type="submit" value="Actualizar Cliente" class="btn_save">
        </form>
      </div>
    </div>
  </div>
</main>
<?php
include_once 'layouts/footer.php';
?> 