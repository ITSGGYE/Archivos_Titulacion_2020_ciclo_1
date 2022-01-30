function agregar_producto() {
  //alert("test agregar_producto");
  var parametros = new FormData($("#ingresar_productos")[0]);

  $.ajax({
    data: parametros,
    url: "",
    type: "post",
    contentType: false,
    processData: false,
    beforesend: function () {},
    success: function (response) {
      //escuchando...
    },
  });
}

function actualizar_producto() {
  var parametros = new FormData($("#actualizar_productos")[0]);
  alertify.set("notifier", "position", "top-right");
  alertify.success("Operacion exitosa");
  $.ajax({
    data: parametros,
    url: "",
    type: "post",
    contentType: false,
    processData: false,
    beforesend: function () {},
    success: function (response) {
      //escuchando...
    },
  });
}
function actualizar_producto_u() {
  //alert("test - actualizar_producto_u");
  var parametros = new FormData($("#actualizar_productos_u")[0]);

  /* alertify.set('notifier', 'position', 'top-right');
    alertify.success('Operacion exitosa');  */

  $.ajax({
    data: parametros,
    url: "",
    type: "post",
    contentType: false,
    processData: false,
    beforesend: function () {},
    success: function (response) {
      //escuchando...
    },
  });
}

function ver_producto($datos) {
  $muestra = $datos.split("||");

  //   -----------ORIGINAL--------------
  //   $("#id_u").val($muestra[0]);
  //   $("#id_u4").val("Produc" + $muestra[0]);
  //   $("#nombre_u").val($muestra[1]);
  //   $("#nombre_u2").val($muestra[1]);
  //   $("#marca_u").val($muestra[2]);
  //   $("#precio_u").val($muestra[3]);
  //   $("#stock_u").val($muestra[4]);
  //   $("#fecha_u").val($muestra[5]);
  //   $("#hora_u").val($muestra[6]);
  //   $("#proveedor_u").val($muestra[7]);
  //   $("#categoria_u").val($muestra[8]);
  //   $("#seccion_u").val($muestra[9]);
  //   $("#descripcion_u").val($muestra[10]);
  //   $("#imagen_u").val($muestra[11]);

  // ------------MODIFICACION---------------
  $("#id_u").val($muestra[0]);
  $("#id_u4").val("Produc" + $muestra[0]);
  $("#nombre_u").val($muestra[1]);
  $("#marca_u").val($muestra[2]);
  $("#precio_u").val($muestra[3]);
  $("#stock_u").val($muestra[4]);
  $("#fecha_u").val($muestra[5]);
  $("#hora_u").val($muestra[6]);
  $("#proveedor_u").prepend(
    "<option value='" +
      $muestra[12] +
      "' selected='selected'>" +
      $muestra[7] +
      "</option>"
  );
  $("#categoria_u").prepend(
    "<option value='" +
      $muestra[13] +
      "' selected='selected'>" +
      $muestra[8] +
      "</option>"
  );
  $("#seccion_u").prepend(
    "<option value='" +
      $muestra[14] +
      "' selected='selected'>" +
      $muestra[9] +
      "</option>"
  );
  $("#descripcion_u").val($muestra[10]);
  //   $("#imagen_u").val($muestra[11]);
}
function ver_producto_u($datos) {
  $muestra = $datos.split("||");

  $("#id_u2").val($muestra[0]);
  $("#id_u5").val("Produc" + $muestra[0]);
  $("#nombre_u2").val($muestra[1]);
  $("#marca_u2").val($muestra[2]);
  $("#precio_u2").val($muestra[3]);
  $("#stock_u2").val($muestra[4]);
  $("#fecha_u2").val($muestra[5]);
  $("#hora_u2").val($muestra[6]);
  $("#proveedor_u2").val($muestra[7]);
  $("#categoria_u2").val($muestra[8]);
  $("#seccion_u2").val($muestra[9]);
  $("#descripcion_u2").val($muestra[10]);
  $("#imagen_u2").val($muestra[11]);
}

function confirmar($datos) {
  //un confirm
  alertify.confirm(
    "<strong>Eliminar dato.</strong> ¿Estas seguro de eliminar este registro?",
    function () {
      alertify.set("notifier", "position", "top-right");
      eliminar_producto($datos);
      alertify.success("Eliminado");
    }
  );
}

function eliminar_producto($datos) {
  $muestra = $datos.split("||");
  $("#id_i").val($muestra[0]);

  var parametros = new FormData($("#actualizar_productos")[0]);

  $.ajax({
    data: parametros,
    url: "",
    type: "post",
    contentType: false,
    processData: false,
    beforesend: function () {},
    success: function (response) {
      //escuchando...
    },
  });
}
