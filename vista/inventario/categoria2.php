<?php

session_start();
if (empty($_SESSION['active'])) {
    header('location: ../../');
}

?>
<?php require_once '../vista/fragmentos/cabeza.php'; ?>

<body>
    <div class="container-fluid">
        <?php require_once '../vista/fragmentos/barra_navegacion_principal.php'; ?>

        <!-- cuerpo -->
        <div class="row ">
            <div class="col-10">
                <table class="table  table-hover small  table-sm   " style="height: ; ">
                    <thead class="bg-light ">
                        <!-- thead-light or thead-dark -->
                        <tr>
                            <th># </th>
                            <th>Nombre </th>
                            <th>FechaRegistro</th>
                            <th>HoraRegistro</th>
                            <th>Descripcion</th>
                            <th>Funciones</th>
                        </tr>
                    </thead>

                    <?php foreach ($categorias as $registro) { ?>
                        <tbody>
                            <tr>
                                <th><?php echo 'Cate' . $registro["idCategoria"]; ?></th>
                                <td><?php echo $registro["Nombre"]; ?></td>
                                <td><?php echo $registro["FechaRegistro"]; ?></td>
                                <td><?php echo $registro["HoraRegistro"]; ?></td>
                                <td><?php echo $registro["Descripcion"]; ?></td>
                                <td>
                                    <i class="fas fa-plus-circle"></i>
                                    <i class="fas fa-minus-circle"></i>
                                    <i class="fas fa-pen-square"></i>
                                    <i class="fas fa-tag"></i>
                                </td>
                            </tr>

                        </tbody>
                    <?php } ?>
                </table>
            </div>

            <div class="col-2 barra" style="text-align: ">

                <ul class="nav flex-column">
                    <li class="nav-item link">
                        <a class="nav-link link_producto" href="Inventario.php">Producto</a>
                    </li>
                    <li class="nav-item link">
                        <a class="nav-link link_categoria" href="#">Categoria</a>
                    </li>
                    <li class="nav-item link">
                        <a class="nav-link" href="#">Seccion</a>
                    </li>
                    <li class="nav-item link">
                        <a class="nav-link" href="#">Proveedo</a>
                    </li>
                    <li class="nav-item link">
                        <a class="nav-link" href="#">Usuario</a>
                    </li>
                    <li class="nav-item link">
                        <a class="nav-link" href="#">Adminitrador</a>
                    </li>
                </ul>

                <!-- filtro de busqueda a db -->
                <div class="filtrar">
                    <input class="" type="text" name="buscar" placeholder="Buscar">
                </div>
                <!-- paginador -->
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item  <?php echo $_GET['p'] <= 1 ? 'disabled' : ''; ?>"><a class="page-link paginacion_retro" href="CategoriaC.php?p=<?php echo $_GET['p'] - 1; ?>">Anterior</a></li>
                        <li class="page-item  <?php echo $_GET['p'] <= 1 ? 'disabled' : ''; ?>"><a class="page-link paginacion_retro" href="CategoriaC.php?p=<?php echo 1; ?>">Inicio</a></li>
                        <!-- <?php for ($i = 0; $i < $cantidad_paginacion; $i++) : ?> 
                            <li class="page-item <?php echo $_GET['p'] == $i + 1 ? 'active' : ''  ?> "><a class="page-link paginacion" href="CategoriaC.php?p=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                        <?php endfor ?> -->
                        <li class="page-item  <?php echo $_GET['p'] >= $cantidad_paginacion ? 'disabled' : ''; ?>"><a class="page-link" href="CategoriaC.php?p=<?php echo $_GET['p'] + 1; ?>">Siguiente</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- inferior -->
        <div class="row pie">
            <div class="col-3" style="text-align: left;">
                <a href="#">
                    <-</a> Admin: Armijos Carlos </div> <div class="col-6" style="text-align: center;">
                        FERRETERIA SANTOS<br />Coop Nueva Prosperina Mz.2164 Sl.16
            </div>

            <!-- cargar hora y fecha -->
            <div class="col-3 " style="text-align: right;">
                <div id="recargar_hora"></div>
            </div>

        </div>
    </div>

    <?php require_once '../vista/fragmentos/pie.php'; ?>

</body>

</html>