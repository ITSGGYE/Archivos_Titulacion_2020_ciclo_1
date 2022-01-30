<?php
session_start();
if($_SESSION['rol'] != 1)
{
  header("location: ../");
}

include "../conexion.php";

if(!empty($_POST)){

  $alert='';
  //VALIDAR CAMPOS DEL FORMULARIO
  if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario'])  || empty($_POST['rol']))
  {
    $alert='<div class="alert alert-danger" role="alert">Todos los campos son Obligatorios</div>';
  }else{

    $idUsuario = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email  = $_POST['correo'];
    $user   = $_POST['usuario'];
    $rol    = $_POST['rol'];

    //NO SE DUPLIQUE INFORMACION EXISTENTE 
    $query = mysqli_query($conection,"SELECT * FROM usuario 
     WHERE (usuario = '$user' AND idusuario != $idUsuario)
     OR (correo = '$email' AND idusuario != $idUsuario) ");

    $result = mysqli_fetch_array($query);

    if($result > 0){
      $alert='<div class="alert alert-danger" role="alert">El correo o Usuario ya Existen</div>';
    }else{

      if(empty($_POST['clave']))
      {

        $sql_update = mysqli_query($conection,"UPDATE usuario
          SET nombre = '$nombre', correo='$email',usuario='$user',rol='$rol'
          WHERE idusuario= $idUsuario ");
      }else{
        $sql_update = mysqli_query($conection,"UPDATE usuario
          SET nombre = '$nombre', correo='$email',usuario='$user',clave='$clave', rol='$rol'
          WHERE idusuario= $idUsuario ");
      }
      if($sql_update){
        $alert='<div class="alert alert-primary" role="alert">Actualizado Correctamente</div>';
      }else{
        $alert='<div class="alert alert-danger" role="alert">Error al editar Usuario</div>';        
      }
    }
  }
}

//MOSTRAR DATOS DE USUARIO EN EL FORMULARIO
if (empty($_REQUEST['id'])) 
{
  header('Location: listaUsuario.php');
  mysqli_close($conection);
}
$iduser = $_REQUEST['id'];

$sql= mysqli_query($conection,"SELECT u.idusuario, u.nombre,u.correo,u.usuario, (u.rol) as idrol, (r.rol) as rol
  FROM usuario u
  INNER JOIN rol r
  on u.rol = r.idrol
  WHERE idusuario= $iduser and estatus = 1 ");

mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
  header('Location: listaUsuario.php');
}else{

 $option = '';
 while ($data = mysqli_fetch_array($sql)) {
      
  $iduser  = $data['idusuario'];
  $nombre  = $data['nombre'];
  $correo  = $data['correo'];
  $usuario = $data['usuario'];
  $idrol   = $data['idrol'];
  $rol     = $data['rol'];

  if($idrol == 1){
    $option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
  }else if($idrol == 2){
    $option = '<option value="'.$idrol.'" select>'.$rol.'</option>';  
  }else if($idrol == 3){
    $option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
  }
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
      <div class="card-header" align="center"><h3 align="center">Editar Usuario <a href="../view/listaUsuario.php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a></h3></div>
      <div class="card-body">
        <form action="" method="post" class="form">
          <?php echo isset($alert) ? $alert : ''; ?>
          <input type="hidden" name="id" value="<?php echo $iduser; ?>">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
          <label for="correo">Correo electrónico</label>
          <input type="email" name="correo" id="correo" placeholder="Correo electrónico" value="<?php echo $correo; ?>">
          <label for="usuario">Usuario</label>
          <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>">
        <!--<label for="clave">Clave</label>
          <input type="password" name="clave" id="clave" placeholder="Clave de acceso">-->
          <label for="rol">Tipo Usuario</label>

          <?php
          include "../conexion.php";
          $query_rol = mysqli_query($conection,"SELECT * FROM rol");
          mysqli_close($conection);
          $result_rol = mysqli_num_rows($query_rol);
          ?>
          <select name="rol" id="rol" class="notItemOne">
            <?php
            echo $option; 
            if ($result_rol > 0) 
            {
              while ($rol = mysqli_fetch_array($query_rol)) {            
                ?>
                <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
                <?php
              }
            }
            ?>
          </select>
          <input type="submit" value="Actualizar Usuario" class="btn_save">
        </form>
      </div>
    </div>
  </div>
</main>

<?php
include_once 'layouts/footer.php';
?> 