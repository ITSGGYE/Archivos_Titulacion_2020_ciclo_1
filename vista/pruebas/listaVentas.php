<?php

include '../../modelo/ConeccionBD.php';
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
        /*============ Lista de Ventas ============*/
        .buscador_fecha,
        .contenido,
        .title_page {
            width: 100%;
            max-width: 900px;
            margin: auto;
            margin-bottom: 20px;
        }

        .navbar li {
            width: 100%;
        }

        .form_search {
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            float: right;
            display: flex;
            background: #ececec;
            padding: 10px;
            border-radius: 10px;
            margin: auto;
            margin-top: 10px;
        }

        .form_search .btn_search {
            background: #1faac8;
            color: #fff;
            padding: 0 20px;
            border: 0;
            cursor: pointer;
            margin-left: 10px;
            border-radius: 10px;
        }

        .buscador_fecha {
            border-radius: 10px;
        }

        .form_search_date {
            padding: 10px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            border-radius: 10px;
            margin: 10px auto;
            background-color: #fff;
        }

        .form_search_date label {
            margin: 0 10px;
        }

        .form_search_date input {
            width: auto;
        }

        .form_search_date .btn_view .btn_anular {
            padding: 8px;
        }

        .btn_view {
            background-color: #1faac8;
            border: 0;
            border-radius: 5px;
            cursor: pointer;
            padding: 5px;
            margin: 0 3px;
            color: #fff;
        }

        .btn_anular {
            background-color: #f33737;
            border: 0;
            border-radius: 5px;
            cursor: pointer;
            padding: 5px;
            margin: 0 3px;
            color: #fff;
        }

        .div_acciones {
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            justify-content: space-between;
        }

        .pagada,
        .anulada {
            color: #fff;
            background: #60a758;
            text-align: center;
            border-radius: 5px;
            padding: 4px 15px;
        }

        .anulada {
            background: #f36a6a;
        }

        .inactive {
            background-color: #a4a4a4;
            color: #ccc;
            cursor: default;
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

    </div>

    <div class="container-fluid">
        <section class="title_page">
            <div class="row">
                <div class="col-6">
                    <h1 style="margin-top: 10px;"><i class="far fa-newspaper"></i>Listado de Ventas</h1>
                </div>
                <div class="col">
                    <a class="btn btn-info" href="index.php" style="margin-top: 20px;"><i class="fas fa-plus"></i> Nueva Venta</a>
                </div>
                <form action="buscar_venta.php" method="get" class="form_search" autocomplete="off">
                    <input type="text" name="busqueda" id="busqueda" placeholder="No. Factura">
                    <button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </section>
        <section class="buscador_fecha">
            <h5 style="margin: 20px;">Buscar por fecha</h5>
            <form action="buscar_venta.php" method="get" class="form_search_date" style="margin: 20px;" autocomplete="off">
                <label>De: </label>
                <input type="date" name="fecha_de" id="fecha_de" required>
                <label> A </label>
                <input type="date" name="fecha_a" id="fecha_a" required>
                <button type="submit" class="btn_view"><i class="fas fa-search"></i></button>
            </form>
        </section>

        <div class="contenido">
            <div id="aqui">
                <!-- aqui se muestra el inventario -->
                <table class="table table-sm" style="height: auto; ">

                    <thead class="bg-light ">
                        <!-- clases: thead-light or thead-dark -->
                        <tr>
                            <th>No.</th>
                            <th>Fecha/Hora</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Estado</th>
                            <th class="textrigth">Total Factura</th>
                            <th class="textrigth">Acciones</th>
                        </tr>
                    </thead>
                    <?php
                    // paginacion        
                    $sql_register = mysqli_query($cn, "SELECT COUNT(*) as total_registros FROM factura WHERE estatus != 10");
                    $respuesta_register = mysqli_fetch_array($sql_register);
                    $total_register = $respuesta_register['total_registros'];

                    $por_pagina = 5;

                    if (empty($_GET['p'])) {
                        $pagina = 1;
                    } else {
                        $pagina = $_GET['p'];
                    }

                    $desde = ($pagina - 1) * $por_pagina;
                    $totaL_paginas = ceil($total_register / $por_pagina);


                    $query = mysqli_query($cn, "SELECT f.id_factura, f.fecha, f.total_factura, f.id_cliente, f.estatus,
                                            CONCAT(a.Nombres, ' ', a.Apellidos) as vendedor,
                                            cl.nombre as cliente
                                            FROM factura f
                                            INNER JOIN administrador a
                                            ON f.id_admin = a.idAdministrador
                                            INNER JOIN cliente_venta cl
                                            ON f.id_cliente = cl.id_cliente
                                            WHERE f.estatus != 10
                                            ORDER BY f.fecha DESC LIMIT $desde, $por_pagina");

                    mysqli_close($cn);
                    $respuesta = mysqli_num_rows($query);
                    if ($respuesta > 0) {
                        while ($data = mysqli_fetch_array($query)) {
                            if ($data['estatus'] == 1) {
                                $estado = '<span class="pagada">Pagada</span>';
                                $anular = '<button type="button" data-toggle="modal" data-target="#exampleModal" class="btn_anular anular_factura" fac="' . $data['id_factura'] . '"><i class="fas fa-ban"></i></button';
                            } else {
                                $estado = '<span class="anulada">Anulada</span>';
                                $anular = '<button type="button" class="btn_anular inactive"><i class="fas fa-ban"></i></button';
                            }
                    ?>
                            <tbody id="lista_ventas">
                                <tr id="row_<?php echo $data['id_factura'] ?>">
                                    <td><?php echo $data['id_factura'] ?></td>
                                    <td><?php echo $data['fecha'] ?></td>
                                    <td class="textcenter"><?php echo $data['cliente'] ?></td>
                                    <td class="textright"><?php echo $data['vendedor'] ?></td>
                                    <td class="textright estado"><?php echo $estado ?></td>
                                    <td class="textright totalfactura"><span>$</span><?php echo $data['total_factura'] ?></td>
                                    <td>
                                        <div class="div_acciones">
                                            <div>
                                                <button class="btn_view view_factura" type="button" cl="<?php echo $data['id_cliente'] ?>" f="<?php echo $data['id_factura'] ?>">
                                                    <i class="fas fa-eye"></i></button>
                                            </div>
                                            <div class="div_factura"><?php echo $anular ?></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                    <?php
                        }
                    }
                    ?>


                </table>

            </div>


            <div style="margin-left: 0px; padding-left: 0px">
                <!-- paginador -->
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm justify-content-end">

                        <li class="page-item  <?php echo $pagina <= 1 ? 'disabled' : ''; ?>"><a class="page-link paginacion_retro" href="?p=<?php echo $pagina - 1; ?>">Anterior</a></li>

                        <li class="page-item  <?php echo $pagina <= 1 ? 'disabled' : ''; ?>"><a class="page-link paginacion_retro" href="?p=<?php echo 1; ?>">Inicio</a></li>

                        <li class="page-item  <?php echo $pagina >= $totaL_paginas ? 'disabled' : ''; ?>"><a class="page-link" href="?p=<?php echo $totaL_paginas; ?>">Ultimo</a></li>

                        <li class="page-item  <?php echo $pagina >= $totaL_paginas ? 'disabled' : ''; ?>"><a class="page-link" href="?p=<?php echo $pagina + 1; ?>">Siguiente</a></li>

                    </ul>
                </nav>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="exampleModalLabel"><i class="fas fa-cubes" style="font-size: 45pt"></i> Anular Venta</h1>
                        </div>
                        <div class="modal-body" id="mAnulaFac">

                        </div>
                        <!-- <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><i class="fas fa-trash-alt"></i> Anular</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="../../libreria/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="js.js"></script>
    <script>
        $(document).ready(function() {
            // verVentas();
        });
    </script>






</body>

</html>