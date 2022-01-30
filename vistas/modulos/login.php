<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet">

  <link rel="stylesheet" href="vistas/dist/css/estilo-login.css">

  <style>

        body{ 

          background-image: url(https://thumbs.dreamstime.com/b/concepto-de-contabilidad-con-el-teclado-smartphone-cuaderno-la-taza-caf%C3%A9-calculadora-y-dinero-en-fondo-blanco-tabla-130183529.jpg);
          background-repeat: no-repeat;
          background-size: 1370px 700px;
           
        }
        
  </style>

</head>
  
  <div class="login-logo">

    <img src="vistas/img/plantilla/logo.jpg" class="img-responsive">

  </div>

  <div class="login-box-body"> 

  <br></br>

    <p class="login-box-msg"> <strong> Bienvenido al sistema de inventario *JUNIL* </strong> </p> 
  
    <form method="post">

  
        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
    
        <input onClick="#" type="submit" value="Ingresar" name="boton" required>
        
        </div>

      </div>

      <?php

        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
        
      ?>

    </form>

  </div>

</div>
