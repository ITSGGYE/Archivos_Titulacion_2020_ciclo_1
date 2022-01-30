<?php 
session_start();
if($_SESSION['rol'] != 1)
{
  header("location: ../");
}

include "../conexion.php";

if (!empty($_POST)) {

  $alert = "";
  if (empty($_POST['proveedor']) || empty($_POST['producto']) || empty($_POST['informacion']) || empty($_POST['precio']) || $_POST['precio'] <  0 || empty($_POST['cantidad'] || $_POST['cantidad'] <  0)) {

    $alert = '<div class="alert alert-danger" role="alert">Todos los campos son Obligatorios</div>';
  } else {
    $proveedor = $_POST['proveedor'];
    $producto = $_POST['producto'];
    $informacion = $_POST['informacion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $usuario_id = $_SESSION['idUser'];

    $query_insert = mysqli_query($conection, "INSERT INTO producto(proveedor,descripcion,informacion,precio,existencia,usuario_id) 
      values ('$proveedor', '$producto','$informacion', '$precio', '$cantidad','$usuario_id')");
    if ($query_insert) {

      $alert = '<div class="alert alert-primary" role="alert">Producto Registrado</div>';

    } else {

      $alert = '<div class="alert alert-danger" role="alert">Error al registrar el Producto</div>';
    }
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
      <div class="card-header" align="center"><h3 align="center">Registro de Productos</h3></div>
      <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data" class="form">
          <?php echo isset($alert) ? $alert : ''; ?>
          <label for="proveedor">Proveedor</label>
          <?php 

          $query_proveedor = mysqli_query($conection,"SELECT codproveedor, proveedor FROM proveedor WHERE estatus = 1
            ORDER BY proveedor ASC ");

          $result_proveedor = mysqli_num_rows($query_proveedor);
          mysqli_close($conection);

          ?>
          <select name="proveedor" id="proveedor">
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
          <input type="text" name="producto" id="producto" placeholder="Nombre del producto">
          <label for="producto">Descripción</label>
          <input type="text" name="informacion" id="informacion" placeholder="Descripción del producto">
          <label for="precio">Precio</label>
          <input type="text" name="precio" id="precio" placeholder="Precio del producto">
          <label for="cantidad">Cantidad</label>
          <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del producto">
          <input type="submit" value="Guardar" class="btn_save">

        </form>
      </div>
    </div>
  </div>
</main>
<?php
include_once 'layouts/footer.php';
?> 