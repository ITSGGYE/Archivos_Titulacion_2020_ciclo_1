SELECT codproducto, precio, (precio*0.1)-precio FROM producto WHERE codproducto = 17



<?php 
session_start();
include_once 'layouts/header.php';
include_once 'layouts/nav.php';
?>


<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-list-alt" aria-hidden="true"></i> Reporte de Ventas</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="tile">
        <h5 class="tile-title" align="center"><i class="icon fa fa-cubes"></i> 
        Productos más vendidos</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Código</th>
              <th>Producto</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "../conexion.php";

            $query = mysqli_query($conection,"SELECT p.descripcion, d.codproducto, d.cantidad, SUM(cantidad) AS total
             FROM detallefactura d 
             INNER JOIN producto p 
             WHERE p.codproducto = d.codproducto 
             GROUP BY codproducto 
             ORDER BY total 
             DESC LIMIT 5");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
              while ($data = mysqli_fetch_assoc($query)) { ?>
                <tr>
                  <td><?php echo $data['codproducto']; ?></td>
                  <td><?php echo $data['descripcion']; ?></td>
                  <td><?php echo $data['total']; ?></td>
                </tr>
              <?php }
            } ?>
          </tbody>
        </table>
      </div>
    </div>

    <!--<div class="col-md-6">
      <div class="tile">
        <h5 class="tile-title" align="center"><i class="fa fa-file" aria-hidden="true"></i>
        Reporte de Facturas</h5>
        <h5>Total de Facturas</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody>
             <?php
            include "../conexion.php";

            $query = mysqli_query($conection,"SELECT COUNT(*) AS total FROM factura WHERE estatus = 1");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
              while ($data = mysqli_fetch_assoc($query)) { ?>
                <tr>
                  <td><?php echo $data['total']; ?></td>
                </tr>
                <?php }
            } ?>
          </tbody>
        </table>

        <h5>Facturas Anuladas</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody>
             <?php
            include "../conexion.php";

            $query = mysqli_query($conection,"SELECT COUNT(*) AS total FROM factura WHERE estatus = 2");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
              while ($data = mysqli_fetch_assoc($query)) { ?>
                <tr>
                  <td><?php echo $data['total']; ?></td>
                </tr>
                <?php }
            } ?>
          </tbody>
        </table>
      </div>
    </div>-->
    
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title" align="center"><i class="icon fa fa-shopping-cart"></i>
        Total de ventas por mes</h3>
        <table class="table">
          <thead>
            <tr>
              <th>Enero</th>
              <th>Febrero</th>
              <th>Marzo</th>
              <th>Abril</th>
              <th>Mayo</th>
              <th>Junio</th>
              <th>Julio</th>
              <th>Agosto</th>
              <th>Septiembre</th>
              <th>Octubre</th>
              <th>Noviembre</th>
              <th>Diciembre</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "../conexion.php";

            $query = mysqli_query($conection,"SELECT SUM(IF(MONTH(fecha) = 1, totalfactura, 0)) AS Ene, 
              SUM(IF(MONTH(fecha) = 2, totalfactura, 0)) AS Feb, 
              SUM(IF(MONTH(fecha) = 3, totalfactura, 0)) AS Mar, 
              SUM(IF(MONTH(fecha) = 4, totalfactura, 0)) AS Abr, 
              SUM(IF(MONTH(fecha) = 5, totalfactura, 0)) AS May, 
              SUM(IF(MONTH(fecha) = 6, totalfactura, 0)) AS Jun, 
              SUM(IF(MONTH(fecha) = 7, totalfactura, 0)) AS Jul, 
              SUM(IF(MONTH(fecha) = 8, totalfactura, 0)) AS Ago, 
              SUM(IF(MONTH(fecha) = 9, totalfactura, 0)) AS Sep, 
              SUM(IF(MONTH(fecha) = 10, totalfactura, 0)) AS Oct, 
              SUM(IF(MONTH(fecha) = 11, totalfactura, 0)) AS Nov, 
              SUM(IF(MONTH(fecha) = 12, totalfactura, 0)) AS Dic 
              FROM factura WHERE estatus = 1");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
              while ($data = mysqli_fetch_assoc($query)) { ?>
                <tr>
                  <td><?php echo $data['Ene']; ?></td>
                  <td><?php echo $data['Feb']; ?></td>
                  <td><?php echo $data['Mar']; ?></td>
                  <td><?php echo $data['Abr']; ?></td>
                  <td><?php echo $data['May']; ?></td>
                  <td><?php echo $data['Jun']; ?></td>
                  <td><?php echo $data['Jul']; ?></td>
                  <td><?php echo $data['Ago']; ?></td>
                  <td><?php echo $data['Sep']; ?></td>
                  <td><?php echo $data['Oct']; ?></td>
                  <td><?php echo $data['Nov']; ?></td>
                  <td><?php echo $data['Dic']; ?></td>
                </tr>
              <?php }
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</main>
<?php
include_once 'layouts/footer.php';
?>



SELECT MONTH(fecha) Mes,SUM(totalfactura) AS total FROM factura WHERE YEAR(fecha) = '2021' AND estatus = 1 GROUP BY MONTH(fecha)


/*table{
  border-collapse: collapse;
  font-size: 12pt;
  font-family: 'arial';
  width: 100%;
}
table th{
  text-align: left;
  padding: 10px;
  background:  #009975;
  color: #FFF;
}
table tr{
  background: #FFF;
}
table td{
  padding: 10px;
}*/


/*============ Paginador =============
.paginador ul{
  padding: 15px;
  list-style: none;
  background: #FFF;
  margin-top: 15px;
  display: -webkit-flex;
  display: -moz-flex;
  display: -ms-flex;
  display: -o-flex;
  display: flex;
  justify-content: flex-end;
}
.paginador a, .pageSelected{
  color: #428bca;
  border: 1px solid #ddd;
  padding: 5px;
  display: inline-block;
  font-size: 14px;
  text-align: center;
  width: 35px;
}
.paginador a:hover{
  background: #ddd;
}
.pageSelected{
  color: #FFF;
  background: #428bca;
  border: 1px solid #428bca;
}
/*============ Buscador ============
.form_search{
  display: -webkit-flex;
  display: -moz-flex;
  display: -ms-flex;
  display: -o-flex;
  display: flex;
  float: right;
  background: initial;
  padding: 10px;
  border-radius: 10px;
}
.form_search .btn_search{
  background: #1faac8;
  color: #FFF;
  padding: 0 20px;
  border: 0;
  cursor: pointer;
  margin-left: 10px;
}
=========== */


<!--<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <div>
              <a href="../view/nuevaVenta.php" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nueva Venta</a>
            </div>
            <h5>Buscar por Fecha</h5>
            <form action="buscar_factura.php" method="get" class="form_search_date">
              <label>De: </label>
              <input type="date" name="fecha_de" id="fecha_de" required>
              <label>A </label>
              <input type="date" name="fecha_a" id="fecha_a" required>
              <button type="submit" class="btn_view"><i class="fa fa-search"></i></button>
            </form>
            <table class="table" id="sampleTable">
              <thead>
                <tr>
                 <th>No.</th>
                 <th>Fecha / Hora</th>
                 <th>Cliente</th>
                 <th>Vendedor</th>
                 <th>Estados</th>
                 <th class="textright">Total Facturas</th>
                 <th class="textright">Acciones</th>
               </tr>
             </thead>
             <tbody>
               <?php

               $query = mysqli_query($conection,"SELECT f.nofactura,f.fecha,f.totalfactura,f.codcliente,f.estatus,            
                u.nombre as vendedor,
                cl.nombre as cliente
                FROM factura f 
                INNER JOIN usuario u
                ON f.usuario = u.idusuario
                INNER JOIN cliente cl 
                ON f.codcliente = cl.idcliente
                WHERE f.estatus = 1 
                ORDER BY f.fecha ASC");
               mysqli_close($conection);

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
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>-->


<?php 
session_start();  
include_once 'layouts/header.php';
include_once 'layouts/nav.php';
include "../conexion.php";

$busqueda= '';
$fecha_de= '';
$fecha_a= '';


if ( isset($_REQUEST['busqueda']) && $_REQUEST['busqueda'] == '') 
{
  header("location: ventas.php");
}
if ( isset($_REQUEST['fecha_de']) || isset($_REQUEST['fecha_a']) ) 
{
  if ( $_REQUEST['fecha_de'] == '' || $_REQUEST['fecha_a'] == '') 
  {
    header("location: ventas.php");
  }
}

if(!empty($_REQUEST['busqueda'])) {
  if(!is_numeric($_REQUEST['busqueda'])){
    header("location: ventas.php");
  }
  $busqueda = strtolower($_REQUEST['busqueda']);
  $where = "nofactura = $busqueda";
  $buscar = "busqueda = $busqueda";
}

  if (!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])){
    $fecha_de = $_REQUEST['fecha_de'];
    $fecha_a = $_REQUEST['fecha_a'];

    $buscar = '';

    if ($fecha_de > $fecha_a){
      header("location: ventas.php");
    }else if($fecha_de == $fecha_a) {

      $where = "fecha LIKE '$fecha_de%'";
      $buscar = "fecha_de=$fecha_de&fecha_a=$fecha_a";
    }else{
      $f_de = $fecha_de.' 00:00:00';
      $f_a = $fecha_a.' 23:59:59';
      $where = "fecha BETWEEN '$f_de' AND '$f_a'";
      $buscar = "fecha_de=$fecha_de&fecha_a=$fecha_a";
    }
  }
