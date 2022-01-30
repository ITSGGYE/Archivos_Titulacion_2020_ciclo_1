<?php

use Dompdf\Css\Style;

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
            <div class="col-10" id="aqui">
                <!-- aqui se muestra el inventario -->
                <table class="table  table-hover small  table-sm table-responsive" style="height: 75vh; ">

                    <thead class="bg-light ">
                        <!-- clases: thead-light or thead-dark -->
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Marca </th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>FechaRegistro</th>
                            <th>HoraRegistro</th>
                            <th>Proveedor</th>
                            <th>Categoria</th>
                            <th>Seccion</th>
                            <th>Descripcion</th>
                            <!-- <th>Imagen</th> -->
                            <th>Funciones</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($productos as $registro) {
                            $datos = $registro[0] . '||' . $registro[1] . '||' . $registro[2] . '||' . $registro[3] . '||' . $registro[4] . '||' . $registro[5] . '||' .
                                $registro[6] . '||' . $registro[7] . '||' . $registro[8] . '||' . $registro[9] . '||' . $registro[10] . '||' . $registro[11] . '||' . $registro[12] . '||' . $registro[13] . '||' . $registro[14];
                            if ($registro["4"] <= 10) {
                                $alert = 'class="alert alert-danger" role="alert"';
                                $color = 'style="background:red"';
                            } elseif ($registro["4"] <= 20) {
                                $alert = 'class="alert alert-warning" role="alert"';
                                $color = 'style="background:orange"';
                            } else {
                                $alert = '';
                                $color = '';
                            }
                        ?>
                            <tr <?php echo $alert; ?>>
                                <th><?php echo 'Produc' . $registro["0"]; //id
                                    ?></th>
                                <td><?php echo $registro["1"]; //nombre
                                    ?></td>
                                <td><?php echo $registro["2"]; //marca
                                    ?></td>
                                <td><?php echo $registro["3"]; //precio
                                    ?></td>
                                <td <?php echo $color; ?>><?php echo $registro["4"]; //stock
                                                            ?></td>
                                <?php session_start();
                                $_SESSION['aqui'] = $registro['4'];   ?>
                                <td><?php echo $registro["5"]; //fecha
                                    ?></td>
                                <td><?php echo $registro["6"]; //hora
                                    ?></td>
                                <td><?php echo $registro["7"]; //proveedor
                                    ?></td>
                                <td><?php echo $registro["8"]; //categoria
                                    ?></td>
                                <td><?php echo $registro["9"]; //seccion
                                    ?></td>
                                <td><?php echo $registro["10"]; //descripcion
                                    ?></td>
                                <!-- imagen -->
                                <!-- <td><a href="../libreria../img/galeria/<?php echo $registro['11']; ?>" target="_blank"><i class="fas fa-image accion " title="Ver imagen"></i></td> -->
                                <td>
                                    <!-- Buttons trigger modal -->
                                    <!-- vender -->
                                    <button class="btn btn-sm fas fa-plus-circle accion" data-toggle="modal" data-target="#modal_vender_producto" onclick="ver_producto_u('<?php echo $datos ?>');"></button>
                                    <!-- eliminar -->
                                    <button class="btn btn-sm fas fa-minus-circle accion" onclick="confirmar('<?php echo $datos ?>');"></button>
                                    <!-- editar -->
                                    <button class="btn btn-sm fas fa-pen-square accion" data-toggle="modal" data-target="#modal_editar_producto" onclick="ver_producto('<?php echo $datos ?>');"></button>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>

            </div>
            <!-- barra lateral de navegacion del inventario -->
            <div id=>

            </div>
            <div class="col-2 barra" style="margin-left: 0px; padding-left: 0px">
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
            <!-- filtro, busqueda a db -->
            <div class=" " style="margin-top: 10vh;">
                <select name="" id="buscador_vivo" class="form-control">
                    <option value="0">Buscando...</option>
                    <?php session_start();
                    foreach ($productos2 as $registro) :
                    ?>
                        <option value="<?php echo $_SESSION['id_comprovante'] = $registro[0]; ?>">
                        <?php echo '(' . $registro[0] /* por id */ . ') ' . $registro[1] /* por nombre */ . '. ' . $registro[2] /* por marca */ . '. ' .
                            $registro[3] /* por precio */ . '. ' . $registro[4] /* por stock */;
                    endforeach ?>
                        </option>
                </select>
            </div>
            <!-- paginador -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <!-- anterior -->
                    <li class="page-item  <?php echo $_GET['p'] <= 1 ? 'disabled' : ''; ?>"><a class="page-link paginacion_retro" href="Inventario.php?p=<?php echo $_GET['p'] - 1; ?>">Anterior</a></li>
                    <!-- inicio -->
                    <li class="page-item  <?php echo $_GET['p'] <= 1 ? 'disabled' : ''; ?>"><a class="page-link paginacion_retro" href="Inventario.php?p=<?php echo 1; ?>">Inicio</a></li>
                    <!-- ultimo -->
                    <li class="page-item  <?php echo $_GET['p'] >= $cantidad_paginacion ? 'disabled' : ''; ?>"><a class="page-link" href="Inventario.php?p=<?php echo $_GET['p'] + $cantidad_paginacion - 1; ?>">Ultimo</a></li>
                    <!-- siguiente -->
                    <li class="page-item  <?php echo $_GET['p'] >= $cantidad_paginacion ? 'disabled' : ''; ?>"><a class="page-link" href="Inventario.php?p=<?php echo $_GET['p'] + 1; ?>">Siguiente</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- modal para agregar nuevo producto (oculto)  -->
    <div class="modal fade" id="modal_agregar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Guardar nuevo producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body small">
                    <form name="ingresar_productos" id="ingresar_productos" method="post" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td><label>Nombre:&nbsp</label></td>
                                <td>
                                    <input type="text" name="nombre_i" id="nombre_i" class="form-control input entrada_producto">
                                    <div id="mensaje1" class="errores">Campo obligatorio</div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Marca:&nbsp</label></td>
                                <td>
                                    <input type="text" name="marca_i" id="marca_i" class="form-control input entrada_producto">

                                </td>
                            </tr>
                            <tr>
                                <td><label>Precio:&nbsp</label></td>
                                <td>
                                    <input type="text" name="precio_i" id="precio_i" class="form-control input entrada_producto">
                                    <div id="mensaje2" class="errores">Campo obligatorio</div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Stock:&nbsp</label></td>
                                <td><input type="text" name="stock_i" id="stock_i" class="form-control input entrada_producto"></td>
                            </tr>
                            <tr>
                                <td><label>Proveedor:&nbsp</label></td>
                                <td>
                                    <select name="proveedor_i" class="form-control entrada_producto" id="proveedor_i">
                                        <?php foreach ($proveedores as $registro) : ?>
                                            <option value="<?php echo $registro['0']; ?>"><?php echo $registro['1'];
                                                                                        endforeach ?></option>
                                    </select>
                                    <!--  <input type="text" name="proveedor_i" id="proveedor_i" class="form-control input entrada_producto" > -->
                                    <div id="mensaje3" class="errores">Campo obligatorio</div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Categoria:&nbsp</label></td>
                                <td>
                                    <select name="categoria_i" class="form-control entrada_producto" id="categoria_i">
                                        <?php foreach ($categorias as $registro) : ?>
                                            <option value="<?php echo $registro['0']; ?>"><?php echo $registro['1'];
                                                                                        endforeach ?></option>
                                    </select>
                                    <!-- <input type="text" name="categoria_i" id="categoria_i" class="form-control input entrada_producto"> -->
                                    <div id="mensaje4" class="errores">Campo obligatorio</div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Seccion:&nbsp</label></td>
                                <td>
                                    <select name="seccion_i" class="form-control entrada_producto" id="seccion_i">
                                        <?php foreach ($secciones as $registro) : ?>
                                            <option value="<?php echo $registro['0']; ?>"><?php echo $registro['1'];
                                                                                        endforeach ?></option>
                                    </select>
                                    <!-- <input type="text" name="seccion_i" id="seccion_i" class="form-control input entrada_producto"> -->
                                    <div id="mensaje5" class="errores">Campo obligatorio</div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Descripcion:&nbsp</label></td>
                                <td><textarea name="descripcion_i" id="descripcion_i" cols="24" rows="3" class="form-control descripcion"></textarea></td>
                            </tr>
                            <tr>
                                <td><label>Imagen:&nbsp</label></td>
                                <td>
                                    <input type="file" name="imagen_i" id="imagen_i" class="form-control input entrada_producto">
                                    <input type="hidden" name="" id="id_producto">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-dark" data-dismiss="modal" name="agregar_producto" id="agregar_producto" onclick="agregar_producto();" value="Guardar Cambios">
                    <input type="button" class="btn btn-dark" name="limpiar" id="limpiar" value="Limpiar">
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
                            <!--  -->
                            <tr>
                                <td><label>Codigo:&nbsp</label></td>
                                <td><input type="text" name="id_u4" id="id_u4" readonly="readonly" class="form-control input entrada_producto" value=""></td>
                            </tr>
                            <tr>
                                <td><label>Nombre:&nbsp</label></td>
                                <td>
                                    <input type="hidden" name="id_u" id="id_u"><!-- id para actualizar -->
                                    <input type="hidden" name="id_i" id="id_i"><!-- id para eliminar -->
                                    <input type="text" name="nombre_u" id="nombre_u" class="form-control input entrada_producto">
                                </td>
                            </tr>
                            <tr>
                                <td><label>Marca:&nbsp</label></td>
                                <td><input type="text" name="marca_u" id="marca_u" class="form-control input entrada_producto" value=""></td>
                            </tr>
                            <tr>
                                <td><label>Precio:&nbsp</label></td>
                                <td><input type="text" name="precio_u" id="precio_u" class="form-control input entrada_producto" value=""></td>
                            </tr>
                            <tr>
                                <td><label>Stock:&nbsp</label></td>
                                <td><input type="text" name="stock_u" id="stock_u" class="form-control input entrada_producto" value=""></td>
                            </tr>
                            <tr>
                                <td><label>FechaRegistro:&nbsp</label></td>
                                <td><input type="date" name="fecha_u" id="fecha_u" class="form-control input entrada_producto" value=""></td>
                            </tr>
                            <tr>
                                <td><label>HoraRegistro:&nbsp</label></td>
                                <td><input type="time" name="hora_u" id="hora_u" class="form-control input entrada_producto" value=""></td>
                            </tr>
                            <tr>
                                <td><label>Proveedor:&nbsp</label></td>
                                <td>
                                    <select name="proveedor_u" class="form-control entrada_producto" id="proveedor_u">
                                        <?php foreach ($proveedores as $registro) : ?>
                                            <option value="<?php echo $registro['0']; ?>"><?php echo $registro['1'];
                                                                                        endforeach ?></option>
                                    </select>
                                    <!-- <input type="text" name="" id="proveedor_u" class="form-control input entrada_producto" value=""> -->
                                </td>
                            </tr>
                            <tr>
                                <td><label>Categoria:&nbsp</label></td>
                                <td>
                                    <select name="categoria_u" class="form-control entrada_producto" id="categoria_u">
                                        <?php foreach ($categorias as $registro) : ?>
                                            <option value="<?php echo $registro['0']; ?>" selected><?php echo $registro['1'];
                                                                                                endforeach ?></option>
                                    </select>
                                    <!-- <input type="text" name="" id="categoria_u" class="form-control input entrada_producto" value=""> -->
                                </td>
                            </tr>
                            <tr>
                                <td><label>Seccion:&nbsp</label></td>
                                <td>
                                    <select name="seccion_u" class="form-control entrada_producto" id="seccion_u">
                                        <?php foreach ($secciones as $registro) : ?>
                                            <option value="<?php echo $registro['0']; ?>"><?php echo $registro['1'];
                                                                                        endforeach ?></option>
                                    </select>
                                    <!-- <input type="text" name="" id="seccion_u" class="form-control input entrada_producto" value=""> -->
                                </td>
                            </tr>
                            <tr>
                                <td><label>Descripcion:&nbsp</label></td>
                                <td><textarea name="descripcion_u" id="descripcion_u" cols="24" rows="3" class="form-control descripcion"></textarea></td>
                            </tr>
                            <!-- <tr>
                                <td><label>Imagen:&nbsp</label></td>
                                <td>
                                    <input type="file" name="imagen_u" id="imagen_u" class="form-control input entrada_producto">
                                </td>
                            </tr> -->
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark" data-dismiss="modal" id="editar_producto" onclick="actualizar_producto();">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal para vender producto  -->
    <div class="modal fade" id="modal_vender_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelu" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelu">Vender Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body small">
                    <form name="actualizar_productos_u" id="actualizar_productos_u" method="post" enctype="multipart/form-data">
                        <table>
                            <!--  -->
                            <tr>
                                <td><label>Codigo:&nbsp</label></td>
                                <td><input type="text" name="id_u5" id="id_u5" readonly="readonly" class="form-control input entrada_producto" value=""></td>
                            </tr>
                            <tr>
                                <td><label>Nombre:&nbsp</label></td>
                                <td>
                                    <input type="hidden" name="id_u2" id="id_u2"><!-- id para actualizar -->
                                    <input type="hidden" name="id_i2" id="id_i2"><!-- id para eliminar -->
                                    <input type="text" name="nombre_u2" id="nombre_u2" readonly="readonly" class="form-control input entrada_producto">
                                </td>
                            </tr>
                            <tr>
                                <td><label>Marca:&nbsp</label></td>
                                <td><input type="text" name="marca_u2" id="marca_u2" readonly="readonly" class="form-control input entrada_producto" value=""></td>
                            </tr>
                            <tr>
                                <td><label>Precio:&nbsp</label></td>
                                <td><input type="text" name="precio_u2" id="precio_u2" readonly="readonly" class="form-control input entrada_producto" value=""></td>
                            </tr>
                            <tr>
                                <td><label>Stock:&nbsp</label></td>
                                <td><input type="text" name="stok_u2" id="stock_u2" readonly="readonly" class="form-control input entrada_producto" value=""></td>
                            </tr>
                            <tr>
                                <td><label>Vender:&nbsp</label></td>
                                <td><input type="number" min="1" name="stock" id="stock" class="form-control input entrada_producto" value=""></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-dark" data-dismiss="modal" id="editar_productos_u" onclick="actualizar_producto_u();">Generar</button> -->
                    <label id="precio_modal"></label>
                    <button type="submit" class="btn btn-dark" data-dismiss="modal" id="editar_productos_u" onclick="actualizar_producto_u();" style="display:none;">Generar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- inferior -->
    <?php require_once '../vista/fragmentos/barra_inferior_principal.php' ?>
    </div>
</body>

</html>