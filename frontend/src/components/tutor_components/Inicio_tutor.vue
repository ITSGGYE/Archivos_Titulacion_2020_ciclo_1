<template>

<div id="inicio_tutor">
        <nav class="topnav navbar navbar-expand  navbar-light  text-light bg-verde"  id="sidenavAccordion">
           <a class="navbar-brand d-none d-sm-block text-light bg-verde" >Human MindSet</a><button  class="btn btn-icon text-light order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"> <strong> <i data-feather="menu" class="text-light strong"></i> </strong> </button>
            <ul class="navbar-nav align-items-center ml-auto">
                <span class="mr-2 d-none d-lg-inline small initialism text-light strong">{{correo_usuario}}</span>
                <li class="nav-item dropdown no-caret mr-3 dropdown-user">
                    <a class="btn btn-icon  dropdown-toggle text-light" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-sign-out-alt text-light"></i></a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"></div>
                                <div class="dropdown-user-details-email"></div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-dark" @click="cerrar_sesion(tipo)">
                            <div class="dropdown-item-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                            </div>
                            Cerrar Sesión
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav  bg-verde">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <a @click="menu_option='Perfil_tutor'" class="nav-link text-light">
                                <div class="nav-link-icon"><i data-feather="book"></i></div>
                                <strong>Perfil</strong>
                                
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-right text-light"></i></div
                            ></a>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <div class="nav accordion " id="accordionSidenav">
                            <a @click="menu_option='HorariosTutor'" class="nav-link text-light">
                                <div class="nav-link-icon"><i data-feather="calendar"></i></div>
                                <strong>Horarios</strong>
                                
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-right text-light"></i></div
                            ></a>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <div class="nav accordion text-light" id="accordionSidenav">
                            <a @click="menu_option='Estudiante' " class="nav-link text-light">
                                <div class="nav-link-icon"><i data-feather="book-open"></i></div>
                                <strong>Estudiantes</strong>
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-right text-light"></i></div
                            ></a>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <div class="nav accordion text-light" id="accordionSidenav">
                            <a @click="resolver_renderizado_mapa" role="button" class="nav-link text-light" data-toggle="modal" data-target="#mostrar_modal">
                                <div class="nav-link-icon"><i data-feather="map"></i></div>
                                <strong>Ubicación</strong>
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-right text-light"></i></div
                            ></a>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <div class="nav accordion" id="accordionSidenav">
                            <a @click="menu_option = 'PagosProfesor'" class="nav-link text-light" >
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                  <strong>Pagos</strong>
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-right text-light"></i></div
                            ></a>
                        </div>
                        <div class="dropdown-divider m-0"></div>

                
                    </div>
                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <div class="sidenav-footer-subtitle text-light"><strong>Inicio de sesión como:</strong></div>
                            <div class="sidenav-footer-title text-light"> <strong>{{nombre_usuario}}</strong> </div>
                        </div>
                    </div>
                </nav>

            </div>
      
            <div id="layoutSidenav_content" >
                        <Perfil_tutor v-show="menu_option == 'Perfil_tutor'"/>
                        <HorariosTutor v-show="menu_option == 'HorariosTutor'"/>
                        <Estudiantes v-show="menu_option =='Estudiante' "/>
                        <PagosProfesor v-show="menu_option =='PagosProfesor'"/>
            </div>

            <div class="modal fade" id="mostrar_modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-verde">
                            <h5 class="modal-title text-light strong"> <strong> Ubicación </strong> </h5>
                            <button class="close text-light strong" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                                    <div class="sbp-preview">
                                             <div class="sbp-preview-header">
                                                  <h4 class="float-left px-2 py-2"> <strong> Selecciona tu ubicación actual </strong> </h4>
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
                                                     <l-tile-layer :url="url"></l-tile-layer> 
                                                     <l-marker :draggable="markerProperties.draggable" :lat-lng.sync="markerLatLng" ></l-marker>
                                                    </l-map>
                                                    <br>   
                                                    <button type="button" @click="getLocation" class="btn bg-naranja text-light float-left px-2 shadow lift strong"> <strong>Obtener ubicaciòn actual</strong> </button>
                                                    <button type="button" @click="guardar_ubicacion" class="btn bg-verde text-light float-right px-2 shadow lift strong"> <strong>Guardar ubicación</strong> </button>
                                             </div>   
                                    </div> 
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>     
</div>
</template>

<script>
import axios from "axios"
import Perfil_tutor from "./Perfil_tutor";
import HorariosTutor from "./HorariosTutor";
import Estudiantes from "./Estudiantes";
import PagosProfesor from "./PagosProfesor";


import { LMap,LTileLayer,LMarker,LIcon,LPopup } from 'vue2-leaflet';

