<?php 

session_start();

include "../conexion.php";  
include_once 'layouts/header.php';
include_once 'layouts/nav.php';
?>

<main class="app-content">
 <div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <div class="table-responsive">
          <div>
            <a href="../view/productos.php" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo</a>
            <a href="../view/factura/reporteProd.php" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i></a>
          </div>
          <br>
          <table class="table">
            <tr>
              <th>Código</th>
              <th>Descripción</th>
              <th>Información</th>
              <th>Precio</th>
              <th>Existencia</th>
              <th>Proveedor</th>
              <th>Descuento</th>
              <th>Acciones</th>
            </tr>
            <?php 
            //Paginador
            $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM producto WHERE estatus = 1 ");
            $result_register = mysqli_fetch_array($sql_registe);
            $total_registro = $result_register['total_registro'];

            $por_pagina = 10;

            if(empty($_GET['pagina']))
            {
              $pagina = 1;
            }else{
              $pagina = $_GET['pagina'];
            }
            $desde = ($pagina-1) * $por_pagina;
            $total_paginas = ceil($total_registro / $por_pagina);

            $query = mysqli_query($conection,"SELECT p.codproducto, p.descripcion,p.informacion, p.precio, p.existencia, p.descuento, pr.proveedor 
              FROM producto p 
              INNER JOIN proveedor pr on p.proveedor = pr.codproveedor 
              WHERE p.estatus = 1 
              ORDER BY p.codproducto ASC LIMIT $desde,$por_pagina");
            mysqli_close($conection);

            $result = mysqli_num_rows($query);
            if($result > 0){
              while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr class="row<?php echo $data["codproducto"]; ?>">
                  <td><?php echo $data["codproducto"]; ?></td>
                  <td><?php echo $data["descripcion"]; ?></td>
                  <td><?php echo $data["informacion"]; ?></td>
                  <td class="celPrecio"><?php echo $data["precio"]; ?></td>
                  <td><?php echo $data["existencia"]; ?></td>
                  <td><?php echo $data["proveedor"]; ?></td>
                  <td class="celDesc"><?php echo $data["descuento"]; ?></td>
                  <?php if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ) { ?>
                   <td>
                    <?php if($_SESSION['rol'] == 1) { ?>
                      <a class="link_add add_product btn btn-primary" product="<?php echo $data["codproducto"]; ?>" href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>

                      <a class="btn btn-warning" href="editarProducto.php?id=<?php echo $data["codproducto"]; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                      <form action="eliminarProducto.php?id=<?php echo $data['codproducto']; ?>" method="post" class="confirmar d-inline">
                       <button class="btn btn-danger" type="submit"><i class='fa fa-trash'></i> </button>
                     </form>
                   <?php } ?>
                 </td>
               <?php } ?>
             </tr>
             <?php 
           }
         }
         ?>
       </table>
       <div class="paginador">
        <ul>
          <?php 
          if($pagina != 1)
          {
           ?>
           <li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
           <li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
           <?php 
         }
         for ($i=1; $i <= $total_paginas; $i++) { 
          if($i == $pagina)
          {
            echo '<li class="pageSelected">'.$i.'</li>';
          }else{
            echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
          }
        }
        if($pagina != $total_paginas)
        {
         ?>
         <li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
         <li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
       <?php } ?>
     </ul>
   </div>
 </div>
</div>
</div>
</div>
</div>
</main>
<?php
include_once 'layouts/footer.php';
?> 
