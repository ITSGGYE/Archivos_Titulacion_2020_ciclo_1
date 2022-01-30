$(document).ready(function () {
  // actualizar hora
  setInterval(function () {
    $("#recargar_hora").load("../controlador/HoraC.php");
  }, 1000);

  //validacion de campos
  $("#agregar_producto").click(function () {
    //Guardar en variables el valor que tengan las cajas de texto
    //Por medio de los id's
    //Y tener mejor manipulación de dichos valores
    //var id = $('#id_i').val(); futuro redireccionar
    var nombre = $("#nombre_i").val();
    var precio = $("#precio_i").val();
    var proveedor = $("#proveedor_i").val();
    var categoria = $("#categoria_i").val();
    var seccion = $("#seccion_i").val();

    // --- Condicionales anidados ----
    //Si nombre está vacío
    //Muestra el mensaje
    //Con false sale de los if's y espera a que sea pulsado de nuevo el botón de enviar
    if (nombre == "") {
      $("#mensaje1").fadeIn("slow");
      return false;
    }
    //en otro caso, el mensaje no se muestra
    else {
      $("#mensaje1").fadeOut();

      //Si correo está vacío y la expresión NO corresponde -test es función de JQuery
      //Muestra el mensaje
      //Con false sale de los if's y espera a que sea pulsado de nuevo el botón de enviar
      if (precio == "") {
        $("#mensaje2").fadeIn("slow");
        return false;
      } else {
        $("#mensaje2").fadeOut();

        if (proveedor == "") {
          $("#mensaje3").fadeIn("slow");
          return false;
        } else {
          $("#mensaje3").fadeOut();

          if (categoria == "") {
            $("#mensaje4").fadeIn("slow");
            return false;
          } else {
            $("#mensaje4").fadeOut();

            if (seccion == "") {
              $("#mensaje5").fadeIn("slow");
              return false;
            } else {
              $("#mensaje5").fadeOut();
            }
          }
        }
      }
    }
    //evento al final del boton guardar
    //window.location.href='Inventario.php'; redieecionar?
    alertify.set("notifier", "position", "top-right");
    alertify.success("Operacion exitosa");
  }); //click

  //limpiar campos
  $("#limpiar").click(function () {
    $('input[type="text"]').val("");
  });

  //buscador
  $("#buscador_vivo").select2();

  $("#buscador_vivo").change(function () {
    $.ajax({
      type: "post",

      success: function (response) {
        //show dinamic table
      },
    });
  });

  //mostrar contenido
  $(".link_categoria").click(function () {
    $("#inventario").load("CategoriaC.php");
  });

  $("#stock").keyup(function (e) {
    e.preventDefault();

    var total = $(this).val() * $("#precio_u2").val();
    $("#precio_modal").html("Valor a Cobrar: $" + total);

    var existencia = parseInt($("#stock_u2").val());

    if (
      $(this).val() < 1 ||
      isNaN($(this).val()) ||
      $(this).val() > existencia
    ) {
      $("#editar_productos_u").slideUp();
    } else {
      $("#editar_productos_u").slideDown();
    }
  });
}); //ready
