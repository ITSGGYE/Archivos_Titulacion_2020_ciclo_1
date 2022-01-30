
<template>
<div id="CreateUserEstuadiante" >
    <div class="row justify-content-center ">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-11 ">
            <div class="card shadow my-5">
                 <div class="card-header p-4 justify-content-center">
                    <center>
                        <img class="text-center" src="../../assets/logo_horizontal_human.png">
                    </center>
                 </div>
                 
                 <div class="card-body p-1" v-if="formulario_mostrar=='primera_parte'">
                     <form method="POST" @submit.prevent="formulario_mostrar='segunda_parte'" class="block">
                            <div class="row px-5">
                                 <div class="col-12 justify-content-center py-3">
                                     <div class="form-group">
                                        <label class="text-600  h3 strong" for="id_username"> Crear usuario <span style="color:#3E9F35;"> <strong>Profesor</strong> </span></label>
                                     </div>
                                 </div>
                                 <br>

                                 <div class="col-6 py-2">
                                    <div class="form-group">
                                         <label for="nombres" class="float-left"> <strong> Nombres* </strong> </label>
                                         <input class="form-control" id="nombres" type="text" placeholder="Ingrese su nombre" v-model="formulario.nombres" required autocomplete="off">
                                    </div>
                                 </div>

                                 <div class="col-6 py-2">
                                      <div class="form-group">
                                           <label for="apellidos" class="float-left"> <strong> Apellidos* </strong> </label>
                                           <input class="form-control" id="apellidos" name="apellidos" v-model="formulario.apellidos" type="text" required placeholder="Ingrese su apellido" autocomplete="off">
                                      </div>
                                 </div>

                                 <div class="col-12">
                                      <div class="form-group">
                                           <label for="correo" class="float-left"> <strong> Correo Electrónico* </strong> </label>
                                           <input class="form-control" @change="get_Correo" required="required" id="correo" name="correo" v-model="formulario.correo" :class="[validaEmail]" type="email" placeholder="example@gmail.com" autocomplete="off">
                                      </div>
                                 </div>

                                 <div class="col-6">
                                    <div class="form-group">
                                    </div>
                                    <div class="form-group">
                                                                 <label for="contra" class="float-left"> <strong> Contraseña* </strong> </label>
                                                                 <input class="form-control" id="contra" :class="[validaContra]" @keyup="validaPassword" name="contra" type="password" required="required" v-model="formulario.clave" placeholder="Contraseña" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                         <label for="contra" class="float-left"> <strong> Repite la Contraseña* </strong> </label>
                                         <input  id="contra" v-model="contra_validar" @keyup="confirPassword" :class="[cnf_contra]" class="form-control" required="required"  name="contra" type="password" placeholder="Confirmar contraseña" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="col-6">
                                    <div class="form-group justify-content-center py-5">
                                      <span class="text-dark-400 ">
                                             Recuerde que su contraseña debe contener al menos los siguientes parámetros:
                                      </span>
                                     <br>
                                     <br>
                                     <span class="text-dark-400 justify-content-center">
                                             <li>Minimo 8 caracteres</li>
                                             <li>Debe contener letras y numeros</li>
                                     </span>
                                     <span class="text-dark-400 justify-content-center">
                                             <li>Debe contener letras y numeros</li>
                                     </span>
                                     <span class="justify-content-center">
                                         <div v-html="mensaje" v-if="mostrar"></div>
                                     </span>
                                    <div style="position: absolute; bottom: 1rem; right: 1rem;"></div>
                                    </div>
                                 </div>
                            </div>
                            <br><br>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="submit" class="btn btn-success btn-block lift" > <strong> Continuar </strong>  </button>
                                </div>
                            </div>
                            <hr class="my-2">
                            <!--
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <div id="google-signin-btn"></div>
                                </div>
                            </div>
                            -->
                    </form>       
                    
                </div>

                <div class="card-body p-1" v-if="formulario_mostrar=='segunda_parte'">
                    <form method="POST" @submit.prevent="generar_codigo" class="block">
                        <div class="row px-5">
                                <div class="col-md-12 py-3">
                                    <span class="strong h3">Selecciona tu area de especialidad</span>
                                </div>

                                <div class="col-md-4">
                                    <fieldset>
                                        <legend class="col-md-7"> Matemáticas </legend>
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <label class="form-group" v-for="(m,indice) in buscar_tipo('matematica')" :key="indice">
                                                        <input v-model="formulario.materias_afines" type="checkbox" :name="m.nombre" :value="m.id_materias_afines" class="checkboxinput" />
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
                                                        <input v-model="formulario.materias_afines" type="checkbox"  :name="m.nombre" :value="m.id_materias_afines" class="checkboxinput" />
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
                                                        <input v-model="formulario.materias_afines" type="checkbox"  :name="m.nombre" :value="m.id_materias_afines" class="checkboxinput" />
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
                                                        <input v-model="formulario.materias_afines" type="checkbox"  :name="m.nombre" :value="m.id_materias_afines" class="checkboxinput" />
                                                        {{m.nombre}} &nbsp;&nbsp; &nbsp; &nbsp;
                                                    </label>
                                                </div>
                                            </div>
                                    </fieldset>

                                </div>

                                <br><br>
                     
                        </div>   
                        <div class="row justify-content-center p-3">
                            <div class="col-5">
                               <button type="button" v-on:click="formulario_mostrar='primera_parte'"  class="btn btn-block btn-danger lift text-light" > <strong>  Volver </strong>  </button>
                            </div>
                            <div class="col-5">
                                <button type="submit"  class="btn btn-success btn-block text-light strong lift" > 
                                    Guardar
                                </button>
                            </div>
                        </div>    
                    </form>
                </div>        

                <div class="card-body p-1" v-if="formulario_mostrar=='tercera_parte'">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <h4 class="strong">Para finalizar la creacion de su cuenta, ingrese el codigo de verificacion enviado a su correo electronico <strong>{{formulario.correo}}</strong>.</h4>
                        </div>
                        <div class="col-7">
                            <div class="form-group">
                                <input type="text" v-model="codigo" class="form-control m-2" placeholder="Ingrese el codigo." />
                            </div>
                        </div>
                        <div class="col-7">
                            <button @click="guardar_usuario" class="bg-verde lift btn btn-block text-light">Confirmar</button>
                            <button @click="formulario_mostrar='segunda_parte'" class="bg-naranja lift btn btn-block text-light">Cancelar</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>






