<template>

<div id="Mistutores">
    <fieldset class="mx-5">
        <legend> <Strong>Mis Tutores Asignados</Strong> </legend>
        <div class="row ">
            <div class="col-md-5" v-for="(tutor,i) in lista_tutores" :key="i">
                    <div class="card card card-body-actions mx-auto">
                        <div class="row no-gutters">
                            <div class="col-md-4"><img class="img-fluid" :src="url+tutor.id_tutor.id_usuario.id_persona.foto" alt="..."></div>
                            <div class="col-md-8">
                            
                                    
                                <div class="card-body">
                                    
                                    <h5 class="card-title">
                                        
                                            
                                        
                                          
                                    <span class="float-center"> 

                                        {{tutor.id_tutor.id_usuario.id_persona.nombres}} {{tutor.id_tutor.id_usuario.id_persona.apellidos}} 
                                        <button @click="borrar_tutor('form',tutor)" class="btn btn-outline-red btn-icon   float-right btn-sm" data-toggle="modal" data-target="#eliminar" title="Borrar tutor de mi lista"  type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                </svg>      
                                        </button>
                                    </span>
                                   
                                    
                                    </h5>
                                    <p class="card-text">
                                        <span class="float-center"> <strong>Correo: </strong> {{tutor.id_tutor.id_usuario.correo}} </span> <br>
                                        <span class="float-center"> <strong>Identificación: </strong> {{tutor.id_tutor.id_usuario.id_persona.identificacion}}</span>
                                        <br>
                                       
                                            
                                            <span class="py-2">
                                                <a href="#" @click="evaluar_tutor(tutor,'evaluar')" data-toggle="modal" data-target="#evaluar" class="btn-sm btn  bg-verde text-light" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                                    </svg>
                                                    &nbsp;
                                                    Evaluar tutor
                                                
                                                </a>
                                            </span>                                         
                                            <span class=" py-2"> 
                                                <a href="#" @click="renderizar_resumen(tutor.id_tutor.id_usuario.id_usuario,tutor.id_tutor.id_usuario.id_persona.nombres, tutor.id_tutor.id_usuario.id_persona.apellidos,tutor.id_tutor.id_usuario.correo)" data-toggle="modal" data-target="#resumen_envio" class="btn  bg-naranja text-light btn-sm " type="button">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wallet2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                                                    </svg>
                                                    &nbsp;
                                                    Enviar pago
                                                </a>
                                            </span>
                                            <br><br>

                                      
                                    </p>    
                                </div>
                            </div>
                        </div>
                    </div>
            </div>


             


            
        </div>
       
    </fieldset>
            

         <div class="modal fade" id="resumen_envio" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-verde text-light">
                        <h5 class="modal-title  text-light" id="staticBackdropLabel"> 
                            
                            <span v-show="step=='cotizar'">
                                Selecciona la cantidad a enviar.    
                            </span>
                            <span v-show="step=='enviar'">
                                Resumen de envío.    
                            </span>
                        </h5>
                        <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div v-show="step=='cotizar'" class="modal-body">
                        
                                <div class="form-group">
                                    
                                    <div class="row justify-content-center">
                                        <div class="col-5">
                                            <input class="form-control is-valid" readonly id="valor_envio"  v-model="resumen_envio.valor_enviar" type="text" required>
                                        </div>

                                        <div class="col-2">
                                            <a href="#" type="button" @click="incrementar_valor('incrementar')"  class="btn bg-verde text-light lift" > + </a>
                                            <a href="#" type="button" @click="incrementar_valor('reducir')" class="btn bg-danger float-left text-light lift" > - </a>
                                        </div>
                                        
                                        
                                    </div>
                                </div>

                                

                               

                            <div class="modal-footer">
                                <button   class="btn bg-verde text-light lift" @click="boton_pago(resumen_envio.valor_enviar)">Continuar</button>
                            </div>
                        
                    </div>

                    <div v-show="step=='enviar'" class="modal-body">
                        


                                <div class="form-group">
                                    <label class="float-left" for="beneficiario">Nombre completo*</label>
                                    <input v-model="resumen_envio.nombre_completo" class="form-control is-valid" readonly id="beneficiario" type="text" required >
                                </div>

                                <div class="form-group">
                                    <label class="float-left" for="correo_envio">Correo electrónico*</label>
                                    <input v-model="resumen_envio.correo" class="form-control is-valid" readonly id="correo_envio" type="text" required>
                                </div>

                                <div class="form-group">
                                    <label class="float-left" for="valor_envio">Valor a enviar*</label>
                                    <input class="form-control is-valid" readonly id="PayboxAmount"  v-model="resumen_envio.valor_enviar" type="text" required>
    
                                </div>

                                <div v-if="step=='enviar'" id='pp-button'></div>

                               

                            <div class="modal-footer">
                                <button   class="btn bg-danger text-light lift" @click="step='cotizar'" >Volver</button>
                                <button   class="btn bg-verde text-light lift" @click="step='cotizar'" data-dismiss="modal">Finalizar</button>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="evaluar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-verde text-light">
                        <h5 class="modal-title text-light" id="staticBackdropLabel">Evaluar tutor</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                            <div class="modal-body" v-if="tutor.id_tutor != undefined">
                                <center class="h4">Relizar evaluacion a <strong> {{tutor.id_tutor.id_usuario.id_persona.nombres}}  {{tutor.id_tutor.id_usuario.id_persona.apellidos}} </strong> </center>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <form @submit.prevent="calcular_nota" id="FormularioEvaluacion">
                                            <div class="form-group">
                                            <label for="primera_pregunta" class="float-left">Como fue su experiencia con respecto a las clases del tutor?</label>
                                            <select class="form-control" required v-model="respuestas.pregunta_1" id="primera_pregunta">
                                                <option value="2">Excelente</option>
                                                <option value="1.5">Bien</option>
                                                <option value="1">Debe mejorar</option>
                                                <option value="0">No cumplio mis espectativas</option>
                                            </select>
                                            </div>

                                            <div class="form-group">
                                            <label for="primera_pregunta" class="float-left">Expresó con claridad Y fluidez los temas planteados?</label>
                                            <select class="form-control" required v-model="respuestas.pregunta_2" id="segunda_pregunta">
                                                <option value="2">Excelente</option>
                                                <option value="1.5">Bien</option>
                                                <option value="1">Debe mejorar</option>
                                                <option value="0">No cumplio mis espectativas</option>
                                            </select>
                                            </div>

                                            <div class="form-group">
                                            <label for="primera_pregunta" class="float-left">Despejó dudas en torno a cada explicación?</label>
                                            <select class="form-control" required v-model="respuestas.pregunta_3" id="tercera_pregunta">
                                                <option value="2">Excelente</option>
                                                <option value="1.5">Bien</option>
                                                <option value="1">Debe mejorar</option>
                                                <option value="0">No cumplio mis espectativas</option>
                                            </select>
                                            </div>


                                            <div class="form-group">
                                            <label for="primera_pregunta" class="float-left">Pregunta 4</label>
                                            <select class="form-control" required v-model="respuestas.pregunta_4" id="cuarta_pregunta">
                                                <option value="2">Excelente</option>
                                                <option value="1.5">Bien</option>
                                                <option value="1">Debe mejorar</option>
                                                <option value="0">No cumplio mis espectativas</option>
                                            </select>
                                            </div>

                                            <div class="form-group">
                                            <label for="primera_pregunta" class="float-left">Pregunta 5</label>
                                            <select class="form-control" required v-model="respuestas.pregunta_5" id="quinta_pregunta">
                                                <option value="2">Excelente</option>
                                                <option value="1.5">Bien</option>
                                                <option value="1">Debe mejorar</option>
                                                <option value="0">No cumplio mis espectativas</option>
                                            </select>
                                            </div>

                                            
                                            <div class="form-group">
                                            <label for="primera_pregunta" class="float-left">Comentario positivo(Este comentario es anónimo).</label>
                                                <textarea name="comentario"  placeholder="Es opcional. Escribe sobre alguna cualidad o detalle que quieras destacar del tutor." class="form-control" v-model="respuestas.comentario" id="comentario"></textarea>
                                            </div>  

                                            <div class="form-group">
                                                <label for="primera_pregunta" class="float-left">Comentario negativo (Este comentario es anónimo).</label>
                                                <textarea name="comentario" class="form-control"  placeholder="Es opcional. Escribe sobre alguna novedad o inconveniente que el tutor deba mejorar (Comentario anonimo)." v-model="respuestas.comentario_negativo" id="comentario"></textarea>
                                            </div>  
                                       
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger lift" data-dismiss="modal">Cancelar</button>
                                <button type="submit" form="FormularioEvaluacion" class="btn bg-verde text-light lift">Finalizar</button>
                                
                            </div>
            
                    </div>
                </div>
            </div>
        </div>



         <div class="modal fade" id="denunciar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-light">
                        <h5 class="modal-title  text-light" id="staticBackdropLabel">Relizar comentario constructivo a este tutor.</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" @submit.prevent="calcular_nota">
                            <div class="modal-body">
                                <div class="form-group">
                                        <label for="primera_pregunta" class="float-left">.</label>
                                        <textarea name="comentario" class="form-control" v-model="respuestas.comentario_negativo" id="comentario"></textarea>
                                </div>  
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn bg-verde text-light lift">Finalizar</button>
                                <button type="button" class="btn btn-danger lift" data-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

         <div class="modal fade" id="eliminar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-light">
                        <h5 class="modal-title  text-light" id="staticBackdropLabel">Estas seguro de eliminar este tutor de tu lista? </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" @submit.prevent="borrar_tutor('borrar',tutor_eliminar)">
                            <div class="modal-body">
                                <div class="form-group">
                                        <span class=" strong ">- {{tutor_eliminar.nombre}}</span><br>
                                        <span class=" strong ">- {{tutor_eliminar.correo}}</span><br>
                                        <span class=" strong ">- {{tutor_eliminar.ident}}</span>
                                        
                                </div>  
                            </div>
                            <div class="modal-footer">
                                
                                <button type="button" class="btn btn-danger lift" data-dismiss="modal">Cancelar</button>
                                <button type="submit" data-dismiss="modal" class="btn bg-verde text-light lift">Confirmar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

    

