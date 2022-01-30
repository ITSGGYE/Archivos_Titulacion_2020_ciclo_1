<?php

session_start();
if (empty($_SESSION['active'])) {
    header('location: ../../');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferreteria Santos - Inicio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../../libreria/css/piel_ferreteria_santos.css">
    <script src="https://kit.fontawesome.com/d3c7217a4d.js" crossorigin="anonymous"></script>

    <style>
        /*============ Ventas ============*/
        .datos_cliente,
        .datos_venta,
        .title_page {
            width: 100%;
            max-width: 900px;
            margin: auto;
            margin-bottom: 20px;
        }

        .navbar li {
            width: 100%;
        }

        #detalle_venta tr {
            background-color: #FFF !important;
        }

        #detalle_venta td {
            border-bottom: 1px solid #CCC;
        }

        .datos {
            /* background-color: #e3ecef; */
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            border: 2px solid #78909C;
            padding: 10px;
            border-radius: 10px;
            margin-top: 10px;
        }

        .action_cliente {
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            align-items: center;
        }

        .datos label {
            margin: 5px auto;
        }

        .wd20 {
            width: 20%;
        }

        .wd25 {
            width: 25%;
        }

        .wd30 {
            width: 30%;
        }

        .wd40 {
            width: 40%;
        }

        .wd60 {
            width: 60%;
        }

        .wd100 {
            width: 100%;
        }

        #div_registro_cliente,
        #div_cancela_registro {
            margin-top: 20px;
        }

        #div_registro_cliente,
        #div_cancela_registro,
        #add_product_venta {
            display: none;
        }

        .displayN {
            display: none;
        }

        .tbl_venta {
            width: 900px;
            max-width: 900px;
            margin: auto;
        }

        .tbl_venta tfoot td {
            font-weight: bold;
        }

        .textright {
            text-align: right;
        }

        .textcenter {
            text-align: center;
        }

        .textleft {
            text-align: left;
        }

        .btn_anular {
            background-color: #f36a6a;
            border: 0;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px;
            margin: 0 3px;
            color: #FFF;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <!-- barra de navegacion -->
        <!-- <section>
            <div class="row inicio">
                <div class="col-sm-2 cabecera usuario"><a href="../index.php"><img src="../../libreria/img/logo/folder_system_15426.png" style="width: 50px; height: 50px;" title="Inicio"></a></div>
                <div class="col-sm-2 cabecera inventario"><a href="../../controlador/Inventario.php"><img src="../../libreria/img/logo/folders_15422.png" style="width: 50px; height: 50px;" title="Inventario"></a></div>
                <div class="col-sm-2 cabecera inventario"><a href="../../vista/pruebas/index.php"><img src="../../libreria/img/logo/invoice_22150.png" style="width: 50px; height: 50px;" title="venta"></a></div>
                <div class="col-sm-2 cabecera analisis"><a href="../../controlador/ProductoEntradaC.php"><img src="../../libreria/img/logo/folder_my_documents_15435.png" style="width: 50px; height: 50px;" title="Movimiento Mercaderia"></a></div>
                <div class="col-sm-2 cabecera registro"><a href="../../controlador/OpinionPublicaC.php"><img src="../../libreria/img/logo/folder_contacts_15440.png" style="width: 50px; height: 50px;" title="El publico"></a></div>
                <div class="col-sm-1 cabecera imprimir"><a href="../../controlador/ReporteC.php"><img src="../../libreria/img/logo/folder_printers_15428.png" style="width: 50px; height: 50px;" title="Reportes"></a></div>
                <div title="Salir" class="col-sm-1 cabecera ajuste"> <a href="../../vista/fragmentos/logout.php"><img src="../../libreria/img/logo/Logout_37127.png" style="width: 50px; height: 50px;" title="Salir"></a></div>
            </div>

        </section> -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto" style="width: 100%;">
                    <li class="nav-item active">
                        <a href="../../vista/index.php">
                            <div class="nav-link cabecera usuario"><img src="../../libreria/img/logo/folder_system_15426.png" style="width: 50px; height: 50px;" title="Inicio"></div>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="../../controlador/Inventario.php">
                            <div class="nav-link cabecera inventario"><img src="../../libreria/img/logo/folders_15422.png" style="width: 50px; height: 50px;" title="Inventario"></div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../vista/pruebas/index.php">
                            <div class="nav-link cabecera Venta"><img src="../../libreria/img/logo/invoice_22150.png" style="width: 50px; height: 50px;" title="venta"></div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../controlador/ProductoEntradaC.php">
                            <div class="nav-link cabecera analisis"><img src="../../libreria/img/logo/folder_my_documents_15435.png" style="width: 50px; height: 50px;" title="Movimiento Mercaderia"></div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../controlador/OpinionPublicaC.php">
                            <div class="nav-link cabecera registro"><img src="../../libreria/img/logo/folder_contacts_15440.png" style="width: 50px; height: 50px;" title="El publico"></div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../controlador/ReporteC.php">
                            <div class="nav-link cabecera imprimir"><img src="../../libreria/img/logo/folder_printers_15428.png" style="width: 50px; height: 50px;" title="Reportes"></div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../vista/fragmentos/logout.php">
                            <div class="nav-link cabecera ajuste"><img src="../../libreria/img/logo/Logout_37127.png" style="width: 50px; height: 50px;" title="Salir"></div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- formulario de ventas -->
    </div>

    <section class="container-fluid">
        <div class="title_page">
            <div class="row">
                <div class="col-9">
                    <h1>Nueva Venta</h1>
                </div>
                <div class="col-3">
                    <a class="btn btn-info" href="./listaVentas.php" style="margin-left: 40px; margin-top: 15px;"><i class="far fa-newspaper"></i> Mostrar Ventas</a>
                </div>
            </div>
        </div>
        <div class="datos_cliente">
            <div class="accion_cliente">
                <h4>Datos del Cliente</h4>
                <a href="#" class="btn_new_cliente btn btn-primary btn-sm btn_new" id="btn_new_cliente"><i class="fas fa-plus"></i> Nuevo cliente</a>
            </div>
            <form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos" autocomplete="off">
                <input type="hidden" name="accion" value="aggCliente">
                <input type="hidden" id="idCliente" name="idCliente" value="" required>
                <div class="wd30">
                    <label>Cedula</label>
                    <input class="form-control" type="text" name="cedula_cliente" id="cedula_cliente" onKeyPress="return soloNumeros(event)" required>
                </div>
                <div class="wd30">
                    <label>Nombre</label>
                    <input class="form-control" type="text" name="nom_cliente" id="nom_cliente" onKeyPress="return soloLetras(event)" disabled required>
                </div>
                <div class="wd30">
                    <label>Telefono</label>
                    <input class="form-control" type="text" name="tel_cliente" id="tel_cliente" onKeyPress="return soloNumeros(event)" disabled required>
                </div>
                <div class="wd100">
                    <label>Dirección</label>
                    <input class="form-control" type="text" name="dir_cliente" id="dir_cliente" disabled required>
                </div>
                <div id="div_registro_cliente" class="wd100" style="align-items: center;">
                    <button type="submit" class="btn btn-success btn_save"><i class="far fa-save fa-lg"></i> Guardar</button>
                    <button class="btn btn-danger btn_cancel" id="cancel"><i class="fas fa-ban fa-lg"></i> Cancelar</button>
                </div>
            </form>
        </div>
        <div class="datos_venta">
            <h4>Datos de Ventas</h4>
            <div class="datos">
                <div class="wd50">
                    <label>Vendedor</label>
                    <p><?php echo $_SESSION['nombres'] . ' ' . $_SESSION['apellidos']; ?></p>
                </div>
                <div class="wd50 textcenter">
                    <label>Acciones</label>
                    <div id="acciones_venta">
                        <a href="#" class="btn btn-danger btn_ok textcenter" id="btn_anular_venta"><i class="fas fa-ban"></i> Anular</a>
                        <a href="#" class="btn btn-primary btn_new textcenter" id="btn_facturar_venta" style="display:none;"><i class="fas fa-edit"></i> Procesar</a>
                    </div>
                </div>
            </div>
        </div>
        <table class="tbl_venta table-sm table-bordered">
            <thead>
                <tr>
                    <th scope="col" width="100px">Código</th>
                    <th width="100px">Descripción</th>
                    <th width="100px">Existencia</th>
                    <th width="100px">Cantidad</th>
                    <th class="textright">Precio</th>
                    <th class="textright">Precio Total</th>
                    <th class="textright" width="100px"> Acción</th>
                </tr>
                <tr>
                    <td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
                    <td id="txt_descripcion">-</td>
                    <td id="txt_existencia">-</td>
                    <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
                    <td id="txt_precio" class="textright">0.00</td>
                    <td id="txt_precio_total" class="textright">0.00</td>
                    <td><a href="#" id="add_product_venta" class="link_add"><i class="fas fa-plus"></i> Agregar</a></td>
                    <!-- <td class="textright"><a href="#" class="link_add"><i class="fas fa-plus"></i> Agregar</a></td> -->
                </tr>
                <tr>
                    <th>Código</th>
                    <th colspan="2">Descripción</th>
                    <th>Cantidad</th>
                    <th class="textright">Precio</th>
                    <th class="textright">Precio Total</th>
                    <th class="textright"> Acción</th>
                </tr>
            </thead>
            <tbody id="detalle_venta">

            </tbody>
            <tfoot id="detalle_total">

            </tfoot>
        </table>
    </section>



    <script src="../../libreria/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="js.js"></script>
    <script>
        $(document).ready(function() {
            var id_user = '<?php echo $_SESSION['idAdmin'] ?>';
            buscarDetalle(id_user);
        });
    </script>

</body>

</html>