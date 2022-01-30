<template>
  <div id="inicio_estudiante">
        <nav class="topnav navbar navbar-expand shadow navbar-light bg-verde text-light" id="sidenavAccordion">
          <a class="navbar-brand d-none d-sm-block text-light" @click="perfil">Human MindSet</a><button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i data-feather="menu"></i></button>
           <ul class="navbar-nav align-items-center ml-auto">
              <span class="mr-2 d-none d-lg-inline small initialism">Estudiante</span>
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
                <nav class="sidenav shadow-right  bg-verde">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <a @click="mostrar = 'Perfil_estudiante' " class="nav-link text-light" href="#">
                                <div class="nav-link-icon"  ><i data-feather="book"></i></div>
                                Mi Perfil
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-right text-light"></i></div
                            ></a>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <div class="nav accordion " id="accordionSidenav">
                            <a  @click="mostrar = 'buscar_tutor'" class="nav-link text-light" href="#">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Buscar Tutor
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-right text-light"></i></div
                            ></a>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <div class="nav accordion text-light" id="accordionSidenav">
                            <a @click="mostrar='MisTutores' " class="nav-link text-light" href="#">
                                <div class="nav-link-icon"><i data-feather="book-open"></i></div>
                                Mis Tutores
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-right text-light"></i></div
                            ></a>
                        </div>
                        <!--
                        <div class="dropdown-divider m-0"></div>
                        <div class="nav accordion text-light" id="accordionSidenav">
                            <a class="nav-link text-light" href="#">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Mi Ubicación
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-right text-light"></i></div
                            ></a>
                        </div>
                        -->
                        <div class="dropdown-divider m-0"></div>
                        <div class="nav accordion" id="accordionSidenav">
                            <a @click="mostrar = 'pagos_estudiante'" class="nav-link text-light" href="#">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                  Pagos
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-right text-light"></i></div
                            ></a>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <!--
                        <div class="nav accordion" id="accordionSidenav">
                            <a @click="cerrar_sesion(tipo)" href="#" class="nav-link text-light">
                                <div class="nav-link-icon"><i data-feather="book"></i></div>
                                Cerrar Sesión
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-right text-light"></i></div
                            ></a>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        -->
                    </div>
                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <div class="sidenav-footer-subtitle text-light">Inicio de sesión como:</div>
                            <div class="sidenav-footer-title text-light">Valerie Luna</div>
                        </div>
                    </div>
                </nav>
            </div>
          <div id="layoutSidenav_content">
                 <Perfil_estudiante v-show="mostrar == 'Perfil_estudiante'" :mostrar="mostrar" @mostrar="mostrar" />
                 <buscar_tutor v-show="mostrar == 'buscar_tutor'" :mostrar="mostrar" @mostrar="mostrar"/>
                 <pagos_estudiante v-if="mostrar == 'pagos_estudiante'" :mostrar="mostrar" @mostrar="mostrar"/>
                 <MisTutores v-if="mostrar == 'MisTutores'"  />
          </div>

        </div>

</div>

</template>

<script>
import Perfil_estudiante from "./Perfil_estudiante";
import buscar_tutor from "./buscar_tutor";
import pagos_estudiante from "./pagos_estudiante";
import MisTutores from "./MisTutores";
import Inicio_tutorVue from '../tutor_components/Inicio_tutor.vue';

export default{
    name: 'inicio_estudiante',
    components:{ Perfil_estudiante,buscar_tutor,pagos_estudiante,MisTutores },

    data() {
        return {
          tipo: '',
          mostrar: 'Perfil_estudiante',
          usuario: '',
        }

    },
    methods:{
       perfil(){
          this.$router.push({ name: 'inicio_estudiante' })
      },
       buscar(){
          this.$router.push({ name: 'buscar_tutor' })
      },
        cerrar_sesion(tipo){

                            //localStorage.removeItem('Usuario')
                            //localStorage.removeItem('tipo_usuario')
                            //localStorage.removeItem('Rol')
                            //this.$router.push({name:'Login'})
                
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
                    setTimeout(() => { this.$router.push({name:'Login'}) },1000);
                    
                    /*var auth2 = gapi.auth2.getAuthInstance()
                    auth2.disconnect();
                    auth2.signOut().then(function () {
                        localStorage.removeItem('Usuario')
                        localStorage.removeItem('Rol')
                        localStorage.removeItem('tipo_usuario')
                        gapi.auth2.getAuthInstance().currentUser.get().reloadAuthResponse()}).catch((error) => {console.log(error)});
                        
                    */
                }
                          
        },

    //Funciones que se ejecutan al cargar el componente
    },
    computed:{},
    created: function(){
        //localStorage.setItem("tipo_usuario","google")
        this.tipo = localStorage.getItem("tipo_usuario")
        console.log(this.tipo)
    },
    //Sirve para definir el tipo de datos que recibe de otros componentes
    props:{

    },
    beforeCreate: function(){
        document.body.className = "bg-light nav-fixed"
        let usuario = localStorage.getItem("Rol")
        //console.log(usuario)
            if(usuario === null){
                this.$router.push({name:'Login'})
            }
    }


}



</script>

<style media="screen">

</style>

