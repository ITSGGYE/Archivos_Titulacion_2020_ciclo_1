<template>
  <div id="PagosProfesor">
    <div class="row justify-content-center">
      <div class="col-10">
        <div
          class="card shadow"
          v-for="(estudiante, i) in lista_estudiante"
          :key="i"
        >
          <div class="row no-gutters">
            <div class="col-md-4">
              <img
                width="200px"
                class="img-fluid float-left"
                :src="
                  'http://localhost:8000' +
                  estudiante.id_estudiante.id_usuario.id_persona.foto
                "
                alt="Sin imagen"
              />
            </div>
            <div class="col-md-5">
              <div class="card-body">
                <h5 class="card-title float-left">
                  <strong> Nombre: </strong>
                  {{ estudiante.id_estudiante.id_usuario.id_persona.nombres }}
                </h5>
                <h5 class="card-title float-left">
                  <strong>Correo: </strong>
                  {{ estudiante.id_estudiante.id_usuario.correo }}
                </h5>
                <br />
                <h5 class="card-title float-left">
                  <strong>Identificacion: </strong>
                  {{
                    estudiante.id_estudiante.id_usuario.id_persona
                      .identificacion
                  }}
                </h5>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card-body">
                <button class="btn bg-verde text-light">Realizar Pago</button>
              </div>
            </div>
          </div>
        </div>
        <br /><br />
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "PagosProfesor",
  components: {},
  data() {
    return {
      url_api: "http://173.212.250.236:8000",
      lista_estudiante: [],
      tutor: 0,
    };
  },
  methods: {
    

    listar_estudiante() {
      axios
        .get(
          this.url_api+"/AsignarTutor/?id_usuario_tutor=" + this.tutor
        )
        .then((response) => {
          this.lista_estudiante = response.data;
          console.log(this.lista_estudiante);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  created: function () {
    this.tutor = localStorage.getItem("Usuario");
    this.listar_estudiante();
  },
};
</script>

<style>
</style>