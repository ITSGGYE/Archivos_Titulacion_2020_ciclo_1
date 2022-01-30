<template>
<div id="educacion_tutor">
<div class="card card-scrollable">
    <div class="card-header bg-verde"> <span class="text-light"> <strong> Valor por hora </strong>  </span>  &nbsp;&nbsp; &nbsp; &nbsp;
        <!--
        <a type="button" class="text-light" data-toggle="modal" data-target="#GuardarModalValor"><svg class="bi bi-plus-square" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd"></path></svg></a> &nbsp;&nbsp;
        -->
    </div>
        <div class="card-body">
                                          
            <table width="100%" class="table table-hover table-bordered" cellspacing="0"> 
                <tbody>
                    <tr @click="llenar_formulario(c.idValorPorHora)"  data-toggle="modal" data-target="#EditarModalValor" v-for="(c,indice) in Valores_list" :key="indice">
                        <td>{{c.valor}}</td>
                        <td>
                            
                            <a  type="button" @click="llenar_formulario(c.idValorPorHora)"  data-toggle="modal" data-target="#EditarModalValor">
                                <svg class="bi bi-pencil-square " width="1.6em" height="1.6em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"></path>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <!--
                            <a type="button" @click="Eliminar(c.idValorPorHora)">
                                <svg class="bi bi-x-circle-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/>
                                </svg>
                            </a>
                            -->
                            
                        </td>
                    </tr>       
                </tbody>
            </table>                              
        </div>


        
         
    </div>

            <div class="modal fade" id="EditarModalValor" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            
           

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-verde">
                        <h5 class="modal-title text-light" id="staticBackdropLabel">Editar Valor por hora</h5>
                    </div>
                    <div class="modal-body">
                        <toast_mensaje v-show="mostrar" :mensaje="mensaje" :tipo_mensaje="tipo_mensaje" :mostrar="mostrar" />
                        <form method="POST" @submit.prevent="Editar">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="text-dark float-left" for="valorPorHora">Valor por hora</label> 
                                    <input @keypress="onlyNumber" required class="form-control" :class="invalid" id="valorPorHora" type="text" v-model="Editformulario.valor">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
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
import toast_mensaje from '../utils_components/toast_mensaje';
export default {
    name: 'educacion_tutor',
    props:["id"],
    components: {toast_mensaje},
    data(){
        return{

            tipo_mensaje:"alert-success",//alert-danger, alert-warning, alert-success
            mensaje:"Cambios guardados",
            mostrar:false,


            url: "http://173.212.250.236:8000",
            Valores_list: [],
            formulario: {
                idValorPorHora: 0,
                id_tutor : 0,
                valor: ""
            },

            Editformulario:{
                idValorPorHora: 0,
                id_tutor : 0,
                valor: ""
            },
            invalid: 'is-valid'

        }
    },
    methods:{
        
         onlyNumber ($event) {
            //console.log($event.keyCode); //keyCodes value
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);

            if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 is dot
                $event.preventDefault();
            }
        },
         llenar_formulario(id){
            const path = this.url+"/ValorPorHoraApi/?idValorPorHora="+id
            axios.get(path).then((response) => {
                    this.Editformulario.idValorPorHora= response.data.idValorPorHora
                    this.Editformulario.id_tutor = response.data.id_tutor
                    this.Editformulario.valor = response.data.valor
                    //console.log(this.Editformulario)
            })
            .catch((error)=>{
                consolose.log(error)
            })
        },

        Listar(){
            const usuario = localStorage.getItem("Usuario")
            const path = this.url+"/ValorPorHoraApi/?id="+usuario
            axios.get(path).then((response) => {
                //console.log(response.data)
                if(response.data.lenght == 0){
                    this.Valores_list = 'Vacio'    
                }else{
                    this.Valores_list = response.data
                }
                
            })
            .catch((error) => {
                console.log(error);
            })
        },
        
        Editar(){
             
             const path = this.url+"/ValorPorHoraApi/"
             axios.put(path, this.Editformulario, // the data to post
                    { headers: {'Content-type': 'application/json','accept':'application/json'}
                }).then(response => {
                         //console.log(response.data);
                         //swal("Cambios Guardados","","success");
                         this.Listar();
                         this.mensaje="Valor por hora acualizado"
                         this.mostrar=true;
                         setTimeout(() => { this.mostrar=false },3000)
                })
               .catch((error) => {
                   console.log(error);
               })
        },

        
    },
    created: function(){
        this.Listar();
        //$('#toastBasic').toast('show');
    },
    
}
</script>

<style>

</style>