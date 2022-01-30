<?php

session_start();
if (empty($_SESSION['active'])) {
    header('location: ../../');
}
require_once('fragmentos/cabeza_index.php');
require_once('bdd.php');

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="../libreria/alertifyjs/css/alertify.css">
<link rel="stylesheet" href="../libreria/alertifyjs/css/themes/default.css">
<style>
    /*============ Ventas ============*/
    .datos_cliente,
    .contenido,
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

    #div_registro_empleado,
    #div_cancela_registro {
        margin-top: 20px;
    }

    #container_form {
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

<body>
    <!-- 
        supeior -->

    <!-- barra horizontal de navegacion principal -->
    <div class="container-fluid">
        <?php require_once 'fragmentos/barra_navegacion_principal.php'; ?>

        <!-- medio -->


        <div class="datos_cliente">
            <div class="title_page">
                <div class="row">
                    <div class="col-9">
                        <h1>Lista de Empleados</h1>
                    </div>
                </div>
            </div>
            <div class="accion_cliente">
                <a href="#" class="btn_new_employee btn btn-primary btn-sm btn_new" id="btn_new_employee"><i class="fas fa-plus"></i> Nuevo Empleado</a>
            </div>
            <div id="container_form">
                <form name="form_new_employee" id="form_new_employee" class="datos" autocomplete="off">
                    <input type="hidden" name="accion" value="aggEmpleado">
                    <input type="hidden" id="idEmpleado" name="idEmpleado" value="" required>
                    <div class="wd30">
                        <label>Nombres</label>
                        <input class="form-control" min="4" max="50" type="text" name="nom_empleado" id="nom_empleado" onKeyPress="return soloLetras(event)" required>
                    </div>
                    <div class="wd30">
                        <label>Profesión</label>
                        <input class="form-control" min="4" max="50" type="text" name="profesion" id="profesion" onKeyPress="return soloLetras(event)" required>
                    </div>
                    <div class="wd30">
                        <label>Contacto</label>
                        <input class="form-control" min="10" max="10" type="text" name="contacto" id="contacto" onKeyPress="return soloNumeros(event)" required>
                    </div>
                    <div id="div_registro_empleado" class="wd100" style="align-items: center;">
                        <button type="submit" class="btn btn-success btn_save"><i class="far fa-save fa-lg"></i> Guardar</button>
                        <button class="btn btn-danger btn_cancel" id="cancel"><i class="fas fa-ban fa-lg"></i> Cancelar</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- modal para editar empleado (oculto)  -->
        <div class="modal fade" id="modal_editar_empleado" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Empleado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body small">
                        <form role="form" name="actualizar_empleado" id="actualizar_empleado" class="datos" autocomplete="off">
                            <input type="hidden" name="accion" value="updateEmpleado">
                            <input type="hidden" id="idEmpleadoUpd" name="idEmpleadoUpd" value="" required>
                            <div class="wd30">
                                <label>Id Empleado</label>
                                <input class="form-control" readonly type="text" name="id_emp" id="id_emp" required>
                            </div>
                            <div class="wd30">
                                <label>Profesión</label>
                                <input class="form-control" min="4" max="50" type="text" name="profesion_emp" id="profesion_emp" onKeyPress="return soloLetras(event)" required>
                            </div>
                            <div class="wd30">
                                <label>Contacto</label>
                                <input class="form-control" min="10" max="10" type="text" name="contacto_emp" id="contacto_emp" onKeyPress="return soloNumeros(event)" required>
                            </div>
                            <div class="wd100">
                                <label>Nombre</label>
                                <input class="form-control" min="4" max="50" type="text" name="nombre_emp" id="nombre_emp" required>
                            </div>
                            <div id="div_registro_empleado" class="wd100" style="align-items: center;">
                                <!-- <button type="submit" data-dismiss="modal" class="btn btn-success btn_save" onclick="event.preventDefault(); 
                                                update_employee();"><i class="far fa-save fa-lg"></i> Guardar</button> -->
                                <button type="submit" class="btn btn-success btn_save_emp"><i class="far fa-save fa-lg"></i> Guardar</button>
                                <button class="btn btn-danger btn_cancel#" data-dismiss="modal" id="cancel_update"><i class="fas fa-ban fa-lg"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="contenido" style="height: 50vh;">
            <div id="aqui">
                <!-- aqui se muestra el inventario -->
                <table class="table table-sm" style="height: auto; ">

                    <thead class="bg-light ">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>profesión</th>
                            <th>Contacto</th>
                            <th class="textcenter">Acciones</th>
                        </tr>
                    </thead>

                    <tbody id="lista_empleados">
                    </tbody>

                </table>
            </div>

            <!-- inferior -->
            <?php require_once 'fragmentos/barra_inferior_principal.php' ?>
        </div>
        <!-- scripts calendario -->
        <!-- jQuery Version 1.11.1 -->
        <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="../libreria/js/jquery.js"></script>


        <!-- Bootstrap Core JavaScript -->
        <script src="../libreria/js/bootstrap.min.js"></script>

        <!-- FullCalendar -->
        <script src='../libreria/js/moment.min.js'></script>
        <script src='../libreria/js/fullcalendar/fullcalendar.min.js'></script>
        <script src='../libreria/js/fullcalendar/fullcalendar.js'></script>
        <script src='../libreria/js/fullcalendar/locale/es.js'></script>

        <script src="pruebas/js.js"></script>
        <script src="pruebas/bootstrap-validate.js"></script>
        <script src="../libreria/alertifyjs/alertify.js"></script>
        <script>
            bootstrapValidate('#nom_empleado', 'required:El campo nombre es requerido');
            bootstrapValidate('#nom_empleado', 'regex:^[a-zA-Z ]*$:Ingrese solo letras, sin tildes ni caracteres especiales');

            bootstrapValidate('#profesion', 'required:El campo profesión es requerido');
            bootstrapValidate('#profesion', 'regex:^[a-zA-Z ]*$:Ingrese solo letras, sin tildes ni caracteres especiales');

            bootstrapValidate('#contacto', 'required:El campo contacto es requerido');
            bootstrapValidate('#contacto', 'min:10:Ingrese solo 10 caracteres');
            bootstrapValidate('#contacto', 'max:10:Ingrese solo 10 caracteres');

            bootstrapValidate('#profesion_emp', 'required:El profesión es requerido');
            bootstrapValidate('#profesion_emp', 'regex:^[a-zA-Z ]*$:Ingrese solo letras, sin tildes ni caracteres especiales');

            bootstrapValidate('#contacto_emp', 'required:El campo contacto es requerido');
            bootstrapValidate('#contacto_emp', 'min:10:Ingrese solo 10 caracteres');
            bootstrapValidate('#contacto_emp', 'max:10:Ingrese solo 10 caracteres');

            bootstrapValidate('#nombre_emp', 'required:El campo nombres es requerido');
            bootstrapValidate('#nombre_emp', 'regex:^[a-zA-Z ]*$:Ingrese solo letras, sin tildes ni caracteres especiales');
        </script>


        <script>
            $(document).ready(function() {
                var body = $.ajax({
                    url: "pruebas/ajax.php",
                    type: "POST",
                    async: true,
                    data: {
                        accion: 'cargarTabla'
                    },
                    success: function(response) {
                        var info = JSON.parse(response);
                        $("#lista_empleados").html(info.detalle);

                    },
                    error: function(error) {},
                });

                // activar campos de registro
                $("#btn_new_employee").click(function(e) {
                    e.preventDefault();
                    $("#container_form").slideDown();
                });

                // desactivar campos de registro
                $("#cancel").click(function(e) {
                    e.preventDefault();
                    $("#nom_empleado").val("");
                    $("#profesion").val("");
                    $("#contacto").val("");
                    $("#container_form").slideUp();
                });

                //Crear nuevo empleado
                $("#form_new_employee").submit(function(e) {
                    e.preventDefault();
                    var nom = $('#nom_empleado').val();
                    var cont = $('#contacto').val();
                    var prof = $('#profesion').val();
                    if (nom == '' || prof == '' || cont == '' || cont.length != 10) {
                        alertify.set("notifier", "position", "top-right");
                        alertify.error("Error: ¡Por favor corrija los errores!");
                    } else {
                        $.ajax({
                            url: "pruebas/ajax.php",
                            type: "POST",
                            async: true,
                            data: $("#form_new_employee").serialize(),
                            success: function(response) {
                                if (response != "error") {
                                    alertify.set("notifier", "position", "top-right");
                                    alertify.success("Exito: ¡Empleado agregado Correctamente!");
                                    var info = JSON.parse(response);
                                    $("#nom_empleado").val("");
                                    $("#profesion").val("");
                                    $("#contacto").val("");
                                    $("#container_form").slideUp();
                                    $("#lista_empleados").html(info.detalle);
                                } else {
                                    $("#lista_empleados").html("");
                                }
                            },
                            error: function(error) {},
                        });
                    }
                });

                $('.btn_save_emp').click(function(e) {
                    e.preventDefault();
                    var nom = $('#nombre_emp').val();
                    var cont = $('#contacto_emp').val();
                    var prof = $('#profesion_emp').val();
                    if (nom == '' || cont == '' || prof == '' || cont.length != 10) {
                        alertify.set("notifier", "position", "top-right");
                        alertify.error("Error: ¡Por favor corrija los errores!");
                    } else {
                        update_employee();
                        alertify.set("notifier", "position", "top-right");
                        alertify.success("Exito: ¡Empleado modificado Correctamente!");
                    }

                });
            });

            function eliminar_empleado(id) {
                alertify.confirm(
                    "<strong>Eliminar Registro.</strong> ¿Estas seguro de eliminar este empleado?",
                    function() {
                        del_employee(id);
                        alertify.set("notifier", "position", "top-right");
                        alertify.success("Exito: ¡Empleado Eliminado!");
                    }
                );
            }
        </script>
        <script src="../libreria/js/j_producto.js"></script>


</body>

</html>