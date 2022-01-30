<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $codproducto = $_GET['id'];
    $query_delete = mysqli_query($conection, "UPDATE producto 
												SET estatus = 0 WHERE codproducto = $codproducto");
    mysqli_close($conection);
    header("location: listaProducto.php");
}
?>