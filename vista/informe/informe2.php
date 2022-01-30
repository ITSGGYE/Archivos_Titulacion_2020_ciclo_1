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

        <!-- cuerpo -->
        <div class="row ">
            <div class="col-12" id="aqui">
                <!-- aqui se muestra el inventario -->
                <table class="table  table-hover small  table-sm table-responsive table-bordered" style="height: 68vh; ">

                    <thead class="bg-light ">
                        <!-- clases: thead-light or thead-dark -->
                        <tr>
                            <th># </th>
                            <th style="width: 15vw;">Fecha Entrada</th>
                            <th style="width: 20vw;">Detalle Entrada</th>
                            <th style="width: 25vw;">Nombre</th>
                            <th style="width: 20vw;">Cantidad</th>
                            <th style="width: 10vw;">Total</th>
                        </tr>
                    </thead>

                    <?php foreach ($productoSalidas as $registro) {
                        $datos = $registro[0] . '||' . $registro[1] . '||' . $registro[2] . '||' . $registro[3] . '||' . $registro[4] . '||' . $registro[4];

                    ?>
                        <tbody>
                            <tr style="height: 10vh;">
                                <th><?php echo 'Sali' . $registro["0"]; //id
                                    ?></th>
                                <td><?php echo $registro["1"]; //fecha
                                    ?></td>
                                <td><?php echo $registro["2"]; //detalle
                                    ?></td>
                                <td><?php echo $registro["3"]; //nombre
                                    ?></td>
                                <td><?php echo $registro["4"] . ' unidades'; //cantidad
                                    ?></td>
                                <td><?php echo '$ ' . $registro["5"]; //total
                                    ?></td>

                                <td>
                                    <!-- Buttons trigger modal -->
                                    <button class="btn btn-sm fas fa-minus-circle " onclick="confirmar('<?php echo $datos ?>');"></button>
                                </td>
                            </tr>

                        </tbody>
                    <?php } ?>

                </table>
                <!-- paginador -->
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item  <?php echo $_GET['p1'] <= 1 ? 'disabled' : ''; ?>"><a class="page-link paginacion_retro" href="ProductoSalidaC.php?p1=<?php echo $_GET['p1'] - 1; ?>">Anterior</a></li>
                        <li class="page-item  <?php echo $_GET['p1'] <= 1 ? 'disabled' : ''; ?>"><a class="page-link paginacion_retro" href="ProductoSalidaC.php?p1=<?php echo 1; ?>">Inicio</a></li>
                        <li class="page-item  <?php echo $_GET['p1'] >= $cantidad_paginacion ? 'disabled' : ''; ?>"><a class="page-link" href="ProductoSalidaC.php?p1=<?php echo $_GET['p1'] + $cantidad_paginacion - 1; ?>">ultimo</a></li>
                        <li class="page-item  <?php echo $_GET['p1'] >= $cantidad_paginacion ? 'disabled' : ''; ?>"><a class="page-link" href="ProductoSalidaC.php?p1=<?php echo $_GET['p1'] + 1; ?>">Siguiente</a></li>
                        <li class="page-item "><a class="page-link" href="ProductoEntradaC.php">Anterior</a></li>
                        <h6><strong>Venta Unitarias</strong></h6>
                    </ul>
                </nav>
            </div>


            <!-- barra lateral de navegacion del inventario -->
            <div id=>

            </div>


        </div>
    </div>

    <!-- modal para agregar nuevo producto (oculto)  -->
    <div class="modal fade" id="modal_agregar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Guardar nueva Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body small">
                    <form name="ingresar_productos" id="ingresar_productos" method="post">
                        <table>
                            <tr>
                                <td><label>Nombre:&nbsp</label></td>
                                <td>
                                    <input type="text" name="nombre_i" id="nombre_i" class="form-control input entrada_producto">
                                    <div id="mensaje1" class="errores">Campo obligatorio</div>
                                </td>
                            </tr>
                            <td><label>Descripcion:&nbsp</label></td>
                            <td><textarea name="descripcion_i" id="descripcion_i" cols="24" rows="3" class="form-control descripcion"></textarea></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal" name="" id="agregar_producto" onclick="agregar_producto();">Guardar cambios</button>
                    <button type="button" class="btn btn-dark" name="limpiar" id="limpiar">Limpiar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal para editar producto (oculto)  -->
    <div class="modal fade" id="modal_editar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body small">
                    <form name="actualizar_productos" id="actualizar_productos" method="post" enctype="multipart/form-data">
                        <table>
                            <!-- los valoes de los campos son preparados por ajax -->
                            <tr>
                                <td><label>Nombre:&nbsp</label></td>
                                <td>
                                    <input type="hidden" name="id_u" id="id_u"><!-- id para actualizar -->
                                    <input type="hidden" name="id_i" id="id_i"><!-- id para eliminar -->
                                    <input type="text" name="nombre_u" id="nombre_u" class="form-control input entrada_producto">
                                </td>
                            </tr>
                            <tr>
                                <td><label>FechaRegistro:&nbsp</label></td>
                                <td><input type="text" name="fecha_u" id="fecha_u" class="form-control input entrada_producto" value=""></td>
                            </tr>
                            <tr>
                                <td><label>HoraRegistro:&nbsp</label></td>
                                <td><input type="text" name="hora_u" id="hora_u" class="form-control input entrada_producto" value=""></td>
                            </tr>
                            <tr>
                                <td><label>Descripcion:&nbsp</label></td>
                                <td><textarea name="descripcion_u" id="descripcion_u" cols="24" rows="3" class="form-control descripcion"></textarea></td>
                            </tr>

                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark" data-dismiss="modal" id="editar_producto" onclick="actualizar_producto();">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- inferior -->
    <?php require_once '../vista/fragmentos/barra_inferior_principal.php' ?>
    </div>




    <?php require_once '../vista/fragmentos/pie.php'; ?>
</body>

</html>