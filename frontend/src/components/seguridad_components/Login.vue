<template>
  <div id="login">
    <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">
        <form @submit.prevent="iniciar_sesion">
          <main>
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6">
                  <div class="card shadow my-5">
                    <!--Cabecera-->
                    <div class="card-body p-4 text-center">
                      <img src="../../assets/logo_horizontal_human.png" />

                      <div
                        class="h2 font-weight-bolder mb-3"
                        v-html="Titulo"
                      ></div>
                    </div>
                    <hr class="my-0" />

                    <!--Contenido-->
                    <div class="card-body p-5" v-if="mop == false">
                      <div class="form-group">
                        <label class="text-600 h5 float-left" for="id_username">
                          <strong> Correo Electrónico* </strong>
                        </label>
                        <input
                          autocomplete="off"
                          required
                          v-model="credenciales.correo"
                          type="email"
                          name="id_username"
                          class="form-control form-control-block"
                          id="id_username"
                          aria-describedby="emailHelp"
                        />
                      </div>
                      <div class="form-group">
                        <label
                          class="text-dark-600 h5 float-left"
                          for="emailExample"
                        >
                          <strong> Contraseña* </strong>
                        </label>
                        <input
                          v-model="credenciales.clave"
                          autocomplete="off"
                          
                          type="password"
                          name="pass"
                          class="form-control form-control-block"
                          id="id_password"
                          required
                        />
                      </div>
                      <br />
                      <div class="row justify-content-center">
                        <div class="col-5">
                          <button type="submit" class="btn btn-primary btn-block lift">
                            Iniciar Sesion
                          </button>
                        </div>
                        
                        <div class="col-5">
                          <button
                            type="button"
                            class="btn btn-success lift"
                            @click="crear_usuario"
                          >
                            Crear cuenta
                          </button>
                        </div>
                        
                      </div>
                    </div>

                    <div class="card-body p-5" v-if="mop == true">
                      <form @submit.prevent="Guardar_usuario(tipo_usuario)">
                        <div class="form-group">
                          <button
                            @click="tipo_usuario = 'Profesor'"
                            type="submit"
                            class="text-light btn btn-block bg-naranja strong lift"
                          >
                            Soy Tutor &nbsp;
                            <i class="fas fa-arrow-right text-light"></i>
                          </button>
                        </div>
                        <div class="form-group">
                          <button
                            @click="tipo_usuario = 'Estudiante'"
                            type="submit"
                            class="btn btn-block text-light bg-verde strong lift"
                          >
                            Soy Estudiante &nbsp;
                            <i class="fas fa-arrow-right text-light"></i>
                          </button>
                        </div>
                        <div class="form-group">
                          <label class="text-dark-600 h5" for="emailExample">
                            <strong> Ingrese su nueva contraseña* </strong>
                          </label>
                          <input
                            v-model="nueva_clave"
                            autocomplete="off"
                            type="password"
                            :class="[validaContra]"
                            @keyup="validaPassword"
                            name="pass"
                            class="form-control form-control-block"
                            id="id_password"
                            required
                          />
                          <br />
                          <br>
                          
                            <span class="text-dark-200 float-left">
                              Recuerde que su contraseña debe contener al menos
                              los siguientes parámetros:
                            </span>
                            <br> <br>
                            <span class="text-dark-200 ">
                              <li>Debe contener letras y numeros</li>
                              <li>Minimo 8 caracteres</li>
                            </span>
                          
                        </div>
                      </form>
                    </div>

                    <!--Pie de pagina-->
                    <div class="card-footer px-5 py-4">
                      <div
                        v-if="mop == false"
                        class="row justify-content-center"
                      >
                        <div
                          style="background-color: #dc4e42"
                          id="google-signin-btn"
                        ></div>
                        <!--Boton que genera Google Apis-->
                      </div>

                      <div
                        v-if="mop == true"
                        class="row justify-content-center"
                      >
                        <button
                          @click="signOut('cancelar')"
                          type="button"
                          class="btn btn-block btn-danger text-light"
                        >
                          <i class="fas fa-arrow-left text-light"></i> &nbsp;
                          Cancelar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </main>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Create_user from "./Create_user.vue";
