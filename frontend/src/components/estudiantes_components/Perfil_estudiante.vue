<template>
<div id="Perfil_estudiante" style="width:100%; height:100%;">   
                        <div class="row justify-content-center py-2">
                        <div class="col-12 px-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="" id="paginacion">
                                            <div class="page-header-content float-left">
                                                <h1 class="page-header-title mb-10">
                                                    <span>{{ usuario.nombres }} {{usuario.apellidos}}</span>
                                                        <a @click="cargar_informacion('formulario_usuario')" class="text-primary" data-toggle="modal" data-target="#exampleModalXl"  type="button"><svg class="bi bi-pencil-square" width="1.6em" height="1.6em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"/></svg></a>
                                                    <br><span class="float-left">{{usuario.correo}}</span>
                                                </h1>
                                            </div>
                                            <div class="float-right" id="paginacion">
                                                <span>
                                                    <div class="imagen_circular" v-bind:style="{ 'background-image': 'url('+ usuario.foto + ')' }"> </div>
                                                </span>
                                                <br>
                                                <button class="btn bg-verde btn-user text-light" data-toggle="modal" data-target="#modalCambiarFoto">
                                                    Actualizar Foto 
                                                    &nbsp;
                                                   <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-upload" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8zM5 4.854a.5.5 0 0 0 .707 0L8 2.56l2.293 2.293A.5.5 0 1 0 11 4.146L8.354 1.5a.5.5 0 0 0-.708 0L5 4.146a.5.5 0 0 0 0 .708z"/>
                                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 2z"/>
                                                    </svg>

                                                </button>
                                            </div>
                                        </div>
                                </div>
                                <hr class="my-0">
                            </div>
                        </div>
                    <!-- CARD QUE MUESTA LA EXPERIENCIA DEL TUTOR -->

                          <div class="col-12 px-4 py-2">
                                <niveles_academicos :id="usuario.id_estudiante"/>
                          </div>

                          <div class="col-12 px-4 py-2">
                                <interes :id="usuario.id_estudiante"/>
                          </div>

                          

                    </div>

                <!-- SECCION DE MODALES -->
                    <!-- MODAL PARA EDICION DE INFORMACION PERSONAL -->

                    <cambiar_foto :usuario="usuario" />
           
                    <div class="modal fade" id="exampleModalXl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-xl" data-backdrop="static" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">!Informacion Del Estudiante!</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" @submit.prevent="GuardarInformacionEstudiante" id="informacionEstudiante">
                                    <div class="sbp-preview">
                                                <div class="sbp-preview-content">
                                                     
                                                  <h1>Estudiante</h1>
                                                  <br>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="nombres">Nombres*</label>
                                                                    <input class="form-control" id="nombres" type="text" required v-model="form_usuario.nombres">
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="apellidos">Apellidos*</label>
                                                                    <input class="form-control" id="apellidos" type="text" required v-model="form_usuario.apellidos">
                                                                </div>
                                                            </div>


                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="identificacion">Identificación*</label>
                                                                    <input class="form-control" id="identificacion" type="text" required v-model="form_usuario.identificacion">
                                                                </div>
                                                            </div>



                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="correo">Correo*</label>
                                                                    <input class="form-control" id="correo" name="correo" type="text" required v-model="form_usuario.correo">
                                                                </div>
                                                            </div>

                                                             <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="fecha_nacimiento">Fecha nacimiento*</label>
                                                                    <input class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required type="date" v-model="form_usuario.fecha_nacimiento">
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="ciudad">Ciudad*</label>
                                                                       <select class="form-control" required v-model="form_usuario.ciudad" name="ciudad" id="ciudad" >
                                                                       <option v-if="usuario.ciudad == 'No definido'" selected disabled>No definido</option>
                                                                       <option v-for="(c,indice) in Ciudades" :selected="c.nombre == usuario.ciudad"  :value="c.nombre" :key="indice">
                                                                           {{c.nombre}}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                    <div class="form-group">
                                                                    <label class="float-left" for="pais">Pais*</label>
                                                                       <select class="form-control" required v-model="form_usuario.pais" name="pais" id="pais">                                                                                                                                                   <option v-if="usuario.ciudad == 'No definido'" selected disabled>No definido</option>
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
                                                                    <select class="form-control" required v-model="form_usuario.genero" name="genero" id="genero">
                                                                       <option v-if="usuario.genero == 'No definido'" selected disabled>No definido</option>
                                                                       <option value="M" :selected="usuario.genero=='M' ">Masculino</option>
                                                                       <option value="M" :selected="usuario.genero=='F' ">Femenino</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                          
                                                        </div>
                                                </div>
                                    </div>