</template>

<script>
import Login from './Login.vue';
import axios from 'axios';
import swal from 'sweetalert';

export default {
    name: 'CreateUserEstuadiante',
    components: {
        Login,
    },
    data(){
        return{
            url: "http://173.212.250.236:8000",
            mostrar: false,
            formulario_mostrar:'primera_parte',
            cod_res: '',
            codigo:'',
            formulario: {
                tipo:'codigo_verificacion',
                nombres: '',
                apellidos: '',
                identificacion: '',
                tipo_sesion: 'default',
                correo: '',
                clave: '',
                rol_nombre : 'Profesor',
                genero : 'M',
                latitud: 0,
                longitud: 0,
                materias_afines: []
            },
            validar_credenciales: {
                validar_ident: false,
                validar_contra: false,
                validar_correo:false
            },

            lista_materias: [],
            lista_display:[],
            contra_validar: '',
            cb_tu : 'Profesor',
            error_identificacion : '',
            validaEmail:'',
            validaContra:'',
            cnf_contra : '',
            mensaje : `<div class="alert alert-danger alert-icon" role="alert">
                               <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                  </button>
                                <div class="alert-icon-aside">
                                    <i data-feather="feather"></i>
                                </div>
                                <div class="alert-icon-content">
                                    <h6 class="alert-heading"> Error al guardar el usuario </h6>
                                    <ul>
                                        <li> Correo ya en uso </li>
                                        <li> Identificacion no valida </li>
                                        <li> Contraseña no valida </li>
                                    </ul>
                                </div>
                            </div>`
        }
    },
    methods:{

generar_codigo(){
    if(this.validar_credenciales.validar_correo && this.validar_credenciales.validar_contra ){
      axios.post(this.url+'/Correos_electronicos/',this.formulario).then((response) => { 
         if (response.status == 204) {
            swal("Correo electronico no existe","por favor, ingrese un correo electronico valido","warning");
            
         } 
         if (response.status == 200) {
           this.formulario_mostrar='tercera_parte';
           console.log(response.data.codigo)
           this.cod_res = response.data.codigo;
         }
        }).catch((error) => { 
           console.log(error); 
        });

    }else{ 
       swal("Credenciales incorrectas","Asegurese de tener todas las credenciales correctas","warning");
    }
},
        
listar(){
    const path = this.url+"/MateriasApi/"
    axios.get(path).then((response) => {
       //console.log(response.data)
       this.lista_materias = response.data  
    }).catch((error) => {
                console.log(error);
     })
},
        
buscar_tipo(tipo){
    return this.lista_materias.filter(c => c.tipo.toLowerCase().indexOf(tipo) > -1);
},

getLocation(){
    if(navigator.geolocation){
       navigator.geolocation.getCurrentPosition(position => {
       this.formulario.latitud= position.coords.latitude
       this.formulario.longitud =position.coords.longitude
       //console.log(this.formulario)
       })
    }else{
        console.log("Geolocation is not supported by this browser.")
    }
},

inciar_sesion(){
    this.$router.push({ name: 'Login', params: { userId: '123' } })
},

validaPassword(){
    var exp = /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/;
    if(exp.test(this.formulario.clave) && this.formulario.clave.length >= 8){
        this.validaContra = 'is-valid';
        this.validar_credenciales.validar_contra = true
    }else{
        this.validaContra = 'is-invalid';
        this.validar_credenciales.validar_contra = false;
    }
},


get_Correo(){
    if(this.formulario.correo.length >= 10){
        const path = this.url+"/UsuariosApi/?correo="+this.formulario.correo;
        axios.get(path).then((response) => {
                            if(response.data[0] == undefined){
                                this.validaEmail = 'is-valid';
                                this.validar_credenciales.validar_correo = true;
                                //console.log('correo valido');
                            }else{
                                this.validaEmail = 'is-invalid';
                                this.validar_credenciales.validar_correo = false;
                                //console.log('ya existe');
                            }

                    });
                }else{
                    this.validaEmail = 'is-invalid'
                    this.validar_credenciales.validar_correo = false;
                }
            },
        
        //onSignIn(user) {
        //    const profile = user.getBasicProfile()
        //    this.formulario.nombres   = profile.getGivenName()
        //    this.formulario.apellidos = profile.getFamilyName()
        //    this.formulario.correo = profile.getEmail()
        //    this.formulario.clave = user.getAuthResponse().id_token;
        //    
        //    
        //},

        confirPassword(){
             if(this.contra_validar === this.formulario.clave){
                this.cnf_contra = 'is-valid'
                this.validar_credenciales.validar_contra = true
            }else{
                 this.cnf_contra = 'is-invalid'
                 this.validar_credenciales.validar_contra = false
            }
        },




guardar_usuario(){
   if(this.validar_credenciales.validar_correo && this.validar_credenciales.validar_contra && this.codigo == this.cod_res){
       axios.post(this.url+'/UsuariosDataApi/', this.formulario, // the data to post
            { headers: {'Content-type': 'application/json','accept':'application/json'}
        }).then(response => {
                 //console.log(response.data);
                 if (response.status == 200) {
                    swal("Usuario registrado exitosamente","","success");
                    setTimeout(() => this.$router.push({ name: 'Login' }), 2000);
                 }
        })
       .catch((error) => {
           console.log(error);
       })
   }else{ 
        swal("Credenciales incorrectas.","Verifique si las credenciales ingresadas cumplen con los requisitos.","warning"); 
   }
}

    },
    computed:{
    },

    props:{

    },
    beforeCreate: function(){
        document.body.className = "bg-dark"
    },
    //mounted(){
    //     gapi.signin2.render('google-signin-btn', { 
    //        onsuccess: this.onSignIn, 
    //        theme:'dark',
    //        message: 'Iniciar sesion con google'
    //
    //    })
    //},
    created: function(){
        this.listar()
        this.formulario.genero = "M";
        this.getLocation()
        let usuario = JSON.parse(localStorage.getItem('Usuario'))
        if(usuario != null){
            if(usuario.rol == 'Estudiante'){
                this.$router.push({name:'Inicio_estudiante'})
            }else{
                this.$router.push({name:'Inicio_tutor'})
            }
        }
    }

}
</script>

<style media="screen">

fieldset{
		border: 1px solid #ddd !important;
		margin: 0;
		xmin-width: 0;
		padding: 10px;
		position: right;
		border-radius:4px;
		background-color:#f5f5f5;
		padding-left:10px!important;
	}

legend{
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
