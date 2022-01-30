<?php 
session_start();
include_once 'layouts/header.php';
include_once 'layouts/nav.php';
?>

<?php

include "../conexion.php";

$query_dash = mysqli_query($conection,"CALL data();");
$result_das = mysqli_num_rows($query_dash);
if ($result_das > 0) {
  $data_dash = mysqli_fetch_assoc($query_dash);
  mysqli_close($conection);
}
?>

<main class="app-content">
  <div class="row">

    <div class="col-md-6 col-lg-3">
      <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Usuarios</h4>
          <p><b><?= $data_dash['usuarios'] ?></b></p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="widget-small info coloured-icon"><i class="icon fa fa-cubes fa-3x"></i>
        <div class="info">
          <h4>Productos</h4>
          <p><b><?= $data_dash['productos'] ?></b></p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Clientes</h4>
          <p><b><?= $data_dash['clientes'] ?></b></p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="widget-small danger coloured-icon"><i class="icon fa fa-bus fa-3x"></i>
        <div class="info">
          <h4>Proveedores</h4>
          <p><b><?= $data_dash['proveedores'] ?></b></p>
        </div>
      </div>
    </div>
  </div>

  <div class="row row-cols-1 row-cols-md-2 g-4" align="center">

    <div class="col">
      <div class="card">
        <div class="card-header bg-dark text-white">
          <i class="fa fa-cubes" aria-hidden="true"></i> PRODUCTOS MÁS VENDIDOS</div>
          <div class="card-body">
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
                ORDER BY total DESC LIMIT 5");
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
    </div>

    <div class="col">
      <div class="card">
        <div class="card-header bg-dark text-white">
          <i class="fa fa-cubes" aria-hidden="true"></i> PRODUCTOS CON STOCK MÍNIMO</div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Producto</th>
                  <th>Existencia</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include "../conexion.php";
                $query = mysqli_query($conection,"SELECT codproducto, descripcion, existencia 
                                                  FROM producto 
                                                  WHERE existencia <= 10 
                                                  ORDER BY existencia ASC LIMIT 10");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                  while ($data = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                      <td><?php echo $data['codproducto']; ?></td>
                      <td><?php echo $data['descripcion']; ?></td>
                      <td><?php echo $data['existencia']; ?></td>
                    </tr>
                  <?php }
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>

  </main>
  <?php
  include_once 'layouts/footer.php';
  ?>