<!-- representante -->
                                    <br>
                                  <div class="sbp-preview">
                                    <div class="sbp-preview-content">
                                      <h1>Representante</h1>
                                      <div class="text-center small text-muted mb-4">...LLenar esta información si es menor de 18 años.</div>
                                      <br>
                                                  <div class="row">
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="nombresr">Nombres*</label>
                                                                    <input class="form-control" id="nombresr" type="text"  v-model="form_usuario.nombresr">
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="apellidosr">Apellidos*</label>
                                                                    <input class="form-control" id="apellidosr" type="text"  v-model="form_usuario.apellidosr">
                                                                </div>
                                                            </div>


                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="identificacionr">Identificación*</label>
                                                                    <input class="form-control" id="identificacionr" type="text"  v-model="form_usuario.identificacionr">
                                                                </div>
                                                            </div>

                                                            


                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="correor">Correo*</label>
                                                                    <input class="form-control" id="correor" type="text"  v-model="form_usuario.correor">
                                                                </div>
                                                            </div>

                                                             <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="fecha_nacimientor">Fecha nacimiento*</label>
                                                                    <input class="form-control" id="fecha_nacimientor" type="date" v-model="form_usuario.fecha_nacimientor">
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="ciudadr">Ciudad*</label>
                                                                       <select class="form-control"  v-model="form_usuario.ciudadr" name="ciudadr" id="ciudadr" >
                                                                       <option v-if="form_usuario.ciudadr == 'No definido'" selected disabled>No definido</option>
                                                                       <option v-for="(c,indice) in Ciudades" :selected="c.nombre == form_usuario.ciudadr" :value="c.nombre" :key="indice">
                                                                           {{c.nombre}}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                    <div class="form-group">
                                                                    <label class="float-left" for="paisesr">Pais*</label>
                                                                       <select class="form-control"  v-model="form_usuario.paisr" name="paisesr" id="paisesr">                                                                                                                                                   <option v-if="usuario.ciudad == 'No definido'" selected disabled>No definido</option>
                                                                       <option v-if="form_usuario.paisr == 'No definido'" selected disabled>No definido</option>
                                                                       <option v-for="(p,indice) in Paises" :selected="p.nombre == form_usuario.paisr" :value="p.nombre" :key="indice">
                                                                           {{p.nombre}}
                                                                        </option>
                                                                       </select>
                                                                    </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label class="float-left" for="generor">Genero*</label>
                                                                    <select class="form-control"  v-model="form_usuario.generor" name="generor" id="generor">
                                                                       <option v-if="usuario.generor == 'No definido'" selected disabled>No definido</option>
                                                                       <option value="M" :selected="usuario.generor=='M' ">Masculino</option>
                                                                       <option value="F" :selected="usuario.generor=='F' ">Femenino</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            
                                                  </div>
                                    </div>
                                  </div>
                                        <br>
                                        <div class="sbp-preview">
                                                <div class="sbp-preview-content">
                                                  <h4>Tutoría</h4>
                                                  <br>
                                                     <div class="d-flex justify-content-center">
                                                          <div class="custom-control custom-checkbox d-flex px-4">
                                                               <input class="custom-control-input" id="customRadio1" :checked="form_usuario.tutoria_online == true" type="checkbox" v-model="form_usuario.tutoria_online" name="customRadio">
                                                               <label class="custom-control-label" for="customRadio1">En linea</label>
                                                           </div>
                                                           <div class="custom-control custom-checkbox d-flex">
                                                             <input class="custom-control-input" id="customRadio2" :checked="form_usuario.tutoria_prescencial == true" type="checkbox" name="customRadio" v-model="form_usuario.tutoria_prescencial">
                                                             <label class="custom-control-label" for="customRadio2">Presencial</label>
                                                           </div>
                                                     </div>
                                                </div>
                                        </div>
                                  <br>
                                         <div class="sbp-preview">
                                             <div class="sbp-preview-header">
                                                  <h1>Ubicación</h1>
                                                  <div class="text-center small text-muted mb-2">Selecciona tu ubicaciòn actual</div>
                                             </div>   
                                             <div class="sbp-preview-content justify-content-center">
                                             <l-map
                                                 style="height: 300px; width: 100%"
                                                 :zoom="zoom"
                                                 ref="mymap"
                                                 :center.sync="center"
                                                 @update:zoom="zoomUpdated" 
                                                 @update:center="centerUpdated"
                                                 @update:bounds="boundsUpdated">
                                                 <l-tile-layer :attribution="attribution" :url="url"></l-tile-layer> 
                                                 <l-marker :draggable="true" @dragend="assign_cords"  :lat-lng.sync="markerLatLng" ></l-marker>
                                            </l-map>
                                            <br>   
                                            <button @click="getLocation" type="button" class="btn bg-naranja text-light float-left px-2 shadow lift">Obtener ubicaciòn actual</button>
                                            </div>
                                            
                                        </div>
                                    </form>    
                                </div>
                                <div class="modal-footer">
                                    <button class="btn bg-verde text-light strong" form="informacionEstudiante"  type="submit"> Guardar Cambios </button>
                                    <button class="btn btn-primary" type="button" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                    <!------------------------>
                <!------------------------>

