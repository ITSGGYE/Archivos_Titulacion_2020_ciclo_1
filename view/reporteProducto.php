<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reporte</title>
</head>
<style type="text/css">
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}
th{
  background-color: #009975;
}
 .img{
   text-align: center;
 }
 h2{
  text-align: center;
  text-transform: uppercase;
}
h3{
  font-weight: bold;
}
</style>
<body>
  <div class="img">
    <img src="img/icono2.png" style="width: 100px;">
  </div>
  <h2>Farmacia Alejandra</h2>
  <h3>Reporte de Productos</h3>
  <table>
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Precio</th>
        <th>Existencia</th>
        <th>Proveedor</th>
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
        p.estatus = 1 ORDER BY codproducto ASC");
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
          </tr>
        <?php }
      } ?>
    </tbody>
  </table>
</body>
</html>
