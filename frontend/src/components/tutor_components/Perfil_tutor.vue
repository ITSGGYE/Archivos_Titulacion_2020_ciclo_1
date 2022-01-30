<template>
            <div id="Perfil_tutor" class="m-2">
            <main> 
                    
                    <div class="row justify-content-center">
                        
                        <div class="col-12 px-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="page-header-content py-4 float-left">
                                        <br>
                                        <h1 class="page-header-subtitle float-left">
                                        <span>{{ usuario.nombres }} {{usuario.apellidos}}</span>&nbsp; &nbsp;&nbsp;<a @click="cargar_informacion" class="text-primary" data-toggle="modal" data-target="#exampleModalXl"  type="button"><svg class="bi bi-pencil-square" width="1.6em" height="1.6em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"/></svg></a>
                                        </h1><br>
                                        <div class="float-left page-header-subtitle h5">{{usuario.sintesis_cv}}</div>
                                    </div>
                                    <div class="float-right mx-5" id="paginacion">
                                        <span class="derecha">
                                            <div class="imagen_circular" v-bind:style="{ 'background-image': 'url(' + usuario.foto + ')' }"> 

                                            </div>
                                        </span>
                                        <br>

                                         <button class="btn bg-verde btn-user text-light" data-toggle="modal" data-target="#modalCambiarFoto">
                                                    Actualizar Foto 

                                                   <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-upload" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8zM5 4.854a.5.5 0 0 0 .707 0L8 2.56l2.293 2.293A.5.5 0 1 0 11 4.146L8.354 1.5a.5.5 0 0 0-.708 0L5 4.146a.5.5 0 0 0 0 .708z"/>
                                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 2z"/>
                                                    </svg>
                                        </button>
                                        
                                    </div>
                                </div>
                                <hr class="my-0">
                            </div>
                        </div>
                    <!-- CARD QUE MUESTA LA EXPERIENCIA DEL TUTOR -->
                            <div class="col-12 px-4 py-2">
                                <ExperienciaTutor :id="usuario.id_tutor"/>
                            </div>

                            <div class="col-12 px-4 py-2">
                                <EducacionTutor :id="usuario.id_tutor"/>
                            </div>

                             <div class="col-12 px-4 py-2">
                                <CertificacionTutor :id="usuario.id_tutor"/>
                            </div>

                            <div class="col-12 px-4 py-2">
                                <ValorPorHoraTutor :id="usuario.id_tutor"/>

                                 <div style="position: absolute; bottom: 1rem; right: 1rem;">
                            <!-- Toast -->
                            
                        </div>
                            </div>
                            
                            <div class="col-12 px-4 py-2">
                                <MateriasTutor />
                            </div>

                    </div>
                <!-- SECCION DE MODALES -->
                <cambiar_foto :usuario="usuario"/>
                
                

