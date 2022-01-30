<template>
  <div>
                            <div class="form-group">
                                    <label class="float-left" for="beneficiario">Nombre completo*</label>
                                    <input v-model="resumen_envio.nombre_completo" class="form-control is-valid" readonly id="beneficiario" type="text" required >
                                </div>

                                <div class="form-group">
                                    <label class="float-left" for="correo_envio">Correo electrónico*</label>
                                    <input v-model="resumen_envio.correo" class="form-control is-valid" readonly id="correo_envio" type="text" required>
                                </div>

                                <div class="form-group">
                                    <label class="float-left" for="valor_envio">Valor por hora*</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <input class="form-control is-valid" readonly id="PayboxAmount"  v-model="resumen_envio.valor_enviar" type="text" required>
                                        </div>
                                        <div class="col-1">
                                            <a href="#" type="button" @click="incrementar_valor('incrementar')"  class="btn bg-verde text-light lift" > + </a>
                                        </div>
                                       
                                        
                                        <div class="col-2">
                                            <a href="#" type="button" @click="incrementar_valor('reducir')" class="btn bg-danger float-left text-light lift" > - </a>
                                        </div>
                                    </div>
                                     
                                </div>

  </div>
</template>

<script>
export default {
    props:['id_tutor','nombre_completo','correo','valor_por_hora','valor_enviar'],
    data(){
        return{
            resumen_envio:{
                id_tutor: 0,
                nombre_completo:"",
                correo: "",
                valor_por_hora: 0,
                valor_enviar: 0
            }
        }
    },
    methods:{
        incrementar_valor(accion){
            var valor_inicial = this.resumen_envio.valor_por_hora;
            //var valor_limite = parseFloat(this.resumen_envio.valor_por_hora * 5);
             if(accion =="incrementar") {
                var valor_inc = this.resumen_envio.valor_enviar;
                valor_inc = parseFloat(valor_inc) + parseFloat(valor_inicial);
                console.log(valor_inc.toFixed(2));
                //valor_inc = parseFloat(valor_inc+valor_inicial/100);
                this.resumen_envio.valor_enviar = valor_inc.toFixed(2);
                
                
            }if(accion =="reducir") {
                var valor_inc = this.resumen_envio.valor_enviar;
                valor_inc = parseFloat(valor_inc) - parseFloat(valor_inicial);
                //console.log(valor_inc.toFixed(2));
                //valor_inc = parseFloat(valor_inc+valor_inicial/100);
                if (valor_inc <= 0.00) {
                     this.resumen_envio.valor_enviar =valor_inicial
                }else{
                    this.resumen_envio.valor_enviar = valor_inc.toFixed(2);
                }
               
                 
            }
        },

        renderizar_resumen(id_usuario,nombres,apellidos,correo,){

            this.resumen_envio.id_tutor = id_usuario;
            this.resumen_envio.nombre_completo = nombres +" "+apellidos;
            this.resumen_envio.correo = correo,
            this.ObtenerValorPorHora(id_usuario);
            
        },


        boton_pago(valor){
            
            console.log(valor);
            payphone.Button({
            //token obtenido desde la consola de developer
            token:"ugf_wu00gnMJP7c-IZBGD54cw1HKOMwM-EKwousWWBBMXg3K_8s3FleLZxD2fo8Bpj_5yvxSxJs4fWAMpeO4zCWce9XtyDASJbY_6TVqKwR55-__M563ZDiwZ7RxkojwMExVGPsOzb-8SKULiAxTirYLisAU0pGRFcVEb607Fc8J67lkU_kAWS6TpiUmRu6wNa0SWh3kZz5yrs9rzXXaDNvU0Ex_s8g6Y87srIPAU5OirkxcwUIoTqTW22V_mMteYGFOLgve-a8tBtQLz2lc9g3ox2VTV4Y0skS4JSHoGWTqRCB9GBt-VXy4oKAMl2hLTqbthA",
            //PARAMETROS DE CONFIGURACIÓN
            btnCard: false,
            btnHorizontal: true,
            createOrder: function(actions){
                    //Se ingresan los datos de la transaccion ej. monto
                    return actions.prepare({
                        amount: valor,
                        amountWithoutTax: valor,
                        currency: "USD",
                        clientTransactionId: "12333556WQQ454545646"
                    });
                    },
            onComplete: function(model, actions){
            //Se confirma el pago realizado
            actions.confirm({
            id: model.id,
            clientTxId: model.clientTxId
            }).then(function(value){
            //EN ESTA SECCIÓN SE PROCESA LA RESPUESTA CON LOS DATOS DE RESPUESTA                                   
            if (value.transactionStatus == "Approved"){
            //alert("Pago" + value.transactionId + " recibido, estado " + value.transactionStatus );
            alert("OK" );
            }
            }).catch(function(err){
            console.log(err);
            });
            }
            }).render("#pp-button");
        }
    }
}
</script>

<style>

</style>