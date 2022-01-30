/*
           esperando... categoria
       */
$(document).ready(function () {

    // actualizar hora
    setInterval(
        function() {
            $('#recargar_hora').load('../controlador/HoraC.php');
        }, 1000
    );

    // envio de datos. insertar a bd 
    //validacion de campos
   $("#agregar_producto").click(function () {
        //Guardar en variables el valor que tengan las cajas de texto
        //Y tener mejor manipulación de dichos valores
        //var id = $('#id_i').val(); futuro redireccionar
        var nombre = $("#nombre_i").val();
      
        if (nombre == "") {
            $("#mensaje1").fadeIn("slow");
            return false;
        }
        //en otro caso, el mensaje no se muestra
        else {
                  $("#mensaje1").fadeOut();
            } 
        //evento al final del boton guardar
        //window.location.href='Inventario.php'; redieecionar?
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('Operacion exitosa');


    }); //click 

    //limpiar campos
    $('#limpiar').click(function () {
        $('input[type="text"]').val('');
        $('textarea'.val(''));
    });

    //buscador            
    $("#buscador_vivo").select2({
        placeholder: 'Buscando...',
        allowClear: true
    });

    $('#buscador_vivo').change(function () {
        $.ajax({
            url: "",
            type: "post",
            contentType: false,
            processData: false,
            beforesend: function () {

            },
            success: function (response) {


            }

        });
    });

    //mostrar contenido
  /*   $('.link_categoria').click(function () {
        $('#inventario').load('CategoriaC.php');
    }); */

}); //ready