<!-- Toast container -->

                    <!-- MODAL PARA EDICION DE INFORMACION PERSONAL -->
                    <div class="modal fade" id="exampleModalXl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-xl" data-backdrop="static" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-verde">
                                    <h5 class="modal-title text-light">Información del usuario</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="sbp-preview">
                                                <div class="sbp-preview-content">
                                                    <form id="GuardarInformacionTutor" method="POST" @submit.prevent="GuardarInformacionTutor">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="nombres">Nombres*</label>
                                                                    <input class="form-control is-valid" id="nombres" name="nombres"  type="text" required v-model="form_usuario.nombres">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="apellidos">Apellidos*</label>
                                                                    <input class="form-control is-valid" id="apellidos" name="apellidos" type="text" required v-model="form_usuario.apellidos">
                                                                </div>
                                                            </div>

                                                            
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="identificacion">Identificación*</label>
                                                                    <input class="form-control" id="identificacion" name="identificacion" type="text" required v-model="form_usuario.identificacion">
                                                                </div>
                                                            </div>

                                                            
                                                            

                                                            
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="correo">Correo*</label>
                                                                    <input class="form-control" name="correo" id="correo" type="text" required v-model="form_usuario.correo">
                                                                </div>
                                                            </div>

                                                             <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="fecha_nacimiento">Fecha nacimiento*</label>
                                                                    <input class="form-control" required id="fecha_nacimiento" name="fecha_nacimiento" type="date" v-model="form_usuario.fecha_nacimiento">
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="ciudad">Ciudad*</label>
                                                                       <select class="form-control" v-model="form_usuario.ciudad" name="ciudad"  id="ciudad" >
                                                                       <option v-if="usuario.ciudad == 'No definido'" selected disabled>No definido</option>
                                                                       <option v-for="(c,indice) in Ciudades" :selected="c.nombre == usuario.ciudad" :value="c.nombre" :key="indice">
                                                                           {{c.nombre}}
                                                                        </option>
                                                                    </select>                                                               
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                    <div class="form-group">
                                                                    <label class="float-left" for="pais">Pais*</label>
                                                                       <select class="form-control" v-model="form_usuario.pais" name="pais" id="pais">                                                                                                                                                   <option v-if="usuario.ciudad == 'No definido'" selected disabled>No definido</option>
                                                                       <option v-if="usuario.pais == 'No definido'" selected disabled>No definido</option>
                                                                       <option v-for="(p,indice) in Paises" :selected="p.nombre == usuario.pais" :value="p.nombre" :key="indice">
                                                                           {{p.nombre}}
                                                                        </option>
                                                                       </select>
                                                                    </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="genero">Genero*</label>
                                                                    <select class="form-control" v-model="form_usuario.genero" name="genero" id="genero">
                                                                       <option v-if="usuario.genero == 'No definido'" selected disabled>No definido</option>
                                                                       <option value="M" :selected="usuario.genero=='M' ">Masculino</option>
                                                                       <option value="M" :selected="usuario.genero=='F' ">Femenino</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                                                                     
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="descripcion">descripcion*</label>
                                                                    <textarea class="form-control" id="sintesis_cv" name="sintesis_cv" type="text" required v-model="form_usuario.sintesis_cv">
                                                                    </textarea>
                                                                </div>
                                                            
                                                            </div>

                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="sbp-preview-text strong text-dark"><h5>Debes completar todos los campos para una mejor busqueda.</h5></div>
                                            </div>
                                </div>
                                <div class="modal-footer ">
                                    <button class="btn btn-danger text-light lift" type="button" data-dismiss="modal">Cerrar</button>
                                    <button class="btn bg-verde text-light lift" form="GuardarInformacionTutor" type="submit"> Guardar Cambios </button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!------------------------>

                <!------------------------>
</main>
</div>

                    
           
                
                
</template>

<script>
import axios from 'axios';
import swal from 'sweetalert';
import ExperienciaTutor from './ExperienciaTutor'
import EducacionTutor from './EducacionTutor'
import CertificacionTutor from './CertificacionTutor'
import ValorPorHoraTutor from './ValorPorHoraTutor'
import MateriasTutor from './MateriasTutor'
import cambiar_foto from '../utils_components/cambiar_foto'




