<template>
  <div id="Create_user">
    <div class="row justify-content-center">
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-11">
        <div class="card shadow my-5">
          <div class="card-body p-4 text-center">
            <img src="../../assets/logo_horizontal_human.png" />
          </div>
          <hr class="my-0" />
          <div class="card-body p-1">
            <form method="POST" @submit.prevent="guardar_usuario" class="block">
              <br />
              <div class="row px-5">
                <div class="col-12 justify-content-center">
                  <div class="form-group">
                    <label class="text-600 h5" for="id_username">
                      Crear cuenta
                      <span style="color: #3e9f35">
                        <strong>Tutor</strong>
                      </span>
                      / <span style="color: #ea6c11"> Estudiante </span>
                    </label>
                  </div>
                </div>
                <div class="col-12 justify-content-center d-flex sbp-preview">
                  <div class="custom-control custom-radio px-2">
                    <input
                      @click="cb_tu = 'Estudiante'"
                      value="Profesor"
                      class="custom-control-input"
                      :required="cb_tu == 'Estudiante'"
                      id="customRadio1"
                      v-model="formulario.rol_nombre"
                      type="radio"
                      name="customRadio"
                    />
                    <label class="custom-control-label" for="customRadio1">
                      <strong> Soy un Tutor </strong>
                    </label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input
                      @click="cb_tu = 'Profesor'"
                      value="Estudiante"
                      class="custom-control-input"
                      :required="cb_tu == 'Profesor'"
                      id="customRadio2"
                      v-model="formulario.rol_nombre"
                      type="radio"
                      name="customRadio"
                    />
                    <label class="custom-control-label" for="customRadio2">
                      <strong> Soy un Estudiante </strong>
                    </label>
                  </div>
                </div>
                <br />
                <div class="col-6 py-2">
                  <div class="form-group">
                    <label for="nombres" class="float-left">
                      <strong> Nombres* </strong>
                    </label>
                    <input
                      class="form-control"
                      id="nombres"
                      type="text"
                      placeholder="Ingrese su nombre"
                      v-model="formulario.nombres"
                      required
                      autocomplete="off"
                    />
                  </div>
                </div>

                <div class="col-6 py-2">
                  <div class="form-group">
                    <label for="apellidos" class="float-left">
                      <strong> Apellidos* </strong>
                    </label>
                    <input
                      class="form-control"
                      id="apellidos"
                      name="apellidos"
                      v-model="formulario.apellidos"
                      type="text"
                      required
                      placeholder="Ingrese su apellido"
                      autocomplete="off"
                    />
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="correo" class="float-left">
                      <strong> Correo Electrónico* </strong>
                    </label>
                    <input
                      class="form-control"
                      @change="get_Correo"
                      required="required"
                      id="correo"
                      name="correo"
                      v-model="formulario.correo"
                      :class="[validaEmail]"
                      type="email"
                      placeholder="example@gmail.com"
                      autocomplete="off"
                    />
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group"></div>

                  <div class="form-group">
                    <label for="contra" class="float-left">
                      <strong> Contraseña* </strong>
                    </label>
                    <input
                      class="form-control"
                      id="contra"
                      :class="[validaContra]"
                      @keyup="validaPassword"
                      name="contra"
                      type="password"
                      required="required"
                      v-model="formulario.clave"
                      placeholder="Contraseña"
                      autocomplete="off"
                    />
                  </div>

                  <div class="form-group">
                    <label for="contra" class="float-left">
                      <strong> Repite la Contraseña* </strong>
                    </label>
                    <input
                      id="contra"
                      v-model="contra_validar"
                      @change="confirPassword"
                      :class="[cnf_contra]"
                      class="form-control"
                      required="required"
                      name="contra"
                      type="password"
                      placeholder="Confirmar contraseña"
                      autocomplete="off"
                    />
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group justify-content-center py-5">
                    <span class="text-dark-400">
                      Recuerde que su contraseña debe contener al menos los
                      siguientes parámetros:
                    </span>
                    <br />
                    <br />
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

                    <div style="position: absolute; bottom: 1rem; right: 1rem">
                      <!-- Toast -->
                    </div>
                  </div>
                </div>
              </div>
              <br />

              <br />
              <div class="row justify-content-center">
                <div class="col-4">
                  <button type="submit" class="btn btn-success btn-block lift">
                    <strong> Guardar </strong>
                  </button>
                </div>
                <div class="col-4">
                  <button
                    type="button"
                    v-on:click="inciar_sesion"
                    style="background-color: #919191"
                    class="btn btn-block lift text-light"
                  >
                    <strong> Cancelar </strong>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Login from "./Login.vue";