?>

<main class="app-content">
<link href="../view/css/style.css" rel="stylesheet" type="text/css"/>

<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">

            <!--<form action="buscarVenta.php" method="get" class="form_search"> 
              <input type="text" name="busqueda" id="busqueda" placeholder="No. Factura" value="<?php echo $busqueda ?>">
              <button type="submit" class="btn_search"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>-->

            <div class="buscador">
              <h5>Busqueda por Fecha</h5>
              <form action="buscarVenta.php" method="get" class="form_search_date">
                <label>De: </label>
                <input type="date" name="fecha_de" id="fecha_de" value="<?php echo $fecha_de; ?>" required>
                <label>A </label>
                <input type="date" name="fecha_a" id="fecha_a" value="<?php echo $fecha_a; ?>" 
                required>
                <button type="submit" class="btn_view"><i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form>
            </div>

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
              //Paginador
             $sql_registe = mysqli_query($conection,"SELECT COUNT(*) AS total_registro 
              FROM factura WHERE $where ");
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
              WHERE $where AND f.estatus != 10 
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
               <li><a href="?pagina=<?php echo 1; ?>&<?php echo $buscar; ?>">|<</a></li>
               <li><a href="?pagina=<?php echo $pagina-1; ?>%<?php echo $buscar; ?>"><<</a></li>
               <?php 
             }
             for ($i=1; $i <= $total_paginas; $i++) 
              { 
              if($i == $pagina)
              {
                echo '<li class="pageSelected">'.$i.'</li>';
              }else{
                echo '<li><a href="?pagina='.$i.'&'.$buscar.'">'.$i.'</a></li>';
              }
            }
            if($pagina != $total_paginas)
            {
             ?>
             <li><a href="?pagina=<?php echo $pagina + 1; ?>&<?php echo $buscar; ?>">>></a></li>
             <li><a href="?pagina=<?php echo $total_paginas; ?>&<?php echo $buscar; ?>">>|</a></li>
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



DELIMITER $$
CREATE PROCEDURE descuento_producto(n_precio decimal(6,2), codigo int) 
BEGIN
    
    DECLARE nuevo_total decimal(6,2);
    DECLARE nuevo_precio decimal(6,2);

    DECLARE actual_precio decimal(6,2);

  
    SELECT codproducto, precio INTO actual_precio FROM producto WHERE codproducto = codigo;


    SET nuevo_precio = (actual_precio * n_precio) - actual_precio;
    SET nuevo_total = nuevo_precio;
                                 
    UPDATE producto SET precio = nuevo_total WHERE codproducto = codigo;
    
    SELECT nuevo_total;
    
END;$$
DELIMITER ;









    DECLARE precio_actual decimal(6,2);
    DECLARE descuento decimal(6,2);
    DECLARE precio_final decimal(6,2);
    
    SELECT codproducto, precio INTO precio_final FROM producto WHERE codproducto = codigo;
    SET descuento = precio_actual * descuento;
    SET precio_final = precio_actual - descuento;
                                 
    UPDATE producto SET precio = precio_final WHERE codproducto = codigo;
    
    SELECT precio_final;


BEGIN  
    DECLARE nuevo_precio double;
    DECLARE p_descuento double;
    DECLARE precio double;
   
  SELECT codproducto,precio INTO nuevo_precio, p_descuento FROM producto WHERE codproducto = codigo;
    SET nuevo_precio =  precio * n_precio / 100;
    SET p_descuento = nuevo_precio - precio;
    
    UPDATE producto SET precio = p_descuento WHERE codproducto = codigo;
   



   BEGIN
DECLARE nuevo_total decimal(10,2);
DECLARE nuevo_precio decimal(10,2);

DECLARE pre_actual decimal(10,2);

DECLARE actual_precio decimal(10,2);

SELECT precio INTO actual_precio FROM producto WHERE codproducto = codigo;

SET nuevo_total = actual_precio * n_precio / 100;

SET nuevo_precio = nuevo_total - actual_precio;

UPDATE producto SET precio = nuevo_precio WHERE codproducto = codigo;

SELECT nueva_existencia, nuevo_precio;
END


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
            <table class="table" id="sampleTable">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Precio</th>
                  <th>Existencia</th>
                  <th>Proveedor</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include "../conexion.php";

                $query = mysqli_query($conection, "SELECT
                  p.codproducto,
                  p.descripcion,
                  p.informacion,
                  p.precio,
                  p.existencia,
                  pr.proveedor
                  FROM
                  producto p
                  INNER JOIN proveedor pr ON
                  p.proveedor = pr.codproveedor
                  WHERE
                  p.estatus = 1");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                  while ($data = mysqli_fetch_assoc($query)) { ?>
                    <tr class="row<?php echo $data["codproducto"]; ?>">
                      <td><?php echo $data['codproducto']; ?></td>
                      <td><?php echo $data['descripcion']; ?></td>
                      <td><?php echo $data["informacion"]; ?></td>
                      <td class="celPrecio"><?php echo $data["precio"]; ?></td>
                      <td class="celExistencia"><?php echo $data["existencia"]; ?></td>
                      <td><?php echo $data["proveedor"]; ?></td>
                      <td>
                        <?php if($_SESSION['rol'] == 1) { ?>
                          <a class="link_add add_product btn btn-primary" product="<?php echo $data["codproducto"]; ?>" href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>

                          <a class="btn btn-warning" href="editarProducto.php?id=<?php echo $data["codproducto"]; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                          <form action="eliminarProducto.php?id=<?php echo $data['codproducto']; ?>" method="post" class="confirmar d-inline">
                            <button class="btn btn-danger" type="submit"><i class='fa fa-trash'></i> </button>
                          </form>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php }
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>