export default {
    name: 'Perfil_tutor',
    components: {ExperienciaTutor,EducacionTutor,CertificacionTutor,ValorPorHoraTutor,MateriasTutor,cambiar_foto},
    data() {
        return {
                url_api: "http://173.212.250.236:8000",
                api:{
                    MEDIA: ''
                },

                form_foto:{
                    id_persona: '',
                    foto_enviar:'',
                    foto_nueva: '../../../static/images/profile_default.jpg'
                },

                //objeto que contiene la informacion personal del usuario y se muestra en pantalla 
                usuario:{
                    id_usuario : 0,
                    sintesis_cv : 'Cargando..',
                    nombres : 'Cargando..',
                    apellidos : '',
                    id_tutor : 0,
                    id_persona: 0,
                    ciudad : 'No definido',
                    foto:'',
                    pais : 'No definido',
                    identificacion : 'No definido',
                    genero : 'No definido',
                    fecha_nacimiento : '0000-00-00',
                    correo: 'No definido'
                },
                //Este objeto contiene los datos a editar en el modal para editar informacion personal del usuario
                 form_usuario:{
                    id_usuario : 0,
                    sintesis_cv : 'Cargando..',
                    nombres : 'Cargando..',
                    apellidos : '',
                    id_tutor : 0,
                    id_persona:0,
                    ciudad : 'No definido',
                    //foto:'',
                    pais : 'No definido',
                    identificacion : 'No definido',
                    genero : 'No definido',
                    fecha_nacimiento : '0000-00-00',
                    correo: 'No definido'
                },

                InformacionAcademica : [],
                Ciudades : [],
                Paises : [],
                

            }
        
    },

      methods:{

        guardar_foto_perfil(id,foto_nueva){
              const formData = new FormData()
              formData.append('id_persona',id);
              formData.append('foto',this.form_foto.foto_enviar,this.form_foto.foto_enviar.name);
              axios.post(this.url_api+'/GuardarFotoPerfil/',formData).then((r) => 
                {
                    if(r.status == 200) {
                        //console.log(r.data)
                       
                        swal("Foto Actualizada!!","Presione F5 para visualizar su nueva foto.","success");
                    }
                    
                }).catch((err)=>{
                    console.log(err);
                })
        },

        preview_imagen(e){
            var file = e.target.files[0]
            this.form_foto.foto_nueva = URL.createObjectURL(file);
            this.form_foto.foto_enviar = e.target.files[0];

        },

          mostrar_imagen(e){
              this.form_usuario.foto = this.$refs.nueva_imagen.files[0];
              console.log(this.form_usuario.foto);
              //  reader.readAsDataURL(image);
               // reader.onload = e =>{
                 //   this.form_usuario.foto = e.target.result;
                    //console.log(this.form_usuario.foto);
                //};
          },

          listar_ciudades(){
            const path = this.url_api+'/CiudadApi/'
            axios.get(path).then((response) => {
            //console.log(response.data)
                this.Ciudades = response.data
            })      
          },
          listar_Paises(){
            const path = this.url_api+'/PaisApi/'
            axios.get(path).then((response) => {
            //console.log(response.data)
                this.Paises = response.data
            })      
          },
          //Aqui se llena el formulario de edicicion con la informacion del usuario actual
          cargar_informacion(valor){
                     if(valor == 'formulario_usuario'){
                        Object.assign(this.form_usuario,this.usuario)
                     }
                     if(valor == 'usuario'){
                        Object.assign(this.usuario,this.form_usuario) 
                     }
          },

          GuardarInformacionTutor(){
              axios.post(this.url_api+'/GuardarInformacionTutor/', this.form_usuario, // the data to post
                    { headers: {'Content-type': 'application/json','accept':'application/json'}
                }).then(response => {
                    //console.log(response.data);
                    this.cargar_informacion('usuario')
                    swal("Informacion actualizada","","success");
                })
               .catch((error) => {
                   console.log(error);
               })
          },
          
      },
      created: function() {
        this.form_foto.foto_actual = this.form_usuario.foto
        this.usuario.id_usuario = localStorage.getItem("Usuario")
        this.listar_Paises()
        this.listar_ciudades()
        const usuario = localStorage.getItem("Usuario")
        //console.log("Sesion:" + usuario)
              const path = this.url_api+'/PerfilTutorApi/?id='+usuario
              axios.get(path).then((response) => {
              console.log(this.usuario.foto.name);
              this.usuario.nombres = response.data[0].id_usuario.id_persona.nombres
              this.usuario.apellidos = response.data[0].id_usuario.id_persona.apellidos
              this.usuario.foto = response.data[0].id_usuario.id_persona.foto
              this.usuario.identificacion = response.data[0].id_usuario.id_persona.identificacion
              this.usuario.genero = response.data[0].id_usuario.id_persona.genero
              if(response.data[0].id_usuario.id_persona.ciudad != null){
                  this.usuario.ciudad = response.data[0].id_usuario.id_persona.ciudad.nombre
              }
              if(response.data[0].id_usuario.id_persona.pais != null){
                  this.usuario.pais = response.data[0].id_usuario.id_persona.pais.nombre
              }
              this.usuario.id_tutor = response.data[0].id_tutor
              this.usuario.id_persona = response.data[0].id_usuario.id_persona.id_persona
              //console.log("id_persona:" + this.usuario.id_persona)
              //console.log("id_tutor:" +this.usuario.id_tutor)
              this.usuario.id_usuario = response.data[0].id_usuario.id_usuario
              if(response.data[0].id_usuario.id_persona.fecha_nacimiento != null){
                  this.usuario.fecha_nacimiento = response.data[0].id_usuario.id_persona.fecha_nacimiento
              }
              this.usuario.sintesis_cv = response.data[0].sintesis_cv
              this.usuario.correo = response.data[0].id_usuario.correo
              this.cargar_informacion('formulario_usuario')
           })
           
        },
       beforeCreate: function(){
       
    }
}
</script>

<style screen="media">
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

     #paginacion {
     }
        .derecha   { 
            right: 80%;

        }
    .imagen_circular{
        border-radius: 50%;
        width: 150px;
        height: 150px;
        background-size: cover;
    }
</style>