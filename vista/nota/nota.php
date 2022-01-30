<?php

session_start();
if (empty($_SESSION['active'])) {
    header('location: ../../');
}

?>
<?php require_once '../vista/fragmentos/cabeza_categoria.php'; ?>

<body id="inventario">

    <!-- cabecera -->
    <div class="container-fluid">
        <?php require_once '../vista/fragmentos/barra_navegacion_principal.php'; ?>

        <!-- cuerpo -->
        <div class="row ">
            <div class="col-12" id="aqui">
                <!-- aqui se muestra el inventario -->
                <table class="table  table-hover table table-responsive" style="height: 68vh; ">

                    <thead class="bg-light ">
                        <!-- clases: thead-light or thead-dark -->
                        <tr>
                            <th># Solicitud</th>
                            <th style="width: 15vw;">Nombres </th>
                            <th>Correo </th>
                            <th>Cargo </th>
                            <th>FechaRegistro </th>
                            <th>HoraRegistro </th>
                            <th style="width: 20vw;">Aptitudes </th>
                            <th>Funciones </th>
                        </tr>
                    </thead>

                    <?php
                    if (!empty($opinionPublicas)) {


                        foreach ($opinionPublicas as $registro) {
                            $datos = $registro[0] . '||' . $registro[1] . '||' . $registro[2] . '||' . $registro[3] . '||' . $registro[4];

                    ?>
                            <tbody>
                                <?php
                                if (!empty($registro["7"])) {
                                    # code...

                                ?>
                                    <tr style="height: 20vh;">
                                        <th><?php echo $registro["0"]; //id
                                            ?></th>
                                        <td><?php echo $registro["1"]; //nombre
                                            ?></td>
                                        <td><?php echo $registro["2"]; //marca
                                            ?></td>
                                        <td><?php echo $registro["3"]; //precio
                                            ?></td>
                                        <td><?php echo $registro["4"]; //stock
                                            ?></td>
                                        <td><?php echo $registro["5"]; //stock
                                            ?></td>
                                        <td><?php echo $registro["6"]; //stock
                                            ?></td>

                                        <td>
                                            <!-- Buttons trigger modal -->
                                            <a type="button" target="_black" title="ver" class="btn" href="../libreria/archivosPdf/<?php echo $registro["7"]; ?>">
                                                <i class="fas fa-eye"></i></a>
                                            <button title="eliminar" class="btn btn-sm fas fa-minus-circle " onclick="confirmar('<?php echo $datos ?>');"></button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                    <?php }
                    } ?>

                </table>

            </div>
            <!-- barra lateral de navegacion del inventario -->
            <div id=>

            </div>

            <!-- paginador -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item  <?php echo $_GET['p1'] <= 1 ? 'disabled' : ''; ?>"><a class="page-link paginacion_retro" href="OpinionPublicaC.php?p1=<?php echo $_GET['p1'] - 1; ?>">Anterior</a></li>
                    <li class="page-item  <?php echo $_GET['p1'] <= 1 ? 'disabled' : ''; ?>"><a class="page-link paginacion_retro" href="OpinionPublicaC.php?p1=<?php echo 1; ?>">Inicio</a></li>
                    <!-- <?php for ($i = 0; $i < $cantidad_paginacion; $i++) : ?> 
                            <li class="page-item <?php echo $_GET['p1'] == $i + 1 ? 'active' : ''  ?> "><a class="page-link paginacion" href="Inventario.php?p=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                        <?php endfor ?> -->
                    <li class="page-item  <?php echo $_GET['p1'] >= $cantidad_paginacion ? 'disabled' : ''; ?>"><a class="page-link" href="OpinionPublicaC.php?p1=<?php echo $_GET['p1'] + 1; ?>">Siguiente</a></li>
                </ul>
            </nav>
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