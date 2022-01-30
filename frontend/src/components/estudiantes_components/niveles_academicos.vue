<template>
<div id="niveles_academicos">


<div class="card">
    <div class="card-header bg-verde text-light">Niveles Academicos &nbsp;&nbsp; &nbsp; &nbsp;
        <a type="button" data-toggle="modal" data-target="#staticBackdrop"><svg class="bi bi-plus-square" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd"></path></svg></a> &nbsp;&nbsp;
    </div>
        <div class="card-body">
            <table width="100%" class="table table-hover table-bordered" cellspacing="0">
                <tbody>
                    <tr @click="llenar_formulario(c.id_niveles_academicos)"  data-toggle="modal" data-target="#editar" v-for="(c,indice) in Niveles_list" :key="indice">
                        <td><strong>- {{c.nombre}}</strong></td>
                        <td>
                            <a href="#" type="button" @click="llenar_formulario(c.id_niveles_academicos)"  data-toggle="modal" data-target="#editar">
                                <svg class="bi bi-pencil-square" width="1.6em" height="1.6em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"></path>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                          </td>
                      <td>

                              <a href="#" type="button" @click="eliminar_Niveles(c.id_niveles_academicos)">
                                <svg class="bi bi-trash-fill" width="1.6em" height="1.6em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
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
                        <h5 class="modal-title text-light" id="staticBackdropLabel">Crear nivel académico</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" @submit.prevent="agregar_Niveles">
                            <div class="modal-body">
                                 <select class="form-control text-dark select" required name="nombre" id="nombre" v-model="formulario.nombre">
                                    <option value="" selected=""></option>
                                    <option value="Educacion Basica" selected="">Educación Básica</option>
                                    <option value="Escuela Secundaria" selected="">Escuela Secundaria</option>
                                    <option value="Tecnico Avanzado" selected="">Técnico Avanzado</option>
                                    <option value="Tercer Nivel" selected="">Tercer Nivel</option>
                                    <option value="Postgrado" selected="">Postgrado</option>
                                  </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn bg-verde text-light">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


  <div class="modal fade" id="editar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-verde">
                        <h5 class="modal-title text-light" id="staticBackdropLabel">Editar nivel académico</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" @submit.prevent="editar_Niveles">
                            <div class="modal-body">

                              <select required class="form-control" name="nombre" id="nombre" v-model="Editformulario.nombre">
                                <option value="" selected=""></option>
                                <option value="Educacion Basica" selected="">Educación Básica</option>
                                <option value="Escuela Secundaria" selected="">Escuela Secundaria</option>
                                <option value="Tecnico Avanzado" selected="">Técnico Avanzado</option>
                                <option value="Tercer Nivel" selected="">Tercer Nivel</option>
                                <option value="Postgrado" selected="">Postgrado</option>
                              </select>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn bg-verde text-light">Guardar  Cambios</button>
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
    name: 'niveles_academicos',
    props: ["id"],
    data(){
        return {
            url: "http://173.212.250.236:8000",
            Niveles_list: [],
            formulario: {
                id_niveles_academicos: 0,
                id_estudiante : 0,
                nombre: "",
                id_estudiante: null


            },
            Editformulario:{
                id_niveles_academicos: 0,
                id_estudiante : 0,
                nombre: "",
                id_estudiante: null

            }
        }


    },

    methods:{
        listar_Niveles(){
            const usuario = localStorage.getItem("Usuario")
            const path = this.url+"/NivelesApi/?id="+usuario
            axios.get(path).then((response) => {
                //console.log(response.data)
                if(response.data.lenght == 0){
                    this.Niveles_list = 'Vacio'
                }else{
                    this.Niveles_list = response.data
                }

            })
            .catch((error) => {
                console.log(error);
            })
        },

        agregar_Niveles(){
             this.formulario.id_estudiante =  this.id
             //console.log(this.formulario)
             axios.post(this.url+"/NivelesApi/", this.formulario, // the data to post
                    { headers: {'Content-type': 'application/json','accept':'application/json'}
                }).then(response => {
                    swal("Nuevo Nivel Academico Agregado","","success");
                    this.formulario.id_niveles_academicos= 0
                    this.formulario.id_estudiante = 0
                    this.formulario.nombre = ""
                    this.listar_Niveles()
                })
               .catch((error) => {
                   console.log(error);
               })

        },

        llenar_formulario(id){
            const path = this.url+"/NivelesApi/?id_niveles_academicos="+id
            axios.get(path).then((response) => {
                    this.Editformulario.id_niveles_academicos= response.data.id_niveles_academicos
                    this.Editformulario.id_estudiante = response.data.id_estudiante
                    this.Editformulario.nombre = response.data.nombre
                   //console.log(this.Editformulario)
            })
            .catch((error)=>{
                consolose.log(error)
            })
        },

        editar_Niveles(){
             const path = this.url+"/NivelesApi/"
             axios.put(path, this.Editformulario, // the data to post
                    { headers: {'Content-type': 'application/json','accept':'application/json'}
                }).then(response => {
                         //console.log(response.data);
                         swal("Cambios Guardados","","success");
                         this.listar_Niveles()
                })
               .catch((error) => {
                   console.log(error);
               })
        },

        eliminar_Niveles(id){
            const path = this.url+"/NivelesApi/?id="+id
            axios.delete(path).then(response => {
                swal("Informacion eliminada","","warning");
                this.listar_Niveles()
            })
            .catch((error) => {
                console.log(error);
            })
        }


    },
    created: function(){

        this.listar_Niveles()
    },


}
</script>

<style scoped>

</style>