export default{
    name: 'inicio_tutor',
    components:{Estudiantes,PagosProfesor,Perfil_tutor,HorariosTutor,LMap,LTileLayer,LMarker,LIcon,LPopup },
    
    data() {
        return {
             tipo:'',
             modal:100,
             usuario: '',
             menu_option: 'Perfil_tutor',
             usuario_info:{
                 nombre: '',
                 correo: ''
             },
             url_api: "http://173.212.250.236:8000",
             url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
             zoom: 30 ,
             center: [0,0],
             bounds: null,
             locTutor:{
                 id_persona: 0,
                 ubicacion: [0,0],
             },
             markerLatLng: [0,0],
             markerProperties: {
                position: { lng: -1.219482, lat: 47.41322 },
                visible: true,
                draggable: true,
             },
        }

    },
    methods:{

        resolver_renderizado_mapa(){
            setTimeout(() => {this.$refs.mymap.mapObject.invalidateSize();},500);
        },

        actual_localizacion(form){
            var usuario = localStorage.getItem("Usuario")
            axios.get(this.url_api+"/PersonaApiLocation/?id="+usuario).then((response) => {
                console.log(response.data)
                this.locTutor.ubicacion[0] = response.data.latitud
                this.locTutor.ubicacion[1] = response.data.longitud
                this.locTutor.id_persona = response.data.id_persona
                //console.log("datos usuario:" + this.locTutor.ubicacion)
                this.center = [this.locTutor.ubicacion[0],this.locTutor.ubicacion[1]]
                this.markerLatLng = [this.locTutor.ubicacion[0],this.locTutor.ubicacion[1]]
            })
        },
         

        ubicacion_center(){
            //console.log("Valores center: "+this.locTutor.ubicacion)
            this.center = [this.locTutor.ubicacion[0],this.locTutor.ubicacion[1]]
        },

        ubicacion_marker(){
            //console.log("Valores marker:"+this.markerLatLng)
            this.markerLatLng = [this.locTutor.ubicacion[0],this.locTutor.ubicacion[1]]
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

        cerrar_sesion(tipo){
                
               if(tipo == 'default'){
                            localStorage.removeItem('Usuario')
                            localStorage.removeItem('tipo_usuario')
                            localStorage.removeItem('Rol')
                            this.$router.push({name:'Login'})
                } 
                if(tipo == 'google'){
                    localStorage.removeItem('Usuario')
                    localStorage.removeItem('Rol')
                    localStorage.removeItem('tipo_usuario')
                    setTimeout(() => { this.$router.push({name:'Login'}) },500)
                }
                          
        },

        
        getLocation(){
            if(navigator.geolocation){
              navigator.geolocation.getCurrentPosition(position => {
              this.locTutor.ubicacion[0] = position.coords.latitude
              this.locTutor.ubicacion[1] = position.coords.longitude
              this.center = [position.coords.latitude,position.coords.longitude]
              this.markerLatLng = [position.coords.latitude,position.coords.longitude]
              console.log(this.usuario.ubicacion)
              this.ubicacion_center
              this.ubicacion_marker
            })
            }else{
                console.log("Geolocation is not supported by this browser.")
            }
        },
        guardar_ubicacion(){
             var usuario = localStorage.getItem("Usuario")
             //Guardo la posicion actual del marcador
             this.locTutor.ubicacion[0]=this.markerLatLng.lat
             this.locTutor.ubicacion[1]=this.markerLatLng.lng
             axios.put(this.url_api+"/PersonaApiLocation/?id="+usuario,this.locTutor).then((response) =>{
                 this.locTutor.ubicacion[0] = response.data.latitud
                 this.locTutor.ubicacion[1] = response.data.longitud
                 this.locTutor.id_persona = response.data.id_persona
                 this.ubicacion_center()
                 this.ubicacion_marker()
                 swal("Ubicación actualizada","","success")
             }).catch((error)=>{
                 console.log(error)
             }) 
        },


    //Funciones que se ejecutan al cargar el componente
    },
    computed:{

        nombre_usuario(){
              const usuario = localStorage.getItem("Usuario")
              const path = this.url_api+"/PerfilTutorApi/?id="+usuario
              axios.get(path).then((response) => {
              //console.log(response.data[0])
                this.usuario_info.nombre = response.data[0].id_usuario.id_persona.nombres +" "+ response.data[0].id_usuario.id_persona.apellidos
           
              })
              return  this.usuario_info.nombre
        },

        correo_usuario(){
              const usuario = localStorage.getItem("Usuario")
              const path = this.url_api+"/PerfilTutorApi/?id="+usuario
              axios.get(path).then((response) => {
              //console.log(response.data[0])
                this.usuario_info.correo = response.data[0].id_usuario.correo
           
              })
              return  this.usuario_info.correo
        },
       
     
         
    },
    created: function(){
        this.tipo = localStorage.getItem("tipo_usuario")
        setTimeout(() => {this.$refs.mymap.mapObject.invalidateSize();},500);

    },

    mounted: function(){
        this.actual_localizacion()
        this.ubicacion_marker()
        this.ubicacion_center() 
    },
    //Sirve para definir el tipo de datos que recibe de otros componentes
    props:{

    },
    beforeCreate: function(){
        document.body.className = "bg-light nav-fixed"
        let usuario = localStorage.getItem("Rol")
        console.log(localStorage.getItem("tipo_usuario"))
        //console.log(usuario)
            if(usuario === null){
                this.$router.push({name:'Login'})
            }
        
    }


}



</script>

<style media="screen">
.modal-ku {
  width: 750px;
  margin: auto;
}
</style>
