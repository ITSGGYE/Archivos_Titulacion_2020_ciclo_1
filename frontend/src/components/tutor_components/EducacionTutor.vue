<template>
<div id="eduacion_tutor">
<div class="card card-scrollable">
    <div class="card-header bg-verde"> <span class="text-light"> <strong>Educación</strong>  </span>  &nbsp;&nbsp; &nbsp; &nbsp;
        <a type="button" class="text-light" data-toggle="modal" data-target="#GuardarModal"><svg class="bi bi-plus-square" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd"></path></svg></a> &nbsp;&nbsp;
    </div>
        <div class="card-body">
                                          
            <table width="100%" class="table table-hover table-bordered" cellspacing="0"> 
                <tbody>
                    <tr v-for="(c,indice) in Educacion_list" :key="indice">
                        <td>{{c.universidad}}</td>
                        <td>{{c.titulacion}}</td>
                        <td>{{c.notas}}</td>
                        <td>{{c.fecha_inicio}}</td>
                        <td>{{c.fecha_fin}}</td>
                        <td>{{c.estado}}</td>
                        <td>
                            
                            <a type="button" @click="llenar_formulario(c.id_experiencia_tutor)"  data-toggle="modal" data-target="#EditarModal">
                                <svg class="bi bi-pencil-square" width="1.6em" height="1.6em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"></path>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            
                            <a type="button" @click="Eliminar(c.id_experiencia_tutor)">
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

     <div class="modal fade" id="EditarModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg.verde">
                        <h5 class="modal-title text-light" id="staticBackdropLabel">Editar Educación Tutor</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" @submit.prevent="Editar">
                            <div class="modal-body">
                                 <div class="form-group">
                                    <label class="text-dark float-left" for="universidad">Universidad</label>
                                    <input required v-model="Editformulario.universidad" class="form-control" id="universidad" type="text">
                                </div>

                                
                                 <div class="form-group">
                                    <label for="titulacion" class="text-dark float-left">Titulación</label>
                                    <input required v-model="Editformulario.titulacion" class="form-control" id="titulacion" type="text">
                                </div>

                                <div class="form-group">
                                    <label class="text-dark float-left" for="nota">Nota</label> 
                                    <input required class="form-control" id="nota" type="text" v-model="Editformulario.nota">
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            <label class="text-dark float-left" for="fecha_inicioE">Fecha incio</label>
                                            <input required class="form-control" id="fecha_inicioE" type="date" v-model="Editformulario.fecha_inicio">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-dark float-left" for="fecha_finE">Fecha fin</label>
                                            <input required class="form-control" id="fecha_finE" type="date" v-model="Editformulario.fecha_fin">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                  <label for="tipo_empleo_estado" class="text-dark float-left">Estado</label>
                                    <select required class="form-control" name="tipo_empleo_estado" v-model="Editformulario.estado" id="tipo_empleo">
                                        <option value="Actualmente en el cargo">Actualmente en estudiando</option>
                                        <option value="Finalizado"> Finalizado </option>
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


     <div class="modal fade" id="GuardarModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-verde">
                        <h5 class="modal-title text-light" id="staticBackdropLabel">Agregar Educación</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" @submit.prevent="Guardar">
                            <div class="modal-body">
                                 <div class="form-group">
                                    <label class="text-dark float-left" for="universidad">Universidad</label>
                                    <input required v-model="formulario.universidad" class="form-control" id="universidad" type="text">
                                </div>

                                
                                 <div class="form-group">
                                    <label for="titulacion" class="text-dark float-left">Titulación</label>
                                    <input required v-model="formulario.titulacion" class="form-control" id="titulacion" type="text">
                                </div>

                                <div class="form-group">
                                    <label class="text-dark float-left" for="nota">Nota</label> 
                                    <input required class="form-control" id="nota" type="text" v-model="formulario.nota">
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            <label class="text-dark float-left" for="fecha_inicio">Fecha incio</label>
                                            <input required class="form-control" id="fecha_inicio" type="date" v-model="formulario.fecha_inicio">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-dark float-left" for="fecha_fin">Fecha fin</label>
                                            <input required class="form-control" id="fecha_fin" type="date" v-model="formulario.fecha_fin">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                  <label for="exampleFormControlInput1" class="text-dark float-left">Estado</label>
                                    <select required class="form-control" name="tipo_empleo" v-model="formulario.estado" id="tipo_empleo">
                                        <option value="Actualmente en el cargo">Actualmente en estudiando</option>
                                        <option value="Finalizado"> Finalizado </option>
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