import axios from "axios";
import swal from "sweetalert";

export default {
  name: "login",
  components: { Create_user },
  data() {
    return {
      url: "http://173.212.250.236:8000",
      Titulo:
        "<span style='color: #3E9F35; '>Iniciar</span> <span style='color:#EA6C11;'> Sesión </span>",
      tipo_usuario: "",
      mop: false,
      usuario: {
        id_usuario: 0,
        rol_nombre: "",
      },

      credenciales: {
        id_usuario: 0,
        nombres: "No definido",
        apellidos: "No definido",
        identificacion: "",
        tipo_sesion: "google",
        rol_nombre: "Estudiante",
        genero: "M",
        correo: "",
        clave: "",
        latitud: 0,
        longitud: 0,
        materias_afines: [],
      },

      nueva_clave: "",

      validaContra: "",
      validar_credenciales: {
        validar_contra: false,
      },
    };
  },
  methods: {
    validaPassword() {
      var exp = /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/;
      if (exp.test(this.nueva_clave) && this.nueva_clave.length >= 8) {
        this.validaContra = "is-valid";
        this.validar_credenciales.validar_contra = true;
      } else {
        this.validaContra = "is-invalid";
        this.validar_credenciales.validar_contra = false;
      }
    },

    showPosition(position) {
      //console.log("Longitud:" + this.credenciales.longitud)
      //console.log("Latitud:" + this.credenciales.latitud)
      this.credenciales.latitud = position.coords.latitude;
      this.credenciales.longitud = position.coords.longitude;
    },

    getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          this.showPosition,
          this.showPosition,
          { timeout: 5000 }
        );
      } else {
        console.log("Geolocation is not supported by this browser.");
      }
    },

    //ESTA FUNCION SE EJECUTA AL CREAR EL USUARIO CON GMAIL POR PRIMERA VEZ
    //GUARDO SU ACTUAL LOCALIZAION,GUARDO EN LA PROPIEDAD  rol_nombre EL TIPO DE USUARIO SEGUN EL TIPO QUE PASO POR PARAMETROS
    //LLAMO A MI API UsuarioDataApi PARA GUARDAR LA INFORMACION
    //EN EL SERVIDOR VALIDO SI EL TIPO_SESION ES IGUAL A google NO VA A ENCRIPTARLA CONTRASEÑA YA QUE VIENE ENCRIPTADA POR GOOGLE. CASO CONTRARIO, UTILIZO HASHLIB PARA ENCRIPTAR
    Guardar_usuario(tipo) {
      if (this.validar_credenciales.validar_contra == true) {
          this.credenciales.clave = this.nueva_clave;
      this.getLocation();
      if (tipo == "Estudiante") {
        this.credenciales.rol_nombre = "Estudiante";
        //console.log(this.credenciales);
      } else {
        this.credenciales.rol_nombre = "Profesor";
        //console.log(this.credenciales);
      }

      const path = "http://127.0.0.1:8000/UsuariosDataApi/";

      axios
        .post(
          "http://127.0.0.1:8000/UsuariosDataApi/",
          this.credenciales, // the data to post
          {
            headers: {
              "Content-type": "application/json",
              accept: "application/json",
            },
          }
        )
        .then((response) => {
          //console.log(response.data);
          swal("Usuario registrado exitosamente", "", "success");
          this.credenciales.id_usuario = response.data.id_usuario;
          this.credenciales.rol_nombre = response.data.rol;
          localStorage.setItem("Usuario", this.credenciales.id_usuario);
          localStorage.setItem("Rol", this.credenciales.rol_nombre);
          localStorage.setItem("tipo_usuario", "default");
          if (response.data.rol == "Estudiante") {
            this.$router.push({ name: "inicio_estudiante" });
          } else {
            this.$router.push({ name: "inicio_tutor" });
          }
        })
        .catch((error) => {
          console.log(error);
        });
      }else{
        swal("Contraseña no valida","Verifique que la contraseña cumpla con los requisitos.","warning");
      }
      
    },

    //FUNCION QUE ME PERMITE CERRAR LA SESION SI EL USUARIO DECIDE CANCELAR EL PROCESO DE INICIAR SESION POR PRIMERA VEZ CON GMAIL EN NUESTRO SISTEMA
    //PUSE LA FUNCION renderizar_google_button() PARA QUE LA FUNCION ESPERE 900 ms  ANTES DE RENDERIZAR NUEVAMENTE EL BOTON DE INICIAR SESION CON GMAIL
    signOut(tipo) {
      var auth2 = gapi.auth2.getAuthInstance();
      if (auth2.isSignedIn.get() == true) {
        auth2.disconnect();
        auth2
          .signOut()
          .then(function () {
            //console.log('User signed out.');
            gapi.auth2.getAuthInstance().currentUser.get().reloadAuthResponse();
          })
          .catch((error) => {
            console.log(error);
          });

        this.credenciales = {
          
          nombres: "No definido",
          apellidos: "No definido",
          identificacion: "",
          tipo_sesion: "default",
          rol_nombre: "Estudiante",
          genero: "M",
          correo: "",
          clave: "",
          latitud: 0,
          longitud: 0,
          materias_afines: [],
        };
        if (tipo == "cancelar") {
          this.mop = false;
          this.Titulo = `<span style='color: #3E9F35; '>Iniciar</span> <span style='color:#EA6C11;'> Sesión </span>`;
          setTimeout(() => {
            this.renderizar_google_button();
          }, 500);
        }
      }
    },
    //CON ESTA FUNCION SE PUEDE VOLVER A RENDERIZAR EL BOTON DE INICIAR SESION
    renderizar_google_button() {
      gapi.signin2.render("google-signin-btn", {
        onsuccess: this.onSignIn,
        theme: "dark",
        label: "Iniciar Sesión con google",
        scope: "profile email",
        width: 400,
        height: 50,
      });
    },
    //REDIRIGE AL FORMULARIO PARA CREAR UNA CUENTA
    crear_usuario() {
      this.$router.push({ name: "Create_user" });
    },
    //INICIAR SESION
    iniciar_sesion() {
      this.credenciales.tipo_sesion = "default";
      const path = this.url+"/IniciarSesion/";
      axios
        .post(
          path,
          this.credenciales, // the data to post
          {
            headers: {
              "Content-type": "application/json",
              accept: "application/json",
            },
          }
        )
        .then((response) => {
          if (response.data["usuario_exists"]) {
            swal(
              "Correo o contraseña incorrectos",
              "Verifica si sus credenciales son correctos.",
              "error"
            );
          } else {
            //console.log(response.data)
            //console.log("Usuario vacio:" + this.usuario.id_usuario)
            this.usuario.id_usuario = response.data.id_usuario;
            this.usuario.rol_nombre = response.data.rol;
            //console.log("usuario actual:" + this.usuario.id_usuario)
            swal(
              "Bienvenido " +
                response.data.nombres +
                " " +
                response.data.apellidos,
              "",
              "success"
            );
            localStorage.setItem("Usuario", this.usuario.id_usuario);
            localStorage.setItem("tipo_usuario", "default");
            localStorage.setItem("Rol", this.usuario.rol_nombre);
            this.signOut("inicio");
            //console.log( "Variable de sesion: " +localStorage.getItem("Usuario"))
            if (response.data.rol == "Estudiante") {
              setTimeout(
                () => this.$router.push({ name: "inicio_estudiante" }),
                2000
              );
            } else {
              setTimeout(
                () => this.$router.push({ name: "inicio_tutor" }),
                2000
              );
            }
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    //INICIAR SESION UTILIZANDO GMAIL. SE EJECUTA EN LA PROPIEDA ON SUCCESS DEL BOTON DE GMAIL.TOMO LOS DATOS BASICOS Y VALIDO SI EL CORREO EXISTE EN LA BASE DATOS
    //SI EXISTE RENDERIZO LA PANTALLA DE INICIO SEGUN SU ROL. CASO CONTRARIO, LA VARIABLE BOOLEANA mop SERA IGUAL A TRUE.
    //SI mop  ES TRU SE VISUALIZA UNA PANTALLA DONDE LE PREGUNTA AL USUARIO QUE TIPO DE USUARIO ES PARA POSTERIORMENTE GUARDARLO(ESTE PROCESO SE HACE LA PRIMERA VEZ QUE INGRESA USANDO GMAIL)
    onSignIn(user) {
      gapi.auth2.getAuthInstance().currentUser.get().reloadAuthResponse();
      const profile = user.getBasicProfile();
      //Tomamos la informacion basica del usuario en Gmail
      this.credenciales.tipo_sesion = "google";
      this.credenciales.correo = profile.getEmail();
      //this.credenciales.clave = user.getAuthResponse().id_token
      this.credenciales.nombres = profile.getGivenName();
      this.credenciales.apellidos = profile.getFamilyName();
      this.getLocation();
      //Guardamos la ubicacion actual para usarla en el mapa
      const path =
        "http://localhost:8000/GoogleSesion/?correo=" +
        this.credenciales.correo;
      axios.get(path).then((r) => {
        if (r.status == 226) {
          this.usuario.id_usuario = r.data.id_usuario;
          this.usuario.rol_nombre = r.data.rol;
          swal(
            "Bienvenido " +
              this.credenciales.nombres +
              " " +
              this.credenciales.apellidos,
            "",
            "success"
          );
          localStorage.setItem("Usuario", this.usuario.id_usuario);
          localStorage.setItem("tipo_usuario", "google");
          localStorage.setItem("Rol", this.usuario.rol_nombre);
          this.signOut("inicio");
          if (r.data.rol == "Estudiante") {
            this.$router.push({ name: "inicio_estudiante" });
          } else {
            this.$router.push({ name: "inicio_tutor" });
          }
        } else {
          this.getLocation();
          this.mop = true;
          this.Titulo =
            "<span style='color:#3E9F35;'>¿Que tipo de usuario quieres ser?</span>";
        }
      });

      //const profile = user.getBasicProfile()
      //console.log(profile)
      //console.log(profile.getFamilyName())
      //console.log( profile.getEmail())
      //var id_token = user.getAuthResponse().id_token;
      //
    },
  },
  computed: {},
  created: function () {
    //GUARDO EN UNA VARIABLE EL TIPO DE ROL ALMACENADO CON MI LOCALSTORAGE "rol"
    //SI NO ES NULL, SIGNIFICA QUE NO AH CERRADO SESION Y SEGUIRA SIENDO REDIRIGIDO A LA PANTALLA DE INICIO SEGUN SU ROL
    this.getLocation();
    let rol = localStorage.getItem("Rol");
    if (rol != null) {
      if (rol == "Estudiante") {
        this.$router.push({ name: "inicio_estudiante" });
      } else {
        this.$router.push({ name: "inicio_tutor" });
      }
    }
  },
  beforeCreate: function () {
    document.body.className = "bg-dark";
  },
  //Sirve para definir el tipo de datos que recibe de otros componentes
  props: {},
  //TODA LIBRERIA EXTERNA (LEAFLET O GAP POR EJEMPLO) INTENTA RENDERIZARSE MUCHO ANTES QUE SU CONTENEDOR O AL DOM ESTE COMPLETAMENTE RENDERIZADO CAUSANDO ERRORES.
  //ES POR ESO QUE RENDERIZO EL BOTON DE GOODGLE EN mounted() PARA Q NO SE EJECUTE HASTA QUE EL COMPONENTE ESTE COMPLETAMENTE RENDERIZADO
  mounted() {
    gapi.signin2.render("google-signin-btn", {
      onsuccess: this.onSignIn,
      theme: "dark",
      label: "Iniciar Sesión con google",
      scope: "profile email",
      width: 400,
      height: 50,
    });
  },
};
</script>

<style media="screen">
.my-button {
  background-color: #eee;
}
.my-button span.text {
  color: red;
}
</style>
