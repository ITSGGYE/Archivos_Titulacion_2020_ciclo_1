  <?php
  $alert = '';

  session_start();

  if (!empty($_SESSION['active'])) {

    header("location: view/dashboard.php");
  }else{

   if (!empty($_POST))
   { 
    //VALIDACIÓN
    if (empty($_POST['usuario']) || empty($_POST['clave']))
    {
      $alert = '<div class="alert alert-danger" role="alert">Ingrese Usuario y Contraseña</div>';
    }else{
      require_once 'conexion.php';
      
      $user =  mysqli_real_escape_string($conection,$_POST['usuario']);
      $pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));

      $query=mysqli_query($conection, "SELECT  u.idusuario,u.nombre,u.correo,u.usuario,r.idrol,r.rol 
                                        FROM usuario u
                                        INNER JOIN rol r
                                        ON u.rol = r.idrol
                                        WHERE u.usuario= '$user' 
                                        AND u.clave= '$pass' AND u.estatus = 1 "); 
      $result= mysqli_num_rows($query);

      if ($result > 0) {
        
        $data= mysqli_fetch_array($query); 
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['idusuario'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['email'] = $data['correo'];
        $_SESSION['user'] = $data['usuario'];
        $_SESSION['rol'] = $data['idrol'];
        $_SESSION['rol_name'] = $data['rol'];

        header("location: view/dashboard.php");
      }else{
        $alert = '<div class="alert alert-danger" role="alert"> Usuario o Contraseña Incorrecta</div>';
        session_destroy();
      }
    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link href="view/css/style.css" rel="stylesheet" type="text/css"/>
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>LOGIN</title>
</head>
<body>
  <section class="material-half-bg">
    <div class="cover"></div>
  </section>
  <section class="login-content">
    <div class="logo" >
      <h1>Farmacia Alejandra</h1>
    </div>
    <div class="login-box">
      <form class="login-form" action="#" method="post">
        <h5 class="login-head">INICIAR SESIÓN</h5>
        <?php echo isset($alert)? $alert : ' '; ?>
        <div class="form-group">
          <label class="control-label"><i class="fa fa-lg fa-fw fa-user"></i>Usuario</label>
          <input class="form-control" type="text" name="usuario" placeholder=" Ingrese Usuario" autofocus>
        </div>
        <div class="form-group">
          <label class="control-label"><i class="fa fa-unlock-alt fa-lg"></i> Contraseña</label>
          <input class="form-control" type="password" name="clave"  placeholder="Ingrese Contraseña">
        </div>
        <div class="form-group">
          <div class="utility">
          </div>
        </div>
        <div class="form-group btn-container">
          <input type="submit" value="INGRESAR" class="btn btn-primary btn-block">
        </div>
      </form>
    </div>
  </section>
  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <script type="text/javascript"> 
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
  </html>