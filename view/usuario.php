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
  if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol']))
  {
    $alert='<div class="alert alert-danger" role="alert">Todos los campos son Obligatorios</div>';
  }else{ 
    $nombre = $_POST['nombre'];
    $email  = $_POST['correo'];
    $user   = $_POST['usuario'];
    $clave  = md5($_POST['clave']);
    $rol    = $_POST['rol'];
    //NO SE DUPLIQUE INFORMACION EXISTENTE
    $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' ");
    $result = mysqli_fetch_array($query);
    //SE EVALUA 
    if($result > 0){
      $alert='<div class="alert alert-danger" role="alert">El correo o el Usuario ya existe</div>';
    }else{
      $query_insert = mysqli_query($conection,"INSERT INTO usuario(nombre,correo,usuario,clave,rol)
        VALUES('$nombre','$email','$user','$clave','$rol')");
      if($query_insert){
        $alert='<div class="alert alert-primary" role="alert">Usuario creado Correctamente</div>';
      }else{
        $alert= '<div class="alert alert-danger" role="alert">Error al registrar Usuario</div>';
      }
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
      <div class="card-header" align="center"><h3 align="center">Registro de Usuario</h3></div>
      <div class="card-body">
        <form action="" method="post" class="form">
          <?php echo isset($alert) ? $alert : ''; ?>
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
          <label for="correo">Correo electrónico</label>
          <input type="email" name="correo" id="correo" placeholder="Correo electrónico">
          <label for="usuario">Usuario</label>
          <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario">
          <label for="clave">Clave</label>
          <input type="password" name="clave" id="clave" placeholder="Clave de acceso">
          <label for="rol">Tipo Usuario</label>
          <?php 
          $query_rol = mysqli_query($conection,"SELECT * FROM rol");
          mysqli_close($conection);
          $result_rol = mysqli_num_rows($query_rol);
          ?>
          <select name="rol" id="rol">
            <?php 
            if($result_rol > 0)
            {
              while ($rol = mysqli_fetch_array($query_rol)) {
                ?>
                <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
                <?php 
              }  
            }
            ?>
          </select>
          <input type="submit" value="Crear usuario" class="btn_save">
        </form>
      </div>
    </div>
  </div>
</main>
<?php
include_once 'layouts/footer.php';
?> 