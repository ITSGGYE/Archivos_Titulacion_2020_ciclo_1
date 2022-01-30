function agregar_producto(){    
    var parametros = new FormData($("#ingresar_productos")[0]);

    $.ajax({
        data: parametros,
        url: "",
        type: "post",
        contentType: false,
        processData: false,
        beforesend: function(){

        },
        success: function(response){
            //escuchando...
                                       
        }
        
    });
         
}

function actualizar_producto(){
    var parametros = new FormData($("#actualizar_productos")[0]);
    alertify.set('notifier', 'position', 'top-right');
    alertify.success('Operacion exitosa');          
    $.ajax({
        data: parametros,
        url: "",
        type: "post",
        contentType: false,
        processData: false,
        beforesend: function(){

        },
        success: function(response){
            //escuchando...
                           
        }
        
    });
         
}

function ver_producto($datos) {
    $muestra = $datos.split('||');
    
    $('#id_u').val($muestra[0]);
    $('#nombre_u').val($muestra[1]);
    $('#correo_u').val($muestra[2]);
    $('#direccion_u').val($muestra[3]);
    $('#telefono_u').val($muestra[4]);
    $('#fecha_u').val($muestra[5]);
    $('#hora_u').val($muestra[6]);
    $('#especialidad_u').val($muestra[7]);  
    $('#descripcion_u').val($muestra[8]);    

}

function confirmar($datos){
    //un confirm
    alertify.confirm("<strong>Eliminar dato.</strong> ¿Estas seguro de eliminar este registro?", 
        function (){ alertify.set('notifier', 'position', 'top-right'); eliminar_producto($datos); alertify.success('Eliminado'); });    
}

function eliminar_producto($datos){
    $muestra = $datos.split('||');
    $('#id_i').val($muestra[0]);

    var parametros = new FormData($("#actualizar_productos")[0]);

    $.ajax({
        data: parametros,
        url: "",
        type: "post",
        contentType: false,
        processData: false,
        beforesend: function(){

        },
        success: function(response){
            //escuchando...
                                       
        }
        
    });
}