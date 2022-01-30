$(document).ready(function () {
  // activar campos de registro
  $("#btn_new_cliente").click(function (e) {
    e.preventDefault();
    $("#nom_cliente").removeAttr("disabled");
    $("#tel_cliente").removeAttr("disabled");
    $("#dir_cliente").removeAttr("disabled");
    $("#div_registro_cliente").slideDown();
  });

  // desactivar campos de registro
  $("#cancel").click(function (e) {
    e.preventDefault();
    $("#cedula_cliente").val("");
    $("#nom_cliente").val("");
    $("#tel_cliente").val("");
    $("#dir_cliente").val("");
    $("#nom_cliente").attr("disabled", "disabled");
    $("#tel_cliente").attr("disabled", "disabled");
    $("#dir_cliente").attr("disabled", "disabled");
    $("#div_registro_cliente").slideUp();
  });

  // buscar cliente
  $("#cedula_cliente").keyup(function (e) {
    e.preventDefault();
    var cl = $(this).val();
    var accion = "buscarCliente";
    $.ajax({
      url: "ajax.php",
      type: "POST",
      async: true,
      data: { accion: accion, cliente: cl },
      success: function (response) {
        // console.log(response);
        if (response == 0) {
          $("#idCliente").val("");
          $("#nom_cliente").val("");
          $("#tel_cliente").val("");
          $("#dir_cliente").val("");

          $("#btn_new_cliente").slideDown();
        } else {
          var data = $.parseJSON(response);
          $("#idCliente").val(data.id_cliente);
          $("#nom_cliente").val(data.nombre);
          $("#tel_cliente").val(data.telefono);
          $("#dir_cliente").val(data.direccion);

          $("#btn_new_cliente").slideUp();

          $("#nom_cliente").attr("disabled", "disabled");
          $("#tel_cliente").attr("disabled", "disabled");
          $("#dir_cliente").attr("disabled", "disabled");

          $("#div_registro_cliente").slideUp();
        }
      },
      error: function (error) {},
    });
  });

  // crear cliente venta
  $("#form_new_cliente_venta").submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: "ajax.php",
      type: "POST",
      async: true,
      data: $("#form_new_cliente_venta").serialize(),
      success: function (response) {
        if (response != "error") {
          $("#idCliente").val(response);

          $("#nom_cliente").attr("disabled", "disabled");
          $("#tel_cliente").attr("disabled", "disabled");
          $("#dir_cliente").attr("disabled", "disabled");

          $("#btn_new_cliente").slideUp();

          $("#div_registro_cliente").slideUp();
        }
      },
      error: function (error) {},
    });
  });

  // buscar producto
  $("#txt_cod_producto").keyup(function (e) {
    e.preventDefault();
    var producto = $(this).val();
    var accion = "infoProducto";
    $.ajax({
      url: "ajax.php",
      type: "POST",
      async: true,
      data: { accion: accion, producto: producto },
      success: function (response) {
        // console.log(response);
        if (response == 0) {
          $("#txt_descripcion").html("-");
          $("#txt_existencia").html("-");
          $("#txt_cant_producto").val("0");
          $("#txt_precio").html("0.00");
          $("#txt_precio_total").html("0.00");

          $("#txt_cant_producto").attr("disabled", "disabled");

          $("#add_product_venta").slideUp();
        } else {
          var data = $.parseJSON(response);
          $("#txt_descripcion").html(data.Nombre);
          $("#txt_existencia").html(data.Stock);
          $("#txt_cant_producto").val("1");
          $("#txt_precio").html(data.Precio);
          $("#txt_precio_total").html(data.Precio);

          $("#txt_cant_producto").removeAttr("disabled");

          $("#add_product_venta").slideDown();
        }
      },
      error: function (error) {},
    });
  });

  // calcular precio total
  $("#txt_cant_producto").keyup(function (e) {
    e.preventDefault();
    var total = $(this).val() * $("#txt_precio").html();
    $("#txt_precio_total").html(total);

    var existencia = parseInt($("#txt_existencia").html());

    if (
      $(this).val() < 1 ||
      isNaN($(this).val()) ||
      $(this).val() > existencia
    ) {
      $("#add_product_venta").slideUp();
    } else {
      $("#add_product_venta").slideDown();
    }
  });

  // agregar producto a detalle de factura
  $("#add_product_venta").click(function (e) {
    e.preventDefault();
    if ($("#txt_cant_producto").val() > 0) {
      var producto = $("#txt_cod_producto").val();
      var cantidad = $("#txt_cant_producto").val();
      var accion = "addDetalleProducto";

      $.ajax({
        url: "ajax.php",
        type: "POST",
        async: true,
        data: { accion: accion, producto: producto, cantidad: cantidad },
        success: function (response) {
          // console.log(response);
          if (response != "error") {
            var info = JSON.parse(response);
            $("#detalle_venta").html(info.detalle);
            $("#detalle_total").html(info.total);

            $("#txt_cod_producto").val("");
            $("#txt_descripcion").html("-");
            $("#txt_existencia").html("-");
            $("#txt_cant_producto").val("0");
            $("#txt_precio").html("0.00");
            $("#txt_precio_total").html("0.00");

            $("#txt_cant_producto").attr("disabled", "disabled");

            $("#add_product_venta").slideUp();
          } else {
            console.log("no datos");
          }

          verProcesar();
        },
        error: function (error) {},
      });
    }
  });

  // anular venta
  $("#btn_anular_venta").click(function (e) {
    e.preventDefault();
    var columnas = $("#detalle_venta tr").length;
    if (columnas > 0) {
      var accion = "anularVenta";

      $.ajax({
        url: "ajax.php",
        type: "POST",
        async: true,
        data: { accion: accion },
        success: function (response) {
          // console.log(response);
          if (response != "error") {
            location.reload();
          } else {
            console.log("no datos");
          }

          verProcesar();
        },
        error: function (error) {},
      });
    }
  });

  // generar venta
  $("#btn_facturar_venta").click(function (e) {
    e.preventDefault();
    var columnas = $("#detalle_venta tr").length;
    if (columnas > 0) {
      var accion = "procesarVenta";
      var id_cliente = $("#idCliente").val();

      $.ajax({
        url: "ajax.php",
        type: "POST",
        async: true,
        data: { accion: accion, id_cliente: id_cliente },
        success: function (response) {
          // console.log(response);
          if (response != "error") {
            var info = JSON.parse(response);
            console.log(info);

            generarFactura(info.id_cliente, info.id_factura);

            location.reload();
          } else {
            console.log("no datos");
          }
        },
        error: function (error) {},
      });
    }
  });

  //anular factura
  $(".anular_factura").click(function (e) {
    e.preventDefault();
    var idFactura = $(this).attr("fac");
    var accion = "infoFactura";

    $.ajax({
      url: "ajax.php",
      type: "POST",
      async: true,
      data: { accion: accion, idFactura: idFactura },
      success: function (response) {
        if (response != "error") {
          var info = JSON.parse(response);
          $("#mAnulaFac").html(
            '<form action="" method="post" name="form_anular_factura" id="form_anular_factura" onsubmit="event.preventDefault(); anularFactura();">' +
              "<p>¿Realmente desea anular la factura?</p>" +
              "<p>Factura No.: <strong>" +
              info.id_factura +
              " </strong></p>" +
              "<p>Monto Facturado: <strong>" +
              info.total_factura +
              "</strong></p>" +
              "<p>Fecha de Factura: <strong>" +
              info.fecha +
              "</strong></p>" +
              '<input type="hidden" name="action" value="anularFactura">' +
              '<input type="hidden" name="no_factura" id="no_factura" value="' +
              info.id_factura +
              '" required>' +
              '<div class="alert alertAddProduct"></div>' +
              '<div class="modal-footer" style="justify-content: center">' +
              '<button type="submit" class="btn btn-success btn_ok"><i class="fas fa-trash-alt"></i> Anular</button>' +
              '<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>' +
              "</div>" +
              "</form>"
          );
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  });

  //ver factura
  $(".view_factura").click(function (e) {
    e.preventDefault();
    var idCliente = $(this).attr("cl");
    var idFactura = $(this).attr("f");
    generarFactura(idCliente, idFactura);
  });
});

// FUNCIONES

//generar factura
function generarFactura(cliente, factura) {
  var ancho = 1000;
  var alto = 800;

  var x = parseInt(window.screen.width / 2 - ancho / 2);
  var y = parseInt(window.screen.height / 2 - alto / 2);

  $url =
    "../../libreria/factura/generaFactura.php?cl=" + cliente + "&f=" + factura;
  window.open(
    $url,
    "Factura",
    "left=" +
      x +
      ",top=" +
      y +
      ",height=" +
      alto +
      ",wigth=" +
      ancho +
      ",scrollbar= si,location=no,resizable=si,menubar=no"
  );
}

//habilitar boton procesar venta
function verProcesar() {
  if ($("#detalle_venta tr").length > 0) {
    $("#btn_facturar_venta").show();
  } else {
    $("#btn_facturar_venta").hide();
  }
}

//elimina detalles del producto
function del_product_detalle(id) {
  var accion = "eliminarDetalle";
  var id_detalle_temp = id;

  $.ajax({
    url: "ajax.php",
    type: "POST",
    async: true,
    data: { accion: accion, id: id_detalle_temp },
    success: function (response) {
      // console.log(response);
      if (response != "error") {
        var info = JSON.parse(response);
        $("#detalle_venta").html(info.detalle);
        $("#detalle_total").html(info.total);

        $("#txt_cod_producto").val("");
        $("#txt_descripcion").html("-");
        $("#txt_existencia").html("-");
        $("#txt_cant_producto").val("0");
        $("#txt_precio").html("0.00");
        $("#txt_precio_total").html("0.00");

        $("#txt_cant_producto").attr("disabled", "disabled");

        $("#add_product_venta").slideUp();
      } else {
        $("#detalle_venta").html("");
        $("#detalle_total").html("");
      }
      verProcesar();
    },
    error: function (error) {},
  });
}

//busca detalles del producto
function buscarDetalle(id) {
  var accion = "buscarDetalle";
  var user = id;

  $.ajax({
    url: "ajax.php",
    type: "POST",
    async: true,
    data: { accion: accion, user: user },
    success: function (response) {
      // console.log(response);
      if (response != "error") {
        if (response != "error") {
          var info = JSON.parse(response);
          $("#detalle_venta").html(info.detalle);
          $("#detalle_total").html(info.total);
        } else {
          console.log("no datos");
        }
      } else {
        console.log("no datos");
      }
      verProcesar();
    },
    error: function (error) {},
  });
}

// Ventas

//ver factura
function verVentas() {
  var accion = "cargarVentas";

  $.ajax({
    url: "ajax.php",
    type: "POST",
    async: true,
    data: { accion: accion },
    success: function (response) {
      // console.log(response);
      var info = JSON.parse(response);
      $("#lista_ventas").html(info.detalle);
    },
    error: function (error) {},
  });
}

//anular factura
function anularFactura() {
  var noFactura = $("#no_factura").val();
  var accion = "anularFactura";
  $.ajax({
    url: "ajax.php",
    type: "POST",
    async: true,
    data: { accion: accion, noFactura: noFactura },
    success: function (response) {
      if (response == "error") {
        $(".alertAddProduct").addClass("alert-danger");
        $(".alertAddProduct").html(
          '<p style="color:red;">Error al anular la factura.</p>'
        );
      } else {
        $("#row_" + noFactura + " .estado").html(
          '<span class="anulada">Anulada</span>'
        );
        $("#form_anular_factura .btn_ok").remove();
        $("#row_" + noFactura + " .div_factura").html(
          '<button type="button" class="btn_anular inactive"><i class="fas fa-ban"></i></button>'
        );
        $(".alertAddProduct").addClass("alert-success");
        $(".alertAddProduct").html(
          '<p style="color:green;">Factura Anulada.</p>'
        );
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}

// Empleados
//eliminar empleado
function del_employee(id) {
  var accion = "eliminarEmpleado";
  var id_empleado = id;

  $.ajax({
    url: "pruebas/ajax.php",
    type: "POST",
    async: true,
    data: { accion: accion, id: id_empleado },
    success: function (response) {
      if (response != "error") {
        var info = JSON.parse(response);
        $("#lista_empleados").html(info.detalle);
      } else {
        $("#lista_empleados").html("");
      }
    },
    error: function (error) {},
  });
}

//buscar empleado
function search_employee(id) {
  var accion = "buscarEmpleado";
  var id_empleado = id;
  $.ajax({
    url: "pruebas/ajax.php",
    type: "POST",
    async: true,
    data: {
      accion: accion,
      id: id_empleado,
    },
    success: function (response) {
      var info = JSON.parse(response);
      $("#id_emp").val(info["id_empleado"]);
      $("#nombre_emp").val(info["nombres"]);
      $("#idEmpleadoUpd").val(info["id_empleado"]);
      $("#profesion_emp").val(info["profesion"]);
      $("#contacto_emp").val(info["contacto"]);
    },
    error: function (error) {},
  });
}

//actualizar empleado
function update_employee() {
  $.ajax({
    url: "pruebas/ajax.php",
    type: "POST",
    async: true,
    data: $("#actualizar_empleado").serialize(),
    success: function (response) {
      if (response != "error") {
        $("[data-dismiss=modal]").trigger({
          type: "click",
        });
        var info = JSON.parse(response);
        $("#lista_empleados").html(info.detalle);
      } else {
        $("#lista_empleados").html("");
      }
    },
    error: function (error) {},
  });
}

//validaciones

//solo numeros
function soloNumeros(e) {
  var key = window.Event ? e.which : e.keyCode;
  return key >= 48 && key <= 57;
}

//solo letras
function soloLetras(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toLowerCase();
  letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
  especiales = [8, 37, 39, 46];

  tecla_especial = false;
  for (var i in especiales) {
    if (key == especiales[i]) {
      tecla_especial = true;
      break;
    }
  }

  if (letras.indexOf(tecla) == -1 && !tecla_especial) return false;
}