</div>
</template>

<script>
import axios from 'axios';
import swal from 'sweetalert';
export default {
    name: 'educacion_tutor',
    props:["id"],
    data(){
        return{
            url: "http://173.212.250.236:8000",
            Educacion_list: [],
            formulario: {
                id_experiencia_tutor: 0,
                id_tutor : 0,
                universidad: "",
                titulacion: null,
                nota: "",
                estado: '',
                fecha_inicio:'',
                fecha_fin:''

            },

            Editformulario:{
                id_experiencia_tutor: 0,
                id_tutor : 0,
                universidad: "",
                titulacion: null,
                nota: "",
                estado: '',
                fecha_inicio:'',
                fecha_fin:''
            }

        }
    },
    methods:{

         llenar_formulario(id){
            const path = this.url+"/Educacion_tutorApi/?id_experiencia_tutor="+id
            axios.get(path).then((response) => {
                    this.Editformulario.id_experiencia_tutor= response.data.id_experiencia_tutor
                    this.Editformulario.id_tutor = response.data.id_tutor
                    this.Editformulario.universidad = response.data.universidad
                    this.Editformulario.titulacion = response.data.titulacion
                    this.Editformulario.nota = response.data.nota
                    this.Editformulario.estado = response.data.estado
                    this.Editformulario.fecha_inicio = response.data.fecha_inicio
                    this.Editformulario.fecha_fin= response.data.fecha_fin
                    //console.log(this.Editformulario)
            })
            .catch((error)=>{
                consolose.log(error)
            })
        },

        Listar(){
            const usuario = localStorage.getItem("Usuario")
            const path = this.url+"/Educacion_tutorApi/?id="+usuario
            axios.get(path).then((response) => {
                //console.log(response.data)
                if(response.data.lenght == 0){
                    this.Educacion_list = 'Vacio'    
                }else{
                    //console.log("Sin problema")
                    this.Educacion_list = response.data
                }
                
            })
            .catch((error) => {
                console.log(error);
            })
        },
        Guardar(){
             this.formulario.id_tutor =  this.id
             //console.log(this.formulario)
             axios.post(this.url+"/Educacion_tutorApi/", this.formulario, // the data to post
                    { headers: {'Content-type': 'application/json','accept':'application/json'}
                }).then(response => {
                    //console.log( this.formulario)
                    swal("Nueva Experiencia agregada","","success");
                    this.formulario.id_experiencia_tutor= 0
                    this.formulario.id_tutor = 0
                    this.formulario.universidad = ""
                    this.formulario.titulacion = ""
                    this.formulario.nota = ""
                    this.formulario.estado = ""
                    this.formulario.fecha_inicio = ""
                    this.formulario.fecha_fin= ""
                    this.Listar()  
                })
               .catch((error) => {
                   console.log(error);
               })
    
        },

        Editar(){
             const path = this.url+"/Educacion_tutorApi/"
             axios.put(path, this.Editformulario, // the data to post
                    { headers: {'Content-type': 'application/json','accept':'application/json'}
                }).then(response => {
                         //console.log(response.data);
                         swal("Cambios Guardados","","success");
                         this.Listar()
                })
               .catch((error) => {
                   console.log(error);
               })
        },

        Eliminar(id){
            const path = this.url+"/Educacion_tutorApi/?id="+id
            axios.delete(path).then(response => {
                swal("Informacion eliminada","","warning");
                this.Listar()
            })
            .catch((error) => {
                console.log(error);
            })
        }
        
    },
    created: function(){
        this.Listar()
    },
    
}
</script>

<style>

</style>