</template>

<script>
import axios from 'axios';
import swal from 'sweetalert';
export default {
    name:'Mistutores',
    data(){ return{
            lista_tutores : [],
            step:'cotizar',
            url: "http://173.212.250.236:8000",
            generar_envio: false,
            boton_de_pago :"",
            tutor_eliminar: {
                id_evaluacion:0,
                id_tutor: 0,
                nombre: "",
                ident:"",
                correo:""
            },
            tutor: {},
            resumen_envio:{

                id_tutor: 0,
                nombre_completo:"",
                correo: "",
                valor_por_hora: 0,
                valor_enviar: 0
            },
            respuestas: {
                ident:"",
                id_tutor: 0,
                id_estudiante: 0,
                pregunta_1: 0,
                pregunta_2: 0,
                pregunta_3: 0,
                pregunta_4: 0,
                pregunta_5: 0,
                comentario:'',
                comentario_negativo:'',
                total: 0

            }
        }
    
    },
    methods: {

        borrar_tutor(proceso,obj){
            if (proceso=="form") {
                this.tutor_eliminar.id_tutor = obj.id_tutor.id_tutor;
                this.tutor_eliminar.nombre = obj.id_tutor.id_usuario.id_persona.nombres+" "+obj.id_tutor.id_usuario.id_persona.apellidos;
                this.tutor_eliminar.ident = obj.id_tutor.id_usuario.id_persona.identificacion;
                this.tutor_eliminar.correo = obj.id_tutor.id_usuario.correo;
            }else{
                const path = this.url+"/AsignarTutor/?id_tutor="+this.tutor_eliminar.id_tutor
                axios.delete(path).then(response => {
                    this.tutor_eliminar.nombre="";
                    this.tutor_eliminar.correo="";
                    this.tutor_eliminar.ident="";
                    swal("Registro borrado","","warning");
                    this.listar_tutores();
                })
                .catch((error) => {
                    console.log(error);
                })
            }
        },

        incrementar_valor(accion){
            //this.generar_envio = false;
            
            var valor_inicial = this.resumen_envio.valor_por_hora;
            //var valor_limite = parseFloat(this.resumen_envio.valor_por_hora * 5);
             if(accion =="incrementar") {

                var valor_inc = this.resumen_envio.valor_enviar;
                valor_inc = parseFloat(valor_inc) + parseFloat(valor_inicial);
                //console.log(valor_inc.toFixed(2));
                //valor_inc = parseFloat(valor_inc+valor_inicial/100);
                this.resumen_envio.valor_enviar = valor_inc.toFixed(2);
  
                
                
            }if(accion =="reducir") {
                //this.generar_envio = false;
                this.boton_de_pago = "";
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

        renderizar_resumen(id_usuario,nombres,apellidos,correo){
            $('#pp-button').children('button').remove();
            this.resumen_envio.id_tutor = id_usuario;
            this.resumen_envio.nombre_completo = nombres +" "+apellidos;
            this.resumen_envio.correo = correo,
            this.ObtenerValorPorHora(id_usuario);
            //this.boton_pago(this.resumen_envio.valor_enviar);
            
            
        },

        

        mostrar_evaluacion(ident){
            const id_usuario = localStorage.getItem("Usuario");
            const path = this.url+"/EvaluacionEstudianteApi/?id_usuario="+id_usuario+"&ident="+ident;
            axios.get(path).then((response) => {
                if(response.status === 200){
                    console.log(response.data)
                    this.respuestas = response.data
                }
            }).catch((err) => {
                console.log(err);
            });



        },

        sumar_nota(){
            var sum = 0;
            for(var el in this.respuestas){
                if(el == 'pregunta_1' || el == 'pregunta_2' || el == 'pregunta_3' || el == 'pregunta_4' || el == 'pregunta_5' ){
                    sum +=  parseFloat(this.respuestas[el]);
                }
            }
            //console.log("total: "+ sum);
            return sum;
        },

        calcular_nota(){
            this.respuestas.id_tutor = this.tutor.id_tutor.id_tutor
            this.respuestas.total = this.sumar_nota();
            this.respuestas.ident = this.tutor.id_tutor.id_usuario.id_persona.identificacion;
            console.log("total: "+this.respuestas.total)           
            this.respuestas.id_estudiante = localStorage.getItem("Usuario");
            axios.post(this.url+"/EvaluacionEstudianteApi/",this.respuestas).then((response) => {
                if(response.status === 200){
                    swal("Evaluacion finalizada","Gracias por su tiempo","success");
                }
            }).catch((err) =>{
                console.log(err)
            });



        },

        ObtenerValorPorHora(id_tutor){
            const path = this.url+"/ValorPorHoraApi/?id="+id_tutor
            axios.get(path).then((response) => {
                //console.log(response.data)
                this.resumen_envio.valor_por_hora =  response.data[0].valor;
                this.resumen_envio.valor_enviar =  response.data[0].valor;
            })
            .catch((error) => {
                console.log(error);
            })
        },

        listar_tutores(){
            const id_usuario = localStorage.getItem("Usuario");
            const path = this.url+"/AsignarTutor/?id_usuario="+id_usuario;
            axios.get(path).then((response) => {
                console.log(response.data)
                this.lista_tutores = response.data;
            }).catch((err) => {
                console.log(err);
            });
        },

        evaluar_tutor(obj,tipo){
            this.tutor = obj
            this.mostrar_evaluacion(this.tutor.id_tutor.id_usuario.id_persona.identificacion)
            if(tipo == 'evaluar'){
                console.log("Tutor a evaluar:");
                console.log(this.tutor);
            }

            if (tipo == 'denunciar') {
                console.log("Tutor a denunciar:");
                console.log(this.tutor);            
            }

        },

        grabar_transaccion(nombre_tutor,correo,id_tutor,id_usuario,identifiacion,secuencial,){
            console.log('si funciona')
        },

        boton_pago(valor){
            this.step='enviar'
            console.log(valor);
            //this.boton_de_pago ="";
            //this.generar_envio = true;
            //this.boton_de_pago ="<div id='pp-button'></div>"
            setTimeout(() => { 
                    payphone.Button({
                    //token obtenido desde la consola de developer
                    token:"ugf_wu00gnMJP7c-IZBGD54cw1HKOMwM-EKwousWWBBMXg3K_8s3FleLZxD2fo8Bpj_5yvxSxJs4fWAMpeO4zCWce9XtyDASJbY_6TVqKwR55-__M563ZDiwZ7RxkojwMExVGPsOzb-8SKULiAxTirYLisAU0pGRFcVEb607Fc8J67lkU_kAWS6TpiUmRu6wNa0SWh3kZz5yrs9rzXXaDNvU0Ex_s8g6Y87srIPAU5OirkxcwUIoTqTW22V_mMteYGFOLgve-a8tBtQLz2lc9g3ox2VTV4Y0skS4JSHoGWTqRCB9GBt-VXy4oKAMl2hLTqbthA",
                    //PARAMETROS DE CONFIGURACIÓN
                    btnCard: true,
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
                        }else{

                        }
                    }).catch(function(err){
                    console.log(err);
                    });
                    }
                    }).render("#pp-button");


             },2000)
                    
                    
            
        }
   
    },
    created: function() {

        
        //
        this.listar_tutores();
        //this.mostrar_evaluacion();
        
    },
    mounted() {
         //this.boton_pago();
    }
}
</script>

<style>
     fieldset
	{
		border: 1px solid #ddd !important;
		margin: 0;
		xmin-width: 0;
		padding: 10px;
		position: relative;
		border-radius:4px;
		background-color:#f5f5f5;
		padding-left:10px!important;
	}

		legend
		{
			font-size:14px;
			font-weight:bold;
			margin-bottom: 0px;
			width: 35%;
			border: 1px solid #ddd;
			border-radius: 4px;
			padding: 5px 5px 5px 10px;
			background-color: #ffffff;
		}
</style>