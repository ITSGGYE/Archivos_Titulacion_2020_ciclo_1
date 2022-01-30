<?php 
session_start();
if($_SESSION['rol'] != 1)
{
  header("location: ../");
}

include "../conexion.php";

if (!empty($_POST)) {

  $alert = "";
  if (empty($_POST['producto'])) {

    $alert = '<div class="alert alert-primary" role="alert">Todos los campos son Obligatorios</div>';

  } else {
    $codproducto = $_GET['id'];
    $proveedor = $_POST['proveedor'];
    $producto = $_POST['producto'];
    $informacion = $_POST['informacion'];
    $precio = $_POST['precio'];
    $existencia = $_POST['existencia'];
    $descuento = $_POST['descuento'];

    $query_update = mysqli_query($conection, "UPDATE producto 
                                              SET descripcion = '$producto', 
                                                  informacion = '$informacion', 
                                                  proveedor= '$proveedor',
                                                  precio= '$precio',
                                                  existencia= '$existencia',
                                                  descuento= '$descuento'
                                              WHERE codproducto = $codproducto");
    if ($query_update) {

      $alert = '<div class="alert alert-primary" role="alert">Producto Actualizado</div>';

    } else {

      $alert = '<div class="alert alert-primary" role="alert">Error al editar Producto</div>';
    }
  }
}

//VALIDAR PRODUCTO
if(empty($_REQUEST['id'])){
  header("location: listaProducto.php");
} else {
  $id_producto = $_REQUEST['id'];
  if(!is_numeric($id_producto)){
    header("location: listaProducto.php");
  }

  $query_producto = mysqli_query($conection, "SELECT p.codproducto, p.descripcion,p.informacion,
                                              p.precio, p.existencia,p.descuento,      
                                              pr.codproveedor, 
                                              pr.proveedor FROM producto p
                                              INNER JOIN proveedor pr
                                              ON p.proveedor = pr.codproveedor
                                              WHERE p.codproducto = $id_producto AND  p.estatus = 1");

  $result_producto = mysqli_num_rows($query_producto);

  if($result_producto >0){
    $data_producto = mysqli_fetch_assoc($query_producto);
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
  <div class="card-header" align="center"><h3 align="center">Editar Producto <a href="../view/listaProducto.php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a></h3></div>
  <div class="card-body">
      <form action="" method="post" enctype="multipart/form-data" class="form">
        <?php echo isset($alert) ? $alert : ''; ?>
        <label for="proveedor">Proveedor</label>
        <?php 

        $query_proveedor = mysqli_query(
          $conection,"SELECT codproveedor, proveedor FROM proveedor WHERE estatus = 1
          ORDER BY proveedor ASC ");
        $result_proveedor = mysqli_num_rows($query_proveedor);
        mysqli_close($conection);
        ?>
        <select name="proveedor" id="proveedor" class="notItemOne">
          <option value="<?php echo $data_producto['codproveedor']; ?>" selected><?php echo $data_producto['proveedor']; ?></option>}
          option 
          <?php 

          if ($result_proveedor > 0) {
            while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                # code...
              ?>
              <option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>
              <?php 
            }
          }
          ?>
        </select>
        <label for="producto">Producto</label>
        <input type="text" name="producto" id="producto" placeholder="Nombre del producto" value="<?php echo $data_producto['descripcion']; ?>">
        <label for="producto">Descripción</label>
        <input type="text" name="informacion" id="informacion" placeholder="Descripción del producto" value="<?php echo $data_producto['informacion']; ?>">
        <label for="producto">Precio</label>
        <input type="text" name="precio" id="precio" placeholder="Precio del producto" value="<?php echo $data_producto['precio']; ?>">
        <label for="producto">Cantidad</label>
        <input type="number" name="existencia" id="existencia" placeholder="Existencia del producto" value="<?php echo $data_producto['existencia']; ?>">
        <label for="producto">Descuento</label>
        <input type="number" name="descuento" id="descuento" placeholder="Descuento" value="<?php echo $data_producto['descuento']; ?>">
        <input type="submit" value="Actualizar Producto" class="btn_save">
      </form>
    </div>
</div>
</div>
</main>
  <?php
  include_once 'layouts/footer.php';
  ?> 