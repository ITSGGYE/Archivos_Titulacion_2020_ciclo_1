<template>
<div id="experiencia_tutor">
<div class="card card-scrollable">
    <div class="card-header bg-verde" > <span class="text-light "> <strong>Experiencia</strong>  </span>  &nbsp;&nbsp; &nbsp; &nbsp;
        <a type="button" data-toggle="modal" class="text-light" data-target="#staticBackdrop"><svg class="bi bi-plus-square" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd"></path></svg></a> &nbsp;&nbsp;
    </div>
        <div class="card-body">
            <table width="100%" class="table table-hover table-bordered" cellspacing="0">
                <tbody>
                    <tr v-for="(c,indice) in Experiencia_list" :key="indice">
                        <td>{{c.cargo}}</td>
                        <td v-if="c.tipo_empleo == 'MT'">Medio tiempo</td>
                        <td v-if="c.tipo_empleo == 'TP'"> Tiempo Completo</td>
                        <td>{{c.empresa}}</td>
                        <td>{{c.ubicacion}}</td>
                        <td>{{c.fecha_inicio}}</td>
                        <td>{{c.fecha_fin}}</td>
                        <td>
                            <a type="button" @click="llenar_formulario(c.id_experiencia)"  data-toggle="modal" data-target="#editar">
                                <svg class="bi bi-pencil-square" width="1.6em" height="1.6em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"></path>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"></path>
                                </svg>
                            </a>

                              <a type="button" @click="eliminar_experiencia(c.id_experiencia)">
                                <svg class="bi bi-x-circle-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>

        <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-verde">
                        <h5 class="modal-title text-light" id="staticBackdropLabel">Agregar nueva experiencia.</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" @submit.prevent="agregar_Experiencia">
                            <div class="modal-body">
                                 <div class="form-group">
                                    <label class="text-dark float-left" for="cargof">Cargo</label>
                                    <input required v-model="formulario.cargo" class="form-control" id="cargof" type="text">
                                </div>


                                 <div class="form-group">
                                    <label for="tipo_empleoET" class="text-dark float-left">Tipo empleo</label>
                                    <select required class="form-control" name="tipo_empleo" v-model="formulario.tipo_empleo" id="tipo_empleoET">
                                        <option value="MT">Medio tiempo</option>
                                        <option value="TP">Tiempo completo</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="text-dark float-left" for="empresaET">Empresa</label>
                                    <input required class="form-control" id="empresaET" type="text" v-model="formulario.empresa">
                                </div>

                                <div class="form-group">
                                    <label class="text-dark float-left" for="ubicacionET">Ubicacion</label>
                                    <input required class="form-control" id="ubicacionET" type="text" v-model="formulario.ubicacion">
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            <label class="text-dark float-left" for="fecha_inicioET">Fecha incio</label>
                                            <input  class="form-control" id="fecha_inicioET" type="date" v-model="formulario.fecha_inicio">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-dark float-left" for="fecha_finET">Fecha fin</label>
                                            <input  class="form-control" id="fecha_finET" type="date" v-model="formulario.fecha_fin">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                  <label for="tipo_empleoET" class="text-dark float-left">Estado</label>
                                    <select required class="form-control" name="tipo_empleoET" v-model="formulario.estado" id="tipo_empleo">
                                        <option value="Actualmente en el cargo">Actualmente en el cargo</option>
                                        <option value="Cargo Finalizado"> Cargo Finalizado </option>
                                    </select>
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

         <div class="modal fade" id="editar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar información</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" @submit.prevent="editar_Experiencia">
                            <div class="modal-body">
                                 <div class="form-group">
                                    <label class="text-dark float-left" for="cargoEtt">Cargo</label>
                                    <input required v-model="Editformulario.cargo" class="form-control" id="cargoEtt" type="text">
                                </div>


                                 <div class="form-group">
                                    <label for="tipo_empleoEET" class="text-dark float-left">Tipo empleo</label>
                                    <select required class="form-control" name="tipo_empleo" v-model="Editformulario.tipo_empleo" id="tipo_empleoEET">
                                        <option value="MT">Medio tiempo</option>
                                        <option value="TP">Tiempo completo</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="text-dark float-left" for="empresaEET">Empresa</label>
                                    <input required class="form-control" id="empresaEET" type="text" v-model="Editformulario.empresa">
                                </div>

                                <div class="form-group">
                                    <label class="text-dark float-left" for="ubicacionEET">Ubicacion</label>
                                    <input required class="form-control" id="ubicacionEET" type="text" v-model="Editformulario.ubicacion">
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            <label class="text-dark float-left" for="fecha_inicioEET">Fecha incio</label>
                                            <input required class="form-control" id="fecha_inicioEET" type="date" v-model="Editformulario.fecha_inicio">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-dark float-left" for="fecha_finEET">Fecha fin</label>
                                            <input required class="form-control" id="fecha_finEET" type="date" v-model="Editformulario.fecha_fin">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                  <label for="tipo_empleoEET" class="text-dark float-left">Estado</label>
                                    <select required class="form-control" name="tipo_empleo" v-model="Editformulario.estado" id="tipo_empleoEET">
                                        <option :selected="Editformulario.estado == 'Actualmente en el cargo'" value="Actualmente en el cargo">Actualmente en el cargo</option>
                                        <option :selected="Editformulario.estado == 'Finalizado'"  value="Cargo Finalizado"> Cargo Finalizado </option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar  Cambios</button>
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
    name: 'experiencia_tutor',
    props:["id"],
    data(){
        return {
            url: "http://173.212.250.236:8000",
            Experiencia_list: [],
            formulario: {
                id_experiencia: 0,
                id_tutor : 0,
                cargo: "",
                tipo_empleo: null,
                empresa: "",
                ubicacion: "",
                estado: 'Finalizado',
                fecha_inicio:'',
                fecha_fin:''

            },
            Editformulario:{
                id_experiencia: 0,
                id_tutor : 0,
                cargo: "",
                tipo_empleo: null,
                empresa: "",
                ubicacion: "",
                estado: 'Finalizado',
                fecha_inicio:'',
                fecha_fin:''

            }
        }


    },

    methods:{
        listar_Experiencia(){
            const usuario = localStorage.getItem("Usuario")
            const path = this.url+"/ExperienciaApi/?id="+usuario
            axios.get(path).then((response) => {
                //console.log(response.data)
                this.Experiencia_list = response.data
            })
            .catch((error) => {
                console.log(error);
            })
        },

        agregar_Experiencia(){
             this.formulario.id_tutor =  this.id
             //console.log(this.formulario)
             axios.post(this.url+"/ExperienciaApi/", this.formulario, // the data to post
                    { headers: {'Content-type': 'application/json','accept':'application/json'}
                }).then(response => {
                    swal("Nueva Experiencia agregada","","success");
                    this.formulario.id_experiencia= 0
                    this.formulario.id_tutor = 0
                    this.formulario.cargo = ""
                    this.formulario.tipo_empleo = null
                    this.formulario.empresa = ""
                    this.formulario.ubicacion = ""
                    this.formulario.estado = ''
                    this.formulario.fecha_inicio = ''
                    this.formulario.fecha_fin=''
                    this.listar_Experiencia()
                })
               .catch((error) => {
                   console.log(error);
               })

        },

        llenar_formulario(id){
            const path = this.url+"/ExperienciaApi/?id_experiencia="+id
            axios.get(path).then((response) => {
                    this.Editformulario.id_experiencia= response.data.id_experiencia
                    this.Editformulario.id_tutor = response.data.id_tutor
                    this.Editformulario.cargo = response.data.cargo
                    this.Editformulario.tipo_empleo = response.data.tipo_empleo
                    this.Editformulario.empresa = response.data.tipo_empleo
                    this.Editformulario.ubicacion = response.data.ubicacion
                    this.Editformulario.estado = response.data.estado
                    this.Editformulario.fecha_inicio = response.data.fecha_inicio
                    this.Editformulario.fecha_fin= response.data.fecha_fin
                    //console.log(this.Editformulario)
            })
            .catch((error)=>{
                consolose.log(error)
            })
        },

        editar_Experiencia(){
             const path = this.url+"/ExperienciaApi/"
             axios.put(path, this.Editformulario, // the data to post
                    { headers: {'Content-type': 'application/json','accept':'application/json'}
                }).then(response => {
                         //console.log(response.data);
                         swal("Cambios Guardados","","success");
                         this.listar_Experiencia()
                })
               .catch((error) => {
                   console.log(error);
               })
        },

        eliminar_experiencia(id){
            const path = this.url+"/ExperienciaApi/?id="+id
            axios.delete(path).then(response => {
                swal("Informacion eliminada","","warning");
                this.listar_Experiencia()
            })
            .catch((error) => {
                console.log(error);
            })
        }


    },
    created: function(){

        this.listar_Experiencia()
    },


}
</script>

<style>

</style>
