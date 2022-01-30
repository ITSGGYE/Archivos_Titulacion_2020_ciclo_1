<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $query_delete = mysqli_query($conection, "UPDATE usuario SET estatus = 0 WHERE idusuario = $id");
    mysqli_close($conection);
    header("location: listaUsuario.php");
}
?>