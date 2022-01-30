<template>
 <div id="interes">
<div class="card card-scrollable">
    <div class="card-header bg-verde text-light">Intereses &nbsp;&nbsp; &nbsp; &nbsp;
        <a type="button" data-toggle="modal" data-target="#interes"><svg class="bi bi-plus-square" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd"></path></svg></a> &nbsp;&nbsp;
    </div>
        <div class="card-body">
            <table width="100%" class="table table-hover table-bordered" cellspacing="0">
                <tbody>
                    <tr data-toggle="modal" data-target="#interes" v-for="(c,indice) in estudiante.id_materias_afines" :key="indice">
                        <td> <strong>- {{get_ful_name(indice,"nombre")}} <br> - {{get_ful_name(indice,"tipo")}}</strong> </td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>


<div class="modal fade" id="interes" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-verde">
                <h5 class="modal-title text-light">Intereses</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <div class="col-md-4">
                        <fieldset>
                            <legend class="col-md-7"> Matemáticas </legend>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <label class="form-group" v-for="(m,indice) in buscar_tipo('matematica')" :key="indice">
                                            <input v-model="lista_display" type="checkbox" :checked="buscar(m.id_materias_afines)" :name="m.nombre" :value="m.id_materias_afines" class="checkboxinput" />
                                            {{m.nombre}} &nbsp;&nbsp; &nbsp; &nbsp;
                                        </label>
                                    </div>
                                </div>
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset>
                            <legend class="col-md-7"> Computación </legend>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <label class="form-group" v-for="(m,indice) in buscar_tipo('computacion')" :key="indice">
                                            <input v-model="lista_display" type="checkbox"  :name="m.nombre" :value="m.id_materias_afines" class="checkboxinput" />
                                            {{m.nombre}} &nbsp;&nbsp; &nbsp; &nbsp;
                                        </label>
                                    </div>
                                </div>
                        </fieldset>
                    </div>

                    <div class="col-md-4">
                        <fieldset>
                            <legend class="col-md-7"> Ciencia </legend>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <label class="form-group" v-for="(m,indice) in buscar_tipo('ciencia')" :key="indice">
                                            <input v-model="lista_display" type="checkbox"  :name="m.nombre" :value="m.id_materias_afines" class="checkboxinput" />
                                            {{m.nombre}} &nbsp;&nbsp; &nbsp; &nbsp;
                                        </label>
                                    </div>
                                </div>
                        </fieldset>

                        <fieldset>
                            <legend class="col-md-7"> Finanzas y economía </legend>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <label class="form-group" v-for="(m,indice) in buscar_tipo('economia')" :key="indice">
                                            <input v-model="lista_display" type="checkbox"  :name="m.nombre" :value="m.id_materias_afines" class="checkboxinput" />
                                            {{m.nombre}} &nbsp;&nbsp; &nbsp; &nbsp;
                                        </label>
                                    </div>
                                </div>
                        </fieldset>

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>
                <button class="btn bg-verde text-light" type="button" @click="Guardar_cambios" >Guardar cambios</button>
                
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
    name: 'interes',
    data(){
        return{
            url: "http://173.212.250.236:8000",
            estudiante:{
                id_estudiante:0,
                id_usuario:0,
                id_materias_afines:[]
            },
            lista_materias:[],

            lista_display:[]

        }
    },
    methods:{
        llenar_informacion(){
            const usuario = localStorage.getItem("Usuario")
            const path = this.url+"/MateriasEstudianteApi/?id="+usuario
            axios.get(path).then((response) => {
                //console.log(response.data)
                this.estudiante = response.data
                this.lista_display = this.estudiante.id_materias_afines
            })
            .catch((error) => {
                console.log(error);
            })
        },
        get_ful_name(indice,tipo){
            const lista = this.lista_materias
            var name = ""
            lista.forEach(element => {
                if(element.id_materias_afines == this.estudiante.id_materias_afines[indice]){
                    if(tipo == 'tipo'){
                        name = element.tipo
                    }else{
                        name = element.nombre
                    }

                }
            });
            return name
        },

        buscar(id,tipo){
            const lista = this.estudiante.id_materias_afines
            var name = false
            for (let index = 0; index < lista.length; index++) {
                const element = lista[index];
                if(element == id){
                    name = true
                }else{
                  name =  false
                }
            }
            return name
        },

          Guardar_cambios(){
            const path = this.url+"/MateriasEstudianteApi/"
            this.estudiante.id_materias_afines = this.lista_display
             axios.put(path, this.estudiante, // the data to post
                    { headers: {'Content-type': 'application/json','accept':'application/json'}
                }).then(response => {
                         //console.log(response.data);
                         swal("Cambios Guardados","Se han registrados tus intereses","success")
                         this.llenar_informacion()
                         this.listar()
                })
               .catch((error) => {
                   console.log(error);
               })
        },

        buscar_tipo(tipo){
            return this.lista_materias.filter(c => c.tipo.toLowerCase().indexOf(tipo) > -1);
        },

        listar_table(val){
             var bandera = false
             for (let index = 0; index < this.estudiante.id_materias_afines.length; index++) {
                const element = this.estudiante.id_materias_afines[index];
                if(element != val){
                     bandera = true
                     //console.log(this.estudiante.id_materias_afines)
                }
            }
            if(bandera){
                this.estudiante.id_materias_afines.push(val)
            }

        },

        listar(){
            const path = this.url+"/MateriasApi/"
            axios.get(path).then((response) => {
                //console.log(response.data)
                this.lista_materias = response.data
            })
            .catch((error) => {
                console.log(error);
            })
        }
    },

    created: function(){
        this.llenar_informacion()
        this.listar()
    },
    computed:{

    }




}
</script>

<style scoped>

</style>

