/*=============================================
EDITAR IGLESIA
=============================================*/
$(".tablas").on("click", ".btnEditarIglesia", function(){

  var idIglesia = $(this).attr("idIglesia");

  var datos = new FormData();
    datos.append("idIglesia", idIglesia);

    $.ajax({

      url:"ajax/iglesias.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
           $("#idIglesia").val(respuesta["id"]);
         $("#editarIglesia").val(respuesta["nombre"]);
         $("#editarEmail").val(respuesta["email"]);
         $("#editarTelefono").val(respuesta["telefono"]);
         $("#editarDireccion").val(respuesta["direccion"]);
    }

    })

})

/*=============================================
ELIMINAR IGLESIA
=============================================*/
$(".tablas").on("click", ".btnEliminarIglesia", function(){

  var idIglesia = $(this).attr("idIglesia");
  
  swal({
        title: '¿Está seguro de borrar la iglesia?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar iglesia!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=iglesias&idIglesia="+idIglesia;
        }

  })

})

