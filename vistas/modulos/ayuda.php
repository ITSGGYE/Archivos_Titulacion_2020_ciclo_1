<?php

if($_SESSION["perfil"] == "Jefe de bodega" || $_SESSION["perfil"] == "Secretaria"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
  
  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="input-group">

          <h4> Manual del sistema de inventario *JUNIL* </h4>

               </div>



        <div class="grid_4">
        	<a href="extensiones/tcpdf/pdf/manual.php" class="btn" target="_blank"> Dar click aquí</a>

  
        </div>

      </div>

      <h1>

      	<img src="https://reporte32mx.com/wp-content/uploads/2020/05/El-mejor-libro-asdaa.jpg" border="1" alt="1" width="1300" height="372">

      </h1>  
  
  </section>

 </div>