</div>
</template>

<script>
import axios from 'axios';
import { LMap,LTileLayer,LMarker,LIcon,LPopup } from 'vue2-leaflet';
import swal from 'sweetalert';
import HelloWorld from '../HelloWorld'
import interes from './interes'
import niveles_academicos from "./niveles_academicos";
import cambiar_foto from '../utils_components/cambiar_foto';
export default {
    name: 'Perfil_estudiante',
    components: { niveles_academicos,interes,LMap,LTileLayer,LMarker,LIcon,LPopup,cambiar_foto},

    data() {
        return {

                //objeto que contiene la informacion personal del usuario y se muestra en pantalla
                attribution:'&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                center: [0,0],
                markerLatLng: [0,0],
                mapa:false,
                url_api:"http://173.212.250.236:8000",
                url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                zoom: 30 ,
                bounds: null,
                bloquear_boton : true,
                //Este objeto guarda la info del estudiuante y su representante
                usuario:{
                    //info persona
                    nombres : 'Cargando..',
                    apellidos : '',
                    id_estudiante : 0,
                    id_persona: 0,
                    foto: '',
                    ciudad : 'No definido',
                    pais : 'No definido',
                    identificacion : 'No definido',
                    genero : 'No definido',
                    fecha_nacimiento : '0000-00-00',
                    ubicacion: [0,0],
                    //info usuario
                    id_usuario : 0,
                    correo: 'No definido',
                    //info estudiante
                    tutoria_online: false,
                    tutoria_prescencial: false,
                    //Info representante
                    id_representante: 0,
                    nombresr: 'no definido',
                    apellidosr:'no definido',
                    correor: 'no definido',
                    genero:'no definido',
                    identificacionr:'no definido',
                    fecha_nacimientor : '0000-00-00',
                    ciudadr : 'No definido',
                    paisr: 'No definido',

                },

                form_foto:{
                    id_persona: '',
                    foto_enviar:'',
                    foto_nueva: '../../static/images/profile_default.jpg'
                },
                //Este objeto contiene los datos a editar en el modal para editar informacion personal del usuario
                 form_usuario:{
                    //info persona
                    nombres : 'Cargando..',
                    apellidos : '',
                    foto: '',
                    id_estudiante : 0,
                    id_persona: 0,
                    ciudad : 'No definido',
                    pais : 'No definido',
                    identificacion : 'No definido',
                    genero : 'No definido',
                    fecha_nacimiento : '0000-00-00',
                    ubicacion: [0,0],
                    //info usuario
                    id_usuario : 0,
                    correo: 'No definido',
                    //info estudiante
                    tutoria_online: false,
                    tutoria_prescencial: false,
                    //Info representante
                    id_representante: 0,
                    nombresr: 'no definido',
                    apellidosr:'no definido',
                    correor: 'no definido',
                    generor:'no definido',
                    identificacionr:'no definido',
                    fecha_nacimientor : '0000-00-00',
                    ciudadr : 'No definido',
                    paisr: 'No definido',
                  
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
                        console.log(r.data)
                       
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

        
        assign_cords(){
            this.form_usuario.ubicacion[0] = this.markerLatLng.lat
            this.form_usuario.ubicacion[1] = this.markerLatLng.lng
            this.center[0] =  this.markerLatLng.lat
            this.center[1] =  this.markerLatLng.lng
            //console.log(this.form_usuario.ubicacion)
        },
        zoomUpdated (zoom) {
            this.zoom = zoom;
        },
        centerUpdated (center) {
            this.center = center;
        },
        boundsUpdated (bounds) {
            this.bounds = bounds;
        },

          listar_ciudades(){
            const path = this.url_api+"/CiudadApi/"
            axios.get(path).then((response) => {
            //console.log(response.data)
                this.Ciudades = response.data
            })
          },
          listar_Paises(){
            const path = this.url_api+"/PaisApi/"
            axios.get(path).then((response) => {
            //console.log(response.data)
                this.Paises = response.data
            })
          },
          //Aqui se llena el formulario de edicicion con la informacion del usuario actual
          cargar_informacion(valor){
            setTimeout(() => {this.$refs.mymap.mapObject.invalidateSize();},500);   
            if(valor == 'formulario_usuario'){
               Object.assign(this.form_usuario,this.usuario)
               //console.log(this.form_usuario)
            }
            if(valor == 'usuario'){
               Object.assign(this.usuario,this.form_usuario)
            }
          },

          GuardarInformacionEstudiante(){
              axios.post(this.url_api+'/GuardarInformacionEstudiante/', this.form_usuario, // the data to post
                    { headers: {'Content-type': 'application/json','accept':'application/json'}
                }).then(response => {
                    //console.log(response.data);
                     this.cargar_informacion('usuario')
                     this.center = [this.usuario.ubicacion[0],this.usuario.ubicacion[1]]
                     swal("Informacion actualizada","","success");
                })
               .catch((error) => {
                   console.log(error);
               })
          },

          getLocation(){
            if(navigator.geolocation){
              navigator.geolocation.getCurrentPosition(position => {
              this.usuario.ubicacion[0] = position.coords.latitude
              this.usuario.ubicacion[1] = position.coords.longitude
              this.center = [position.coords.latitude,position.coords.longitude]
              this.markerLatLng = [position.coords.latitude,position.coords.longitude]
              //console.log(this.usuario.ubicacion)
              this.ubicacion_center
              this.ubicacion_marker
            })
            }else{
                console.log("Geolocation is not supported by this browser.")
            }
        },
        ubicacion_center(){
            this.center = [this.usuario.ubicacion[0],this.usuario.ubicacion[1]]
            //console.log("Valores center: "+this.center)
        },

        ubicacion_marker(){
            this.markerLatLng = [this.usuario.ubicacion[0],this.usuario.ubicacion[1]]
            //console.log("Valores marker:"+this.markerLatLng)
        },
        
        InformaCionEstudiante(){
            this.usuario.id_usuario = localStorage.getItem("Usuario")
            this.listar_Paises()
            this.listar_ciudades()
            const usuario = localStorage.getItem("Usuario")
            const path = this.url_api+"/EstudianteApi/?id="+usuario
            axios.get(path).then((response) => {
            //console.log(response.data[0])
            //llenamos la info de persone-estudiante
            this.usuario.id_persona = response.data[0].id_usuario.id_persona.id_persona
            this.usuario.nombres = response.data[0].id_usuario.id_persona.nombres
            this.usuario.apellidos = response.data[0].id_usuario.id_persona.apellidos
            this.usuario.foto = response.data[0].id_usuario.id_persona.foto
            console.log(this.usuario.foto);
            this.usuario.identificacion = response.data[0].id_usuario.id_persona.identificacion
            this.usuario.genero = response.data[0].id_usuario.id_persona.genero
            if(response.data[0].id_usuario.id_persona.fecha_nacimiento != null){
                this.usuario.fecha_nacimiento = response.data[0].id_usuario.id_persona.fecha_nacimiento
            }
            if(response.data[0].id_usuario.id_persona.ciudad != null){
                this.usuario.ciudad = response.data[0].id_usuario.id_persona.ciudad.nombre
            }
            if(response.data[0].id_usuario.id_persona.pais != null){
                this.usuario.pais = response.data[0].id_usuario.id_persona.pais.nombre
            }
            //Llenamos la informacion como estudiante
            this.usuario.id_estudiante = response.data[0].id_estudiante
            this.usuario.tutoria_online = response.data[0].tutoria_online
            this.usuario.tutoria_prescencial = response.data[0].tutoria_prescencial

           //Llenamos la informacion como usuario
            this.usuario.id_usuario = localStorage.getItem("Usuario")
            this.usuario.correo = response.data[0].id_usuario.correo

            //Llenamos la informacion del representante
            this.usuario.id_representante = response.data[0].id_representante.id_representante
            this.usuario.nombresr = response.data[0].id_representante.nombresr
            this.usuario.apellidosr = response.data[0].id_representante.apellidosr
            this.usuario.correor = response.data[0].id_representante.correor
            this.usuario.ciudadr = response.data[0].id_representante.ciudadr.nombre
            this.usuario.generor = response.data[0].id_representante.generor
            this.usuario.paisr = response.data[0].id_representante.paisr.nombre
            this.usuario.identificacionr = response.data[0].id_representante.identificacionr
            this.usuario.fecha_nacimientor = response.data[0].id_representante.fecha_nacimientor

            
            this.cargar_informacion("formulario_usuario")
           })
        },

        actual_localizacion(form){
            var usuario = localStorage.getItem("Usuario")
            axios.get(this.url_api+"/PersonaApiLocation/?id="+usuario).then((response) => {
                //console.log(response.data)
                this.usuario.ubicacion[0] = response.data.latitud
                this.usuario.ubicacion[1] = response.data.longitud
                
                //console.log("datos usuario:" + this.locTutor.ubicacion)
                this.center = [this.usuario.ubicacion[0],this.usuario.ubicacion[1]]
                this.markerLatLng = [this.usuario.ubicacion[0],this.usuario.ubicacion[1]]
            })
        },



      },

    created: function(){
        this.InformaCionEstudiante()
        this.cargar_informacion("formulario_usuario")
        this.form_foto.foto_actual = this.form_usuario.foto
     },
    beforeCreate: function(){
    
    },
    mounted: function(){
         this.actual_localizacion()
         this.ubicacion_marker()
         this.ubicacion_center()     
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


    .imagen_circular{
        border-radius: 50%;
        width: 150px;
        height: 150px;
        background-size: cover;
    }
</style>
