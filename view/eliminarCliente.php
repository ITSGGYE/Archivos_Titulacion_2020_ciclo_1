<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $query_delete = mysqli_query($conection, "UPDATE cliente SET estatus = 0 WHERE idcliente = $id");
    mysqli_close($conection);
    header("location: listaCliente.php");
}
?>