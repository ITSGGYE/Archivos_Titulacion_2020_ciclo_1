<?php 

session_start();  
include_once 'layouts/header.php';
include_once 'layouts/nav.php';
include "../conexion.php";

$query_dash = mysqli_query($conection,"CALL reporte();");
$result_das = mysqli_num_rows($query_dash);
if ($result_das > 0) {
  $data_dash = mysqli_fetch_assoc($query_dash);
  mysqli_close($conection);
}
?>

<main class="app-content">
  <link href="../view/css/style.css" rel="stylesheet" type="text/css"/>

<div class="row">

    <div class="col-md-6 col-lg-3">
      <div class="widget-small primary coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
        <div class="info">
          <h4>Venta por Dia</h4>
          <p><b><?= $data_dash['venta_dia'] ?></b></p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="widget-small info coloured-icon"><i class="icon fa fa-calendar fa-3x"></i>
        <div class="info">
          <h4>VENTA POR MES</h4>
          <p><b><?= $data_dash['venta_mensual'] ?></b></p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="widget-small warning coloured-icon"><i class="icon fa fa-bars fa-3x"></i>
        <div class="info">
          <h4>VENTA POR AñO</h4>
          <p><b><?= $data_dash['venta_anual'] ?></b></p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="widget-small danger coloured-icon"><i class="icon fa fa-usd fa-3x"></i>
        <div class="info">
          <h4>Cantidad de Ventas</h4>
          <p><b><?= $data_dash['venta_total'] ?></b></p>
        </div>
      </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <div>
              <a href="../view/nuevaVenta.php" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo</a>
            </div>
            <br>
            <table class="table">
              <tr>
               <th>No.</th>
               <th>Fecha / Hora</th>
               <th>Cliente</th>
               <th>Vendedor</th>
               <th>Estados</th>
               <th class="textright">Total Facturas</th>
               <th class="textright">Acciones</th>
             </tr>
             <?php 
             include "../conexion.php";
            //Paginador
             $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM factura WHERE estatus != 10 ");
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

            $query = mysqli_query($conection,"SELECT f.nofactura,f.fecha,f.totalfactura,f.codcliente,f.estatus,            
              u.nombre as vendedor,
              cl.nombre as cliente
              FROM factura f 
              INNER JOIN usuario u
              ON f.usuario = u.idusuario
              INNER JOIN cliente cl 
              ON f.codcliente = cl.idcliente
              WHERE f.estatus != 10 
              ORDER BY f.fecha DESC LIMIT $desde,$por_pagina");

            $result = mysqli_num_rows($query);

            if($result > 0){

              while ($data = mysqli_fetch_array($query)) {

                if($data['estatus'] == 1)
                {
                  $estado = '<span class= "pagada"> Pagada</span>';
                }else{
                  $estado = '<span class= "anulada"> Anulada</span>';
                }
                ?>
                <tr id="row_<?php echo $data["nofactura"]; ?>">
                  <td><?php echo $data["nofactura"]; ?></td>
                  <td><?php echo $data["fecha"]; ?></td>
                  <td><?php echo $data["cliente"]; ?></td>
                  <td><?php echo $data["vendedor"]; ?></td>
                  <td class="estado"><?php echo $estado; ?></td>
                  <td class="textright totalfactura"><span>$.</span><?php echo $data["totalfactura"]; ?></td>
                  <td>
                    <div class="div_acciones">
                     <div>
                       <button class="btn_view view_factura" type="button" cl="<?php echo $data["codcliente"]; ?>" 
                        f="<?php echo $data["nofactura"]; ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                      </div>             
                      <?php if($_SESSION['rol'] == 1)
                      {
                        if($data["estatus"] == 1)
                        { 
                          ?>
                          <div class="div_factura">
                            <button class="btn_anular anular_factura" fac="<?php echo $data["nofactura"]; ?>"><i class="fa fa-ban" aria-hidden="true"></i></button>
                          </div>
                        <?php  }else{ ?>
                          <div class="div_factura">
                            <button type="button" class="btn_anular inactive"><i class="fa fa-ban" aria-hidden="true"></i></button>
                          </div>
                        <?php    }
                      }
                      ?>
                    </div>
                  </td>
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
