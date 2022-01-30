<?php
include "../../modelo/ConeccionBD.php";
session_start();

if (!empty($_POST)) {
    // buscar cliente
    if ($_POST['accion'] == 'buscarCliente') {
        if (!empty($_POST['cliente'])) {
            $cedula = $_POST['cliente'];

            $query = mysqli_query($cn, "SELECT * FROM cliente_venta WHERE cedula LIKE '$cedula' AND estatus = 1");
            mysqli_close($cn);

            $respuesta = mysqli_num_rows($query);

            $data = '';
            if ($respuesta > 0) {
                $data = mysqli_fetch_assoc($query);
            } else {
                $data = 0;
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        exit;
    }

    // registrar cliente_ventas
    if ($_POST['accion'] == 'aggCliente') {
        $ced = $_POST['cedula_cliente'];
        $nom = $_POST['nom_cliente'];
        $tel = $_POST['tel_cliente'];
        $dir = $_POST['dir_cliente'];
        $admin = $_SESSION['idAdmin'];

        $query = mysqli_query($cn, "INSERT INTO cliente_venta(cedula, nombre, telefono, direccion, idAdministrador, estatus)
                                            VALUES('$ced', '$nom', '$tel', '$dir', '$admin', 1)");

        if ($query) {
            $codCli = mysqli_insert_id($cn);
            $msg = $codCli;
        } else {

            $msg = 'error';
        }
        mysqli_close($cn);
        echo $msg;
        exit;
    }

    //buscar producto
    if ($_POST['accion'] == 'infoProducto') {
        if (!empty($_POST['producto'])) {
            $producto = $_POST['producto'];

            $query = mysqli_query($cn, "SELECT idProducto, Nombre, Precio, Stock, Descripcion FROM producto WHERE idProducto LIKE '$producto' AND Stock >= 1");
            mysqli_close($cn);

            $respuesta = mysqli_num_rows($query);

            $data = '';
            if ($respuesta > 0) {
                $data = mysqli_fetch_assoc($query);
            } else {
                $data = 0;
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        exit;
    }

    // agregar detalles
    if ($_POST['accion'] == 'addDetalleProducto') {
        if (empty($_POST['producto']) || empty($_POST['cantidad'])) {
            echo 'error';
        } else {
            $producto = $_POST['producto'];
            $cantidad = $_POST['cantidad'];
            $token = md5($_SESSION['idAdmin']);

            $query1 = mysqli_query($cn, "SELECT iva FROM informacion");
            $respuesta1 = mysqli_num_rows($query1);

            $query2 = mysqli_query($cn, "CALL add_detalle_temp($producto, $cantidad, '$token')");
            $respuesta2 = mysqli_num_rows($query2);

            $detalle_tabla = '';
            $sub_total = 0;
            $iva = 0;
            $total = 0;
            $array = array();

            if ($respuesta2 > 0) {
                if ($respuesta1 > 0) {
                    $info_iva = mysqli_fetch_assoc($query1);
                    $iva = $info_iva['iva'];
                }
                while ($data = mysqli_fetch_assoc($query2)) {
                    $precio = round($data['cantidad'] * $data['precio_total'], 2);
                    $sub_total = round($sub_total + $precio, 2);
                    $total = round($total + $precio, 2);

                    $detalle_tabla .= '<tr>
                                        <td>' . $data['id_producto'] . '</td>
                                        <td colspan="2">' . $data['Nombre'] . '</td>
                                        <td class="textcenter">' . $data['cantidad'] . '</td>
                                        <td class="textright">' . $data['precio_total'] . '</td>
                                        <td class="textright">' . $precio . '</td>
                                        <td class="textcenter">
                                            <a href="#" class="link_delete" onclick="event.preventDefault();
                                                del_product_detalle(' . $data['id_detalle_temp'] . ');"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>';
                }

                $si_iva = round($sub_total * ($iva / 100), 2);
                // $no_iva = round($sub_total - $iva, 2);
                $total_iva = round($sub_total + $si_iva, 2);

                $detalle_total = '<tr>
                                    <td colspan="5" class="textright">SUBTOTAL</td>
                                    <td class="textright">' . $total . '</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="textright">IVA (' . $iva . ')</td>
                                    <td class="textright">' . $si_iva . '</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="textright">TOTAL</td>
                                    <td class="textright">' . $total_iva . '</td>
                                </tr>';

                $arrayData['detalle'] = $detalle_tabla;
                $arrayData['total'] = $detalle_total;

                echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
            } else {
                echo 'error';
            }
            mysqli_close($cn);
        }
        exit;
    }

    // obtener datos de detalle temporal de venta
    if ($_POST['accion'] == 'buscarDetalle') {
        if (empty($_POST['user'])) {
            echo 'error';
        } else {
            $token = md5($_SESSION['idAdmin']);

            $query = mysqli_query($cn, "SELECT tmp.id_detalle_temp, tmp.token_user, tmp.cantidad, tmp.precio_total, p.idProducto, p.Nombre 
                                        FROM detalle_temp tmp INNER JOIN producto p ON tmp.id_producto = p.idProducto
                                        WHERE token_user = '$token'");
            $respuesta = mysqli_num_rows($query);

            $query1 = mysqli_query($cn, "SELECT iva FROM informacion");
            $respuesta1 = mysqli_num_rows($query1);

            $detalle_tabla = '';
            $sub_total = 0;
            $iva = 0;
            $total = 0;
            $total_iva = 0;
            $array = array();

            if ($respuesta > 0) {
                if ($respuesta1 > 0) {
                    $info_iva = mysqli_fetch_assoc($query1);
                    $iva = $info_iva['iva'];
                }
                while ($data = mysqli_fetch_assoc($query)) {
                    $precio = round($data['cantidad'] * $data['precio_total'], 2);
                    $sub_total = round($sub_total + $precio, 2);
                    $total = round($total + $precio, 2);

                    $detalle_tabla .= '<tr>
                                        <td>' . $data['idProducto'] . '</td>
                                        <td colspan="2">' . $data['Nombre'] . '</td>
                                        <td class="textcenter">' . $data['cantidad'] . '</td>
                                        <td class="textright">' . $data['precio_total'] . '</td>
                                        <td class="textright">' . $precio . '</td>
                                        <td class="textcenter">
                                            <a href="#" class="link_delete" onclick="event.preventDefault();
                                                del_product_detalle(' . $data['id_detalle_temp'] . ');"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>';
                }
                $si_iva = round($sub_total * ($iva / 100), 2);
                // $no_iva = round($sub_total - $iva, 2);
                $total_iva = round($sub_total + $si_iva, 2);

                $detalle_total = '<tr>
                                    <td colspan="5" class="textright">SUBTOTAL Q.</td>
                                    <td class="textright">' . $total . '</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="textright">IVA (' . $iva . ')</td>
                                    <td class="textright">' . $si_iva . '</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="textright">TOTAL Q.</td>
                                    <td class="textright">' . $total_iva . '</td>
                                </tr>';
                $arrayData['detalle'] = $detalle_tabla;
                $arrayData['total'] = $detalle_total;

                echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
            } else {
                echo 'error';
            }
            mysqli_close($cn);
        }
        exit;
    }

    // eliminar producto de detalle temporal
    if ($_POST['accion'] == 'eliminarDetalle') {
        if (empty($_POST['id'])) {
            echo 'error';
        } else {
            $id = $_POST['id'];
            $token = md5($_SESSION['idAdmin']);

            $query1 = mysqli_query($cn, "SELECT iva FROM informacion");
            $respuesta1 = mysqli_num_rows($query1);

            $query = mysqli_query($cn, "CALL del_detalle_temp($id, '$token')");
            $respuesta = mysqli_num_rows($query);

            $detalle_tabla = '';
            $sub_total = 0;
            $iva = 0;
            $total = 0;
            $total_iva = 0;
            $array = array();

            if ($respuesta > 0) {
                if ($respuesta1 > 0) {
                    $info_iva = mysqli_fetch_assoc($query1);
                    $iva = $info_iva['iva'];
                }
                while ($data = mysqli_fetch_assoc($query)) {
                    $precio = round($data['cantidad'] * $data['precio_total'], 2);
                    $sub_total = round($sub_total + $precio, 2);
                    $total = round($total + $precio, 2);

                    $detalle_tabla .= '<tr>
                                        <td>' . $data['id_producto'] . '</td>
                                        <td colspan="2">' . $data['Nombre'] . '</td>
                                        <td class="textcenter">' . $data['cantidad'] . '</td>
                                        <td class="textright">' . $data['precio_total'] . '</td>
                                        <td class="textright">' . $precio . '</td>
                                        <td class="textcenter">
                                            <a href="#" class="link_delete" onclick="event.preventDefault();
                                                del_product_detalle(' . $data['id_detalle_temp'] . ');"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>';
                }
                $si_iva = round($sub_total * ($iva / 100), 2);
                // $no_iva = round($sub_total - $iva, 2);
                $total_iva = round($sub_total + $si_iva, 2);

                $detalle_total = '<tr>
                                    <td colspan="5" class="textright">SUBTOTAL Q.</td>
                                    <td class="textright">' . $total . '</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="textright">IVA (' . $iva . ')</td>
                                    <td class="textright">' . $si_iva . '</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="textright">TOTAL Q.</td>
                                    <td class="textright">' . $total_iva . '</td>
                                </tr>';
                $arrayData['detalle'] = $detalle_tabla;
                $arrayData['total'] = $detalle_total;

                echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
            } else {
                echo 'error';
            }
            mysqli_close($cn);
        }
        exit;
    }

    // anular venta
    if ($_POST['accion'] == 'anularVenta') {
        $token = md5($_SESSION['idAdmin']);
        $query = mysqli_query($cn, "DELETE FROM detalle_temp WHERE token_user = '$token'");
        mysqli_close($cn);
        if ($query) {
            echo 'ok';
        } else {
            echo 'error';
        }
        exit;
    }

    // generar venta
    if ($_POST['accion'] == 'procesarVenta') {
        if ($_POST['id_cliente']) {
            $id_cliente = 1;
        } else {
            $id_cliente = $_POST['id_cliente'];
        }

        $token = md5($_SESSION['idAdmin']);
        $cliente = $_SESSION['idAdmin'];

        $query = mysqli_query($cn, "SELECT * FROM detalle_temp WHERE token_user = '$token'");
        $respuesta = mysqli_num_rows($query);

        if ($respuesta > 0) {
            $query1 = mysqli_query($cn, "CALL procesar_venta($cliente, $id_cliente, '$token')");
            $respuesta1 = mysqli_num_rows($query1);

            if ($respuesta1 > 0) {
                $data = mysqli_fetch_assoc($query1);
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
        mysqli_close($cn);
        exit;
    }

    // visualizar ventas
    if ($_POST['accion'] == 'cargarVentas') {
        $detalle_tabla = '';

        $query = mysqli_query($cn, "SELECT f.id_factura, f.fecha, f.total_factura, f.id_cliente, f.estatus,
                                        CONCAT(a.Nombres, ' ', a.Apellidos) as vendedor,
                                        cl.nombre as cliente
                                        FROM factura f
                                        INNER JOIN administrador a
                                        ON f.id_admin = a.idAdministrador
                                        INNER JOIN cliente_venta cl
                                        ON f.id_cliente = cl.id_cliente
                                        WHERE f.estatus != 10
                                        ORDER BY f.fecha DESC");

        $respuesta = mysqli_num_rows($query);
        if ($respuesta > 0) {
            while ($data = mysqli_fetch_array($query)) {
                if ($data['estatus'] == 1) {
                    $estado = '<span class="pagada">Pagada</span>';
                    $anular = '<button type="button" id="ejemplo_btn" onclick="infoFactura()" class="btn_anular anular_factura" fac="' . $data['id_factura'] . '"><i class="fas fa-ban"></i></button';
                } else {
                    $estado = '<span class="anulada">Anulada</span>';
                    $anular = '<button type="button" class="btn_anular inactive"><i class="fas fa-ban"></i></button';
                }

                $detalle_tabla .= '<tr id="row_' . $data['id_factura'] . '">
                <td>' . $data['id_factura'] . '</td>
                <td>' . $data['fecha'] . '</td>
                <td class="textcenter">' . $data['cliente'] . '</td>
                <td class="textright">' . $data['vendedor'] . '</td>
                <td class="textright">' . $estado . '</td>
                <td class="textright totalfactura"><span>$</span>' . $data['total_factura'] . '</td>
                <td>
                    <div class="div_acciones">
                        <div>
                            <button class="btn_view view_factura" type="button" cl="' . $data['id_cliente'] . '" f="' . $data['id_factura'] . '">
                            <i class="fas fa-eye"></i></button>
                        </div>
                        <div class="div_factura">' . $anular . '</div>
                    </div>
                </td>
            </tr>';
            }
        }

        $arrayData['detalle'] = $detalle_tabla;
        echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);

        mysqli_close($cn);
        exit;
    }

    //informacion factura
    if ($_POST['accion'] == 'infoFactura') {
        if (!empty($_POST['idFactura'])) {
            $no_factura = $_POST['idFactura'];
            $query = mysqli_query($cn, "SELECT * FROM  factura WHERE id_factura = '$no_factura' AND estatus = 1");
            mysqli_close($cn);

            $respuesta = mysqli_num_rows($query);
            if ($respuesta > 0) {
                $data = mysqli_fetch_assoc($query);
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
        echo "error";
        exit;
    }

    //anular factura
    if ($_POST['accion'] == 'anularFactura') {
        if (!empty($_POST['noFactura'])) {
            $no_factura = $_POST['noFactura'];
            $query = mysqli_query($cn, "CALL anular_factura($no_factura)");
            mysqli_close($cn);

            $respuesta = mysqli_num_rows($query);
            if ($respuesta > 0) {
                $data = mysqli_fetch_assoc($query);
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
        echo "error";
        exit;
    }

    //empleados
    //Cargar lista de empleados
    if ($_POST['accion'] == 'cargarTabla') {
        $detalle_tabla = '';
        $query = mysqli_query($cn, "SELECT * FROM curriculum");
        mysqli_close($cn);
        $respuesta = mysqli_num_rows($query);
        if ($respuesta > 0) {
            while ($data = mysqli_fetch_assoc($query)) {
                $detalle_tabla .= '<tr>
                    <td>' . $data['id_empleado'] . '</td>
                    <td colspan="1">' . $data['nombres'] . '</td>
                    <td>' . $data['profesion'] . '</td>
                    <td>' . $data['contacto'] . '</td>
                    <td class="textcenter">
                        <a type="button" class="link_update" data-toggle="modal" data-target="#modal_editar_empleado"
                            onclick="search_employee(' . $data['id_empleado'] . ')">
                            <i class="fas fa-pen-square"></i></a>
                        <a href="#" class="link_delete" onclick="event.preventDefault();
                            eliminar_empleado(' . $data['id_empleado'] . ');"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>';
            }
            $arrayData['detalle'] = $detalle_tabla;
            echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
        } else {
            echo "error";
        }
        exit;
    }

    //Eliminar Empleado
    if ($_POST['accion'] == 'eliminarEmpleado') {
        if (!empty($_POST['id'])) {
            $id_empleado = $_POST['id'];
            $detalle_tabla = '';
            $del = mysqli_query($cn, "DELETE FROM curriculum WHERE id_empleado = $id_empleado");

            if ($del) {
                $query = mysqli_query($cn, "SELECT * FROM curriculum");
                $respuesta = mysqli_num_rows($query);
                if ($respuesta > 0) {
                    while ($data = mysqli_fetch_assoc($query)) {
                        $detalle_tabla .= '<tr>
                            <td>' . $data['id_empleado'] . '</td>
                            <td colspan="1">' . $data['nombres'] . '</td>
                            <td>' . $data['profesion'] . '</td>
                            <td>' . $data['contacto'] . '</td>
                            <td class="textcenter">
                            <a type="button" class="link_update" data-toggle="modal" data-target="#modal_editar_empleado"
                                onclick="search_employee(' . $data['id_empleado'] . ')">
                                    <i class="fas fa-pen-square"></i></a>
                                <a href="#" class="link_delete" onclick="event.preventDefault();
                                    eliminar_empleado(' . $data['id_empleado'] . ');"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>';
                    }
                    $arrayData['detalle'] = $detalle_tabla;
                    echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
                }
                mysqli_close($cn);
            } else {
                mysqli_close($cn);
                echo "error";
            }
        } else {
            echo "error";
        }
        exit;
    }

    // registrar empleado
    if ($_POST['accion'] == 'aggEmpleado') {
        $nom = $_POST['nom_empleado'];
        $prof = $_POST['profesion'];
        $cont = $_POST['contacto'];

        $detalle_tabla = '';
        $insert = mysqli_query($cn, "INSERT INTO curriculum(nombres, profesion, contacto)
                                            VALUES('$nom', '$prof', '$cont')");

        if ($insert) {
            $query = mysqli_query($cn, "SELECT * FROM curriculum");
            $respuesta = mysqli_num_rows($query);
            if ($respuesta > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
                    $detalle_tabla .= '<tr>
                        <td>' . $data['id_empleado'] . '</td>
                        <td colspan="1">' . $data['nombres'] . '</td>
                        <td>' . $data['profesion'] . '</td>
                        <td>' . $data['contacto'] . '</td>
                        <td class="textcenter">
                            <a type="button" class="link_update" data-toggle="modal" data-target="#modal_editar_empleado"
                                onclick="search_employee(' . $data['id_empleado'] . ')">
                                    <i class="fas fa-pen-square"></i></a>
                            <a href="#" class="link_delete" onclick="event.preventDefault();
                                eliminar_empleado(' . $data['id_empleado'] . ');"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>';
                }
                $arrayData['detalle'] = $detalle_tabla;
                echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
            }
            mysqli_close($cn);
        } else {
            mysqli_close($cn);
            $msg = 'error';
        }
        exit;
    }

    //buscar empleado
    if ($_POST['accion'] == 'buscarEmpleado') {
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];

            $query = mysqli_query($cn, "SELECT * FROM curriculum WHERE id_empleado = $id");
            mysqli_close($cn);
            $respuesta = mysqli_num_rows($query);
            if ($respuesta > 0) {
                $data = mysqli_fetch_assoc($query);
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
                exit;
            }
        } else {
            echo "error";
        }
        exit;
    }

    //actualizar empleado
    if ($_POST['accion'] == 'updateEmpleado') {
        if (!empty($_POST['idEmpleadoUpd'])) {
            $id = $_POST['idEmpleadoUpd'];
            $nombres = $_POST['nombre_emp'];
            $profesion = $_POST['profesion_emp'];
            $contacto = $_POST['contacto_emp'];
            $detalle_tabla = '';

            $update = mysqli_query($cn, "UPDATE curriculum SET nombres = '$nombres',
                                                        profesion = '$profesion',
                                                        contacto = '$contacto'
                                                        WHERE id_empleado = $id");

            if ($update) {
                $query = mysqli_query($cn, "SELECT * FROM curriculum");
                $respuesta = mysqli_num_rows($query);
                if ($respuesta > 0) {
                    while ($data = mysqli_fetch_assoc($query)) {
                        $detalle_tabla .= '<tr>
                        <td>' . $data['id_empleado'] . '</td>
                        <td colspan="1">' . $data['nombres'] . '</td>
                        <td>' . $data['profesion'] . '</td>
                        <td>' . $data['contacto'] . '</td>
                        <td class="textcenter">
                            <a type="button" class="link_update" data-toggle="modal" data-target="#modal_editar_empleado"
                                onclick="search_employee(' . $data['id_empleado'] . ')">
                                    <i class="fas fa-pen-square"></i></a>
                            <a href="#" class="link_delete" onclick="event.preventDefault();
                                eliminar_empleado(' . $data['id_empleado'] . ');"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>';
                    }
                    $arrayData['detalle'] = $detalle_tabla;
                    echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
                }
                mysqli_close($cn);
            } else {
                mysqli_close($cn);
            }
        } else {
            echo "error";
        }
        exit;
    }

    exit;
}
