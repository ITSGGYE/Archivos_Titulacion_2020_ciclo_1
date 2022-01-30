<div class="content-wrapper">

  <section class="content-header">

      <ol class="breadcrumb"> </ol>

      <div class="row">
      
    <?php

    if($_SESSION["perfil"] =="Administrador"){

      include "inicio/cajas-superiores.php";

    }

    ?>

    </div> 

     <div class="row">
      
    <?php

    if($_SESSION["perfil"] =="Administrador"){

      include "inicio/foto.php";

    }

    ?>

    </div>
      
             <?php
 
              if($_SESSION["perfil"] =="Secretaria"){

              include "inicio/foto2.php";

            }

            ?>

            <?php
 
              if($_SESSION["perfil"] =="Jefe de bodega"){

              include "inicio/foto3.php";

            }

            ?>
</section>
</div>


           

      