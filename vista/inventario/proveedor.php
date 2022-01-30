<?php

session_start();
if (empty($_SESSION['active'])) {
    header('location: ../../');
}

?>
<?php require_once '../vista/fragmentos/cabeza_proveedor.php'; ?>

<body id="inventario">

    <!-- cabecera -->
    <div class="container-fluid">
        <?php require_once '../vista/fragmentos/barra_navegacion_principal.php'; ?>

        <!-- cuerpo -->
        <div class="row justify-content-around">
            <div class="col-9" id="aqui">
                <!-- aqui se muestra el inventario -->
                <table class="table  table-hover small  table-sm table-responsive" style="height: 75vh; ">

                    <thead class="bg-light ">
                        <!-- clases: thead-light or thead-dark -->
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>FechaRegistro</th>
                            <th>HoraRegistro</th>
                            <th>Especialidad</th>
                            <th>Descripcion</th>
                            <th>Funciones</th>
                        </tr>
                    </thead>

                    <?php foreach ($proveedores as $registro) {
                        $datos = $registro[0] . '||' . $registro[1] . '||' . $registro[2] . '||' . $registro[3] . '||' . $registro[4]
                            . '||' . $registro[5] . '||' . $registro[6] . '||' . $registro[7] . '||' . $registro[8];

                    ?>
                        <tbody>
                            <tr>
                                <th><?php echo 'Provee' . $registro["0"]; //id
                                    ?></th>
                                <td><?php echo $registro["1"]; //nombre
                                    ?></td>
                                <td><?php echo $registro["2"]; //correo
                                    ?></td>
                                <td><?php echo $registro["3"]; //direccion
                                    ?></td>
                                <td><?php echo $registro["4"]; //teleono
                                    ?></td>
                                <td><?php echo $registro["5"]; //fecha
                                    ?></td>
                                <td><?php echo $registro["6"]; //hora
                                    ?></td>
                                <td><?php echo $registro["7"]; //especialdiad
                                    ?></td>
                                <td><?php echo $registro["8"]; //decripcion
                                    ?></td>

                                <td>
                                    <!-- Buttons trigger modal -->
                                    <button class="btn btn-sm fas fa-minus-circle accion" onclick="confirmar('<?php echo $datos ?>');"></button>
                                    <button class="btn btn-sm fas fa-pen-square accion" data-toggle="modal" data-target="#modal_editar_producto" onclick="ver_producto('<?php echo $datos ?>');"></button>
                                </td>
                            </tr>

                        </tbody>
                    <?php } ?>

                </table>

            </div>
            <!-- barra lateral de navegacion del inventario -->
            <div id=>

            </div>
            <div class="col-2 barra">
                <ul class="nav flex-column">
                    <li class="nav-item link">
                        <a class="nav-link" href="Inventario.php">
                            <button class="btn btn-light btn-sm link_barra">Productos &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp
                                <i class="fas fa-shopping-basket"></i>
                            </button>
                        </a>
                    </li>
                    <li class="nav-item link">
                        <a class="nav-link" href="CategoriaC.php">
                            <button class="btn btn-light  btn-sm link_barra link_categori">Categorias &nbsp &nbsp &nbsp &nbsp &nbsp
                                <i class="fab fa-buffer"></i>
                            </button>
                        </a>
                    </li>
                    <li class="nav-item link">
                        <a class="nav-link" href="SeccionC.php">
                            <button class="btn btn-light  btn-sm link_barra ">Secciones &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp
                                <i class="fas fa-boxes"></i>
                            </button>
                        </a>
                    </li>
                    <li class="nav-item link">
                        <a class="nav-link" href="ProveedorC.php">
                            <button class="btn btn-light  btn-sm link_barra">Proveedores &nbsp &nbsp &nbsp&nbsp
                                <i class="fas fa-truck-moving"></i>
                            </button>
                        </a>
                    </li>
                    <li class="nav-item link">
                        <a class="nav-link" href="ClienteC.php">
                            <button class="btn btn-light  btn-sm link_barra">Clientes &nbsp &nbsp &nbsp&nbsp
                                <i class="fas fa-user"></i>
                            </button>
                        </a>
                    </li>
                    <li class="nav-item link">
                        <a class="nav-link" href="#">
                            <button class="btn btn-light  btn-sm link_barra">

                            </button>
                        </a>
                    </li>
                    <li class="nav-item link">
                        <div class="nav-link">
                            <!-- Button trigger modal -->
                            <button class="btn btn-dark btn-sm link_barra" data-toggle="modal" id="agregar" data-target="#modal_agregar_producto" style="font-size: 11px;">Agregar Nuevo &nbsp&nbsp
                    <li class="fas fa-plus-circle"></li>
                    </button>
            </div>
            </li>
            </ul>

            <!-- filtro de busqueda a db -->
            <div class=" " style="margin-top: 10vh;">
                <select name="" id="buscador_vivo" class="form-control">
                    <option style="background-color: red" value="0">Buscando...</option>
                    <?php session_start();
                    foreach ($proveedores2 as $registro) : ?>
                        <option value="<?php echo $_SESSION['id_comprovante'] = $registro[0]; ?>"><?php echo '(' . $registro[0] . ') ' . $registro[1];
                                                                                                endforeach ?></option>
                </select>
            </div>
            <!-- paginador -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item  <?php echo $_GET['p3'] <= 1 ? 'disabled' : ''; ?>"><a class="page-link paginacion_retro" href="ProveedorC.php?p3=<?php echo $_GET['p2'] - 1; ?>">Anterior</a></li>
                    <li class="page-item  <?php echo $_GET['p3'] <= 1 ? 'disabled' : ''; ?>"><a class="page-link paginacion_retro" href="ProveedorC.php?p3=<?php echo 1; ?>">Inicio</a></li>
                    <li class="page-item  <?php echo $_GET['p3'] >= $cantidad_paginacion ? 'disabled' : ''; ?>"><a class="page-link" href="ProveedorC.php?p3=<?php echo $_GET['p2'] + $cantidad_paginacion - 1; ?>">Ultimo</a></li>
                    <li class="page-item  <?php echo $_GET['p3'] >= $cantidad_paginacion ? 'disabled' : ''; ?>"><a class="page-link" href="ProveedorC.php?p3=<?php echo $_GET['p2'] + 1; ?>">Siguiente</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- modal para agregar nuevo proveedor   -->
    <div class="modal fade" id="modal_agregar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Guardar nuevo Proveedor</h5>
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
                            <tr>
                                <td><label>Correo:&nbsp</label></td>
                                <td>
                                    <input type="text" name="correo_i" id="correo_i" class="form-control input entrada_producto">
                                    <div id="mensaje1" class="errores">Campo obligatorio</div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Direccion:&nbsp</label></td>
                                <td>
                                    <input type="text" name="direccion_i" id="direccion_i" class="form-control input entrada_producto">
                                    <div id="mensaje1" class="errores">Campo obligatorio</div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Telefono:&nbsp</label></td>
                                <td>
                                    <input type="text" name="telefono_i" id="telefono_i" class="form-control input entrada_producto">
                                    <div id="mensaje1" class="errores">Campo obligatorio</div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Especialidad:&nbsp</label></td>
                                <td>
                                    <input type="text" name="especialidad_i" id="especialidad_i" class="form-control input entrada_producto">
                                    <div id="mensaje1" class="errores">Campo obligatorio</div>
                                </td>
                            </tr>
                            <tr>
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

    <!-- modal para editar proveedor -->
    <div class="modal fade" id="modal_editar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body small">
                    <form name="actualizar_productos" id="actualizar_productos" method="post">
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
                                <td><label>Correo:&nbsp</label></td>
                                <td>
                                    <input type="text" name="correo_u" id="correo_u" class="form-control input entrada_producto">
                                </td>
                            </tr>
                            <tr>
                                <td><label>Direccion:&nbsp</label></td>
                                <td>
                                    <input type="text" name="direccion_u" id="direccion_u" class="form-control input entrada_producto">
                                </td>
                            </tr>
                            <tr>
                                <td><label>Telefono:&nbsp</label></td>
                                <td>
                                    <input type="text" name="telefono_u" id="telefono_u" class="form-control input entrada_producto">
                                </td>
                            </tr>
                            <tr>
                                <td><label>FechaRegistro:&nbsp</label></td>
                                <td>
                                    <input type="date" name="fecha_u" id="fecha_u" class="form-control input entrada_producto">
                                </td>
                            </tr>
                            <tr>
                                <td><label>HoraRegistro:&nbsp</label></td>
                                <td>
                                    <input type="time" name="hora_u" id="hora_u" class="form-control input entrada_producto">
                                </td>
                            </tr>
                            <tr>
                                <td><label>Especialidad:&nbsp</label></td>
                                <td>
                                    <input type="text" name="especialidad_u" id="especialidad_u" class="form-control input entrada_producto">
                                </td>
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

</body>

</html>