// MODAL AGREGAR DESCUENTO
$('.add_product').click(function(e){
  e.preventDefault();

  var producto = $(this).attr('product');
  var action = 'infoProducto';

  $.ajax({
    url: 'funciones.php',
    type: 'POST',
    async: true,
    data: {action:action,producto:producto},

    success: function(response) {
      if (response != 'error') {
         var info = JSON.parse(response);

        $('#producto_id').val(info.codproducto);
        $('.nameProducto').html(info.descripcion);

        $('.bodyModal').html('<form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataProduct(); ">'+
          '<h4><i class="fa fa-cubes" style="font-size: 35pt;"></i><br> Agregar Descuento</h4>'+
          '<h4 class="nameProducto">'+info.descripcion+'</h4>'+
          '<label style:align:left;>Agregar Descuento</label>'+
          '<input type="text" name="precio" id="txtPrecio" placeholder="Precio del descuento" required>'+
          '<input type="hidden" name="producto_id" id="producto_id" value="'+info.codproducto+'" required>'+
          '<input type="hidden" name="action" value="addProduct" required>'+
            '<div class="alert alertAddProduct" style:"display:none;"></div>'+
            '<button type="submit" class="btn_new"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar</button>'+
            '<a href="#" class="btn_ok closeModal" onclick="closeModal();" ><i class="fa fa-ban" aria-hidden="true"></i> Cerrar</a>'+
            '</form>');
      }
    },
    error: function(error) {
      console.log(error);
    }
  });
  $('.modal').fadeIn();
});
// ELIMINAR PRODUCTO
$('.del_product').click(function(e){
  e.preventDefault();

  var producto = $(this).attr('product');
  var action = 'infoProducto';

  $.ajax({
    url: 'funciones.php',
    type: 'POST',
    async: true,
    data: {action:action,producto:producto},

    success: function(response) {
      if (response != 'error') {
        var info = JSON.parse(response);

        $('.bodyModal').html('<form action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); delProduct(); ">'+
          '<h4><i class="fa fa-cubes" style="font-size: 45pt;"></i><br> Eliminar Producto</h4>'+
          '<h5>¿Está seguro de eliminar el siguiente registro?</h5>'+
          '<h2 class="nameProducto">'+info.descripcion+'</h2>'+
          '<input type="hidden" name="producto_id" id="producto_id" value="'+info.codproducto+'" required>'+
          '<input type="hidden" name="action" value="delProduct" required>'+
          '<div class="alert alertAddProduct"></div>'+
          '<a href="#" class="btn_cancel" onclick="closeModal();"><i class="fa fa-ban" aria-hidden="true"></i> Cerrar</a>'+
          '<button type="submit" class="btn_ok"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</button>'+
          '</form>');
      }
    },
    error: function(error) {
      console.log(error);
    }
  });
  $('.modal').fadeIn();
});
//ACTIVA CAMPOS PARA REGISTRO DE CLIENTE
$('.btn_new_cliente').click(function(e) {
  e.preventDefault();
  $('#nom_cliente').removeAttr('disabled');
  $('#tel_cliente').removeAttr('disabled');
  $('#dir_cliente').removeAttr('disabled');

  $('#div_registro_cliente').slideDown();
});
//BUSCAR CLIENTE
$('#nit_cliente').keyup(function(e){
  e.preventDefault();
  var cl = $(this).val();
  var action = 'searchCliente';

  $.ajax({
    url: 'funciones.php',
    type: "POST",
    async: true,
    data: {action:action,cliente:cl},
    success: function(response)
    {
       if (response == 0) {
        $('#idcliente').val('');
        $('#nom_cliente').val('');
        $('#tel_cliente').val('');
        $('#dir_cliente').val('');
        // mostar boton agregar
        $('.btn_new_cliente').slideDown();
      }else {
        var data = $.parseJSON(response);
        $('#idcliente').val(data.idcliente);
        $('#nom_cliente').val(data.nombre);
        $('#tel_cliente').val(data.telefono);
        $('#dir_cliente').val(data.direccion);
        // ocultar boton Agregar
        $('.btn_new_cliente').slideUp();
        // Bloque campos
        $('#nom_cliente').attr('disabled','disabled');
        $('#tel_cliente').attr('disabled','disabled');
        $('#dir_cliente').attr('disabled','disabled');
        // ocultar boto Guardar
        $('#div_registro_cliente').slideUp();
      }
    },
    error: function(error){

    }
    }); 
});
//CREAR CLIENTE VENTA
$('#form_new_cliente_venta').submit(function(e){
  e.preventDefault();

  $.ajax({
    url: 'funciones.php',
    type: "POST",
    async: true,
    data: $('#form_new_cliente_venta').serialize(),

    success: function(response)
    {
      if (response  != 'error'){
        // Agregar id a input hidden
        $('#idcliente').val(response);
        //bloque campos
        $('#nom_cliente').attr('disabled','disabled');
        $('#tel_cliente').attr('disabled','disabled');
        $('#dir_cliente').attr('disabled','disabled');
        // ocultar boton Agregar
        $('.btn_new_cliente').slideUp();
        //ocultar boton Guardar
        $('#div_registro_cliente').slideUp();
      }
    },
    error: function(error) {
    }
  });
});
//BUSCAR PRODUCTO VENTA 
$('#txt_cod_producto').keyup(function(e){
  e.preventDefault();

  var producto = $(this).val();
  var action = 'infoProducto';

  if (producto != '')
  {
   $.ajax({
    url: 'funciones.php',
    type: 'POST',
    async: true,
    data: {action:action,producto:producto},

    success: function(response)
    {
      if(response != 'error') 
      {
        var info = JSON.parse(response);
        $('#txt_descripcion').html(info.descripcion);
        $('#txt_existencia').html(info.existencia);
        $('#txt_cant_producto').val('1');
        $('#txt_precio').html(info.precio);
        $('#txt_precio_total').html(info.precio);
        // Activa Cantidad
        $('#txt_cant_producto').removeAttr('disabled');
        // Muestra boton agregar
        $('#add_product_venta').slideDown();  
      }else{
        $('#txt_descripcion').html('-');
        $('#txt_existencia').html('-');
        $('#txt_cant_producto').val('0');
        $('#txt_precio').html('0.00');
        $('#txt_precio_total').html('0.00');
        //Bloquea Cantidad
        $('#txt_cant_producto').attr('disabled','disabled');
        // Ocultar Boton Agregar
        $('#add_product_venta').slideUp();
      }
    },
    error: function(error){

    }
  });
 }
});
//CALCULAR TOTAL DEL PRODUCTO
$('#txt_cant_producto').keyup(function(e) {
  e.preventDefault();
  var precio_total = $(this).val() * $('#txt_precio').html();
  var existencia = parseInt($('#txt_existencia').html());
  $('#txt_precio_total').html(precio_total);
  // Ocultat el boton Agregar si la cantidad es menor que 1
  if (($(this).val() < 1 || isNaN($(this).val())) || ($(this).val() > existencia)){
    $('#add_product_venta').slideUp();
  }else {
    $('#add_product_venta').slideDown();
  }
}); 
//AGREGAR PRODUCTO DETALLE VENTA
$('#add_product_venta').click(function(e) {
  e.preventDefault();

  if ($('#txt_cant_producto').val() > 0) {

    var codproducto = $('#txt_cod_producto').val();
    var cantidad = $('#txt_cant_producto').val();
    var action = 'addProductoDetalle';

    $.ajax({
      url: 'funciones.php',
      type: 'POST',
      async: true,
      data: {action:action,producto:codproducto,cantidad:cantidad},

      success: function(response)
      {
          if(response != 'error')
          {
              var info = JSON.parse(response);
              $('#detalle_venta').html(info.detalle);
              $('#detalle_totales').html(info.totales);

              $('#txt_cod_producto').val('');
              $('#txt_descripcion').html('-');
              $('#txt_existencia').html('-');
              $('#txt_cant_producto').val('0');
              $('#txt_precio').html('0.00');
              $('#txt_precio_total').html('0.00');
              // Bloquea cantidad
              $('#txt_cant_producto').attr('disabled','disabled');
              // Oculta boton agregar
              $('#add_product_venta').slideUp();

          }else{
            console.log('No Hay Datos');
          }
           viewProcesar();
      },
      error: function(error) {
      }
    });
  }
});
//ANULAR VENTA
$('#btn_anular_venta').click(function(e) {
  e.preventDefault();

  var rows = $('#detalle_venta tr').length;
  if (rows > 0) {

    var action = 'anularVenta';
    $.ajax({
      url: 'funciones.php',
      type: 'POST',
      async: true,
      data: {action:action},

      success: function(response)
      {
        if (response != 'error')
        {
          location.reload();
        }
      },
      error: function(error) {
      }
    });
  }
});
//GENERAR VENTA
$('#btn_facturar_venta').click(function(e) {
  e.preventDefault();

  var rows = $('#detalle_venta tr').length;
  if (rows > 0) 
  {
    var action = 'procesarVenta';
    var codcliente = $('#idcliente').val();

    $.ajax({
      url: 'funciones.php',
      type: 'POST',
      async: true,
      data: {action:action,codcliente:codcliente},
      success: function(response)
      {
      if (response != 'error')
      {
        //CONVIERTE A UN OBJETO
        var info = JSON.parse(response);
        //console.log(info);
        generarPDF(info.codcliente,info.nofactura);
        location.reload();
      }else {
        console.log('no hay datos');
      }
      },
      error: function(error) {
      }
    });
  }
});
//MODAL ANULAR FACTURA
$('.anular_factura').click(function(e){
  e.preventDefault();

  var nofactura = $(this).attr('fac');
  var action = 'infoFactura';
 
  $.ajax({
    url: 'funciones.php',
    type: 'POST',
    async: true,
    data: {action:action,nofactura:nofactura },

    success: function(response) {
      if (response != 'error') {
        var info = JSON.parse(response);

        $('.bodyModal').html('<form action="" method="post" name="form_anular_factura" id="form_anular_factura" onsubmit="event.preventDefault(); anularFactura(); ">'+
          '<h4><i class="fa fa-file" aria-hidden="true" style="font-size: 45pt;"></i><br> Anular Factura </h4><br>'+
          '<h5>¿Desea Anular esta Factura?</h5>'+
          '<p><strong>No. '+info.nofactura+'</strong></p>'+
          '<p><strong>Monto $. '+info.totalfactura+'</strong></p>'+
          '<p><strong>Fecha '+info.fecha+'</strong></p>'+
          '<input type="hidden" name="action" value="anularFactura">'+
          '<input type="hidden" name="no_factura" id="no_factura" value="'+info.nofactura+'" required>'+
          '<div class="alertAddProduct"></div>'+
          '<button type="submit" class="btn_ok"><i class="fa fa-trash" aria-hidden="true"></i> Anular</button>'+
          '<a href="#" class="btn_cancel" onclick="closeModal();"><i class="fa fa-ban" aria-hidden="true"></i> Cerrar</a>'+
          '</form>');
      }
    },
    error: function(error) {
      console.log(error);
    }
  });
  $('.modal').fadeIn();
});
//VER FACTURA
$('.view_factura').click(function(e) {
  e.preventDefault();

  var codCliente = $(this).attr('cl');
  var noFactura = $(this).attr('f');

  generarPDF(codCliente,noFactura);
});
//VALIDAR PASSWORD
$('.newPass').keyup(function() {
  validPass();
});
//CAMBIAR PASSWORD
$('#frmChangePass').submit(function(e){
  e.preventDefault();
  var passActual = $('#txtPassUser').val();
  var passNuevo = $('#txtNewPassUser').val();
  var confirmPassNuevo = $('#txtPassConfirm').val();
  var action = "changePasword";

  if (passNuevo != confirmPassNuevo) {
     $('.alertChangePass').html('<p style="color:red;">Las contraseñas no Coinciden</p>');
    $('.alertChangePass').slideDown();
    return false;
    }
  if (passNuevo.length < 5) {
  $('.alertChangePass').html('<p style="color:red;">Las contraseñas deben contener como mínimo 5 caracteres');
  $('.alertChangePass').slideDown();
  return false;
  }
  $.ajax({
    url: 'funciones.php',
    type: 'POST',
    async: true,
    data: {action:action,passActual:passActual,passNuevo:passNuevo},
    success: function(response) {
      if (response != 'error') {
        var info = JSON.parse(response);
        if (info.cod == '00') {
          $('.alertChangePass').html('<p style="color:green;">'+info.msg+'</p>');
          $('#frmChangePass')[0].reset();
        }else {
          $('.alertChangePass').html('<p style="color:red;">'+info.msg+'</p>');
        }
        $('.alertChangePass').slideDown();
      }
    },
    error: function(error) {
    }
  });
});
//ACTUALIZAR DATOS DE EMPRESA
$('#frmEmpresa').submit(function(e){
  e.preventDefault();

  var intNit = $('#txtNit').val();
  var strNombreEmp = $('#txtNombre').val();
  var strRSocialEmp = $('#txtRSocial').val();
  var intTelEmp = $('#txtTelEmpresa').val();
  var strEmailEmp = $('#txtEmailEmpresa').val();
  var strDirEmp = $('#txtDirEmpresa').val();
  var intIva = $('#txtIva').val();

  if(intNit == '' || strNombreEmp == '' || intTelEmp == '' || strEmailEmp == '' || strDirEmp == '' || intIva == ''){  
    $('.alertFormEmpresa').html('<p style="color:red">Todos los Campos son Obligatorios.</p>');
    $('.alertFormEmpresa').slideDown();
    return false;
    }
  $.ajax({
        url: 'funciones.php',
        type: 'POST',
        async: true,
        data: $('#frmEmpresa').serialize(),
        beforeSend:function(){
          $('.alertFormEmpresa').slideUp();
          $('.alertFormEmpresa').html('');
          $('#frmEmpresa input').attr('disabled', 'disabled');
    },
    success: function(response)
    {
        var info = JSON.parse(response);
        if(info.cod == '00'){
          $('.alertFormEmpresa').html('<p style="color:green">'+info.msg+'</p>');
          $('.alertFormEmpresa').slideDown();
        }else{
          $('.alertFormEmpresa').html('<p style="color:red">'+info.msg+'</p>');
        }
        $('.alertFormEmpresa').slideDown();
        $('#frmEmpresa input').removeAttr('disabled');
    },
    error: function(error){
    }
  });
});
//SWEET ALERT ELIMIMNAR 
$('.confirmar').submit(function(e) {
  e.preventDefault();
  Swal.fire({
    title: 'Esta seguro de eliminar?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar'
  }).then((result) => {
    if (result.isConfirmed) {
      this.submit();
    }
  })
});
//VALIDAR PASSWORD
function validPass() {
  var passNuevo = $('#txtNewPassUser').val();
  var confirmPassNuevo = $('#txtPassConfirm').val();
  if (passNuevo != confirmPassNuevo) {
    $('.alertChangePass').html('<p style="color:red;">Las contraseñas no Coinciden</p>');
    $('.alertChangePass').slideDown();
    return false;
  }
  if (passNuevo.length < 5) {
  $('.alertChangePass').html('<p style="color:red;">Las contraseñas deben contener como mínimo 5 caracteres');
  $('.alertChangePass').slideDown();
  return false;
}
$('.alertChangePass').html('');
$('.alertChangePass').slideDown();
}
//ANULAR FACTURA
function anularFactura(){
  var noFactura = $('#no_factura').val();
  var action = 'anularFactura';

      $.ajax({
      url: 'funciones.php',
      type: 'POST',
      async: true,
      data: {action:action,noFactura:noFactura},

      success: function(response)
      {
       if(response == 'error'){
        $('.alertAddProduct').html('<p style="color:red;">Error al anular la factura.</p>');
       }else{
        $('#row_'+noFactura+' .estado').html('<span class="anulada">Anulada</span>');
        $('#form_anular_factura .btn_ok').remove();
        $('#row_'+noFactura+' .div_factura').html('<button type="button" class="btn_anular inactive"><i class="fa fa-ban" aria-hidden="true"></i></button>');
        $('.alertAddProduct').html('<p>Factura anulada.</p>');
       }
    },
    error: function(error) {
    }
  });
}
//GENERAR PDF DE FACTURA
function generarPDF(cliente,factura) {
  var ancho = 1000;
  var alto = 800;
  //calcular posicion x, y para centrar la ventana
  var x = parseInt((window.screen.width/2) - (ancho / 2));
  var y = parseInt((window.screen.height/2) - (alto / 2));

  $url = 'factura/generaFactura.php?cl='+cliente+'&f='+factura;
  window.open($url,"Factura","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
}
//ELIMINAR PRODUCTO DETALLE TEMP
function del_product_detalle(correlativo){
  var action = 'delProductoDetalle';
  var id_detalle = correlativo;

    $.ajax({
      url: 'funciones.php',
      type: 'POST',
      async: true,
      data: {action:action,id_detalle:id_detalle},

      success: function(response)
      {
      if(response != 'error')
      {
              var info = JSON.parse(response);
              $('#detalle_venta').html(info.detalle);
              $('#detalle_totales').html(info.totales);

              $('#txt_cod_producto').val('');
              $('#txt_descripcion').html('-');
              $('#txt_existencia').html('-');
              $('#txt_cant_producto').val('0');
              $('#txt_precio').html('0.00');
              $('#txt_precio_total').html('0.00');
              // Bloquear cantidad
              $('#txt_cant_producto').attr('disabled','disabled');
              // Ocultar boton agregar
              $('#add_product_venta').slideUp();
      }else{
              $('#detalle_venta').html('');
              $('#detalle_totales').html('');
      }
      viewProcesar();
    },
    error: function(error) {
    }
  }); 
}
//MOSTRAR / OCULTAR BOTON PROCESAR
function viewProcesar(){
  if ($('#detalle_venta tr').length > 0)
  {
    $('#btn_facturar_venta').show();
  }else{
    $('#btn_facturar_venta').hide();
  }
}
//MANTENER VENTA
function serchForDetalle(id) {
  var action = 'serchForDetalle';
  var user = id;

    $.ajax({
      url: 'funciones.php',
      type: 'POST',
      async: true,
      data: {action:action,user:user},

      success: function(response)
      {
          if(response != 'error')
          {
              var info = JSON.parse(response);
              $('#detalle_venta').html(info.detalle);
              $('#detalle_totales').html(info.totales);

          }else{
            console.log('No Hay Datos');
          }
           viewProcesar();
    },
    error: function(error) {
    }
  });
}
//DESCUENTO PRODUCTO
function sendDataProduct(){
 $('.alertAddProduct').html('');
 $.ajax({
  url: 'funciones.php',
  type: 'POST',
  async: true,
  data: $('#form_add_product').serialize(),

  success: function(response){
    if(response == 'error')
    {
      $('.alertAddProduct').html('<p style="color: red;">Error al Agregar Descuento</p>');
    }else{
      var info = JSON.parse(response);
      $('.row'+info.producto_id+' .celPrecio').html(info.nuevo_precio);
       $('.row'+info.producto_id+' .celDesc').html(info.descuento);
      $('#txtPrecio').val('');
      $('.alertAddProduct').html('<p>Descuento agregado Correctamente</p>');
    }
  },
  error: function(error){
    console.log(error);
  }
});
}
//ELIMINAR PRODUCTO
function delProduct(){
  var pr = $('#producto_id').val();
  $('.alertAddProduct').html('');
  $.ajax({
    url: 'funciones.php',
    type: 'POST',
    async: true,
    data: $('#form_del_product').serialize(),

    success: function(response) {
      console.log(response);
      if(response == 'error')
      {
        $('.alertAddProduct').html('<p style="color: red;">Error al eliminar Producto</p>')
      }else{
        $('.row'+pr).remove();
        $('#form_del_product .btn_ok').remove();
        $('.alertAddProduct').html('<p>Producto eliminado Correctamente</p>')
      }
    },
    error: function(error) {
      console.log(error);
    }
  });
}
function closeModal(){
  $('#alertAddProduct').html('');
  $('#txtCantidad').val('');
  $('#txtPrecio').val('');
  $('.modal').fadeOut();
}
