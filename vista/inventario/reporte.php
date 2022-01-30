<?php

session_start();
if (empty($_SESSION['active'])) {
    header('location: ../../');
}

?>
<?php require_once '../vista/fragmentos/cabeza_producto.php'; ?>

<body id="inventario">

    <!-- cabecera -->
    <div class="container-fluid">
        <?php require_once '../vista/fragmentos/barra_navegacion_principal.php'; ?>




        <div class="row" style="height: 82vh; text-align: center; margin-left: 18%;">

            <div class="card table " style="width: 15rem;">
                <img src="../libreria/img/logo/reporte_producto.png" class="card-img-top  " alt="...">
                <div class="card-body">
                    <h5 class="card-title">Reporte Venta Unitaria</h5>
                    <p class="card-text">Muesta el reporte de todas las ventas registradas en el sistema</p>
                    <a href="reporte_venta.php" target="_blanck" class="btn btn-dark">Abrir ahora</a>
                </div>
            </div>

            <div class="card table" style="width: 18rem;">
                <img src="../libreria/img/logo/reporte_producto.png" class="card-img-top " alt="...">
                <div class="card-body">
                    <h5 class="card-title">Reporte Entrada De Mercaderia</h5>
                    <p class="card-text">Muesta el reporte de los ingresos de productos al sistema</p>
                    <a href="reporte_mercaderia.php" target="_blanck" class="btn btn-dark">Abrir ahora</a>
                </div>
            </div>

            <div class="card table table" style="width: 15rem;">
                <img src="../libreria/img/logo/reporte_producto.png" class="card-img-top " alt="...">
                <div class="card-body">
                    <h5 class="card-title">Reporte Productos</h5>
                    <p class="card-text">Muesta el reporte de todos los productos existentes en el sistema</p>
                    <a href="reporte_producto.php" target="_blanck" class="btn btn-dark">Abrir ahora</a>
                </div>
            </div>

        </div>


        <!-- inferior -->
        <?php require_once '../vista/fragmentos/barra_inferior_principal.php' ?>
    </div>





</body>

</html>