import axios from "axios";
import swal from "sweetalert";

export default {
  name: "Create_user",
  components: {
    Login,
  },
  data() {
    return {
      url: "http://173.212.250.236:8000",
      mostrar: false,
      formulario: {
        nombres: "",
        apellidos: "",
        tipo_sesion: "default",
        identificacion: "",
        correo: "",
        clave: "",
        rol_nombre: "",
        genero: "M",
        latitud: 0,
        longitud: 0,
        materias_afines: [],
      },
      validar_credenciales: {
        validar_ident: false,
        validar_contra: false,
        validar_correo: false,
      },

      contra_validar: "",
      cb_tu: "Profesor",
      error_identificacion: "",
      validaEmail: "",
      validaContra: "",
      cnf_contra: "",
      mensaje: `<div class="alert alert-danger alert-icon" role="alert">
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
                            </div>`,
    };
  },
  methods: {
    showPosition(position) {
      this.formulario.latitud = position.coords.latitude;
      this.formulario.longitud = position.coords.longitude;
    },

    getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(this.showPosition);
      } else {
        console.log("Geolocation is not supported by this browser.");
      }
    },

    inciar_sesion() {
      this.$router.push({ name: "Login", params: { userId: "123" } });
    },

    validaPassword() {
      var exp = /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/;
      if (
        exp.test(this.formulario.clave) &&
        this.formulario.clave.length >= 8
      ) {
        this.validaContra = "is-valid";
        this.validar_credenciales.validar_contra = true;
      } else {
        this.validaContra = "is-invalid";
        this.validar_credenciales.validar_contra = false;
      }
    },

    //get_identificacion(){
    //     if(this.formulario.identificacion.length >= 10){
    //      const path = "http://127.0.0.1:8000/PersonaApi/?identificacion="+this.formulario.identificacion;
    //      axios.get(path).then((response) => {
    //                  if(response.data[0]  == undefined){
    //                      this.validar_credenciales.validar_ident = true;
    //                      this.error_identificacion='is-valid';
    //                      console.log(this.validar_credenciales.validar_ident);
    //                      console.log('valido');
    //                  }else{
    //                      this.validar_credenciales.validar_ident = false;
    //                      this.error_identificacion='is-invalid';
    //                      console.log(this.validar_credenciales.validar_ident);
    //                      console.log('no valido');
    //                  }
    //              })
    //               .catch((error) => {
    //                      this.error = []
    //                      console.log(error);
    //              })
    //       }else{
    //         this.validar_credenciales.validar_ident = false;
    //         this.error_identificacion = 'is-invalid';
    //     }
    //},

    get_Correo() {
      if (this.formulario.correo.length >= 10) {
        const path =
          this.url+"/UsuariosApi/?correo=" + this.formulario.correo;
        axios.get(path).then((response) => {
          if (response.data[0] == undefined) {
            this.validaEmail = "is-valid";
            this.validar_credenciales.validar_correo = true;
            //console.log('correo valido');
          } else {
            this.validaEmail = "is-invalid";
            this.validar_credenciales.validar_correo = false;
            //console.log('ya existe');
          }
        });
      } else {
        this.validaEmail = "is-invalid";
        this.validar_credenciales.validar_correo = false;
      }
    },

    confirPassword() {
      if (this.contra_validar === this.formulario.clave) {
        this.cnf_contra = "is-valid";
        this.validar_credenciales.validar_contra = true;
      } else {
        this.cnf_contra = "is-invalid";
        this.validar_credenciales.validar_contra = false;
      }
    },

    guardar_usuario() {
      const path = this.url+"/UsuariosDataApi/";

      console.log(this.formulario);
      if (
        this.validar_credenciales.validar_correo &&
        this.validar_credenciales.validar_contra
      ) {
        axios
          .post(
            this.url+"/UsuariosDataApi/",
            this.formulario, // the data to post
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
            //setTimeout(() => this.$router.push({ name: 'Login' }), 2000);
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        this.mostrar = true;
      }
    },
  },
  computed: {},

  props: {},
  beforeCreate: function () {
    document.body.className = "bg-dark";
  },
  created: function () {
    this.getLocation();
    this.formulario.genero = "M";
    let usuario = JSON.parse(localStorage.getItem("Usuario"));
    if (usuario != null) {
      if (usuario.rol == "Estudiante") {
        this.$router.push({ name: "Inicio_estudiante" });
      } else {
        this.$router.push({ name: "Inicio_tutor" });
      }
    }
  },
};
</script>

<style media="screen">
</style>
