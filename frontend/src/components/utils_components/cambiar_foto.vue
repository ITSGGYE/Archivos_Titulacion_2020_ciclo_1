<template>
  <div
    class="modal fade"
    id="modalCambiarFoto"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog"  role="document">
      <div class="modal-content">
        <div class="modal-header bg-verde text-light">
          <h5 class="modal-title text-light" id="exampleModalLabel">
            Actualizar foto de perfil
          </h5>
          <button
            class="close"
            type="button"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true" class="texr-light">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-4">
              <div
                class="imagen_circular_preview"
                v-bind:style="{
                  'background-image': 'url(' + usuario.foto + ')',
                }"
              >
              </div>
              <br />
              <h5>Foto Actual</h5>
            </div>
            <div class="col-4 py-3">
              <svg
                width="5em"
                height="5em"
                viewBox="0 0 16 16"
                class="bi bi-arrow-right"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M10.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L12.793 8l-2.647-2.646a.5.5 0 0 1 0-.708z"
                />
                <path
                  fill-rule="evenodd"
                  d="M2 8a.5.5 0 0 1 .5-.5H13a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8z"
                />
              </svg>
            </div>
            <div class="col-4">
              <div
                class="imagen_circular_preview"
                v-bind:style="{
                  'background-image': 'url(' + form_foto.foto_nueva + ')',
                }"
              ></div>
              <br />

              <h5>Nueva Foto</h5>
            </div>
            <div class="col-12">
              <label for="edit_imagen"> Seleccione una imagen </label>
              <input
                type="file"
                class="form-control"
                @change="preview_imagen"
                accept="image/x-png,image/jpeg" 
                ref="nueva_imagen_actualizar"
                id="edit_imagen"
                name="edit_imagen"
              />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">
            Cerrar
          </button>
          <button
            class="btn bg-verde text-light"
            @click="
              guardar_foto_perfil(usuario.id_persona, form_foto.foto_enviar)
            "
            type="button"
          >
            Guardar Foto
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import swal from 'sweetalert';
export default {
    props:['usuario'],
    data() {
        return {
                url: "http://173.212.250.236:8000",
                form_foto:{
                    id_persona: '',
                    foto_enviar:'',
                    foto_nueva: '../../static/images/profile_default.jpg'
                },

                api:{
                    GuardarFotoPerfil: 'http://173.212.250.236:8000/GuardarFotoPerfil/',
                    MEDIA: 'http://173.212.250.236:8000/media/'
                }
            }
        
    },

    methods:{
        guardar_foto_perfil(id,foto_nueva){
              const formData = new FormData()
              formData.append('id_persona',id);
              formData.append('foto',this.form_foto.foto_enviar,this.form_foto.foto_enviar.name);
              axios.post(this.api.GuardarFotoPerfil,formData).then((r) => 
                {
                    if(r.status == 200) {
                        
                        //this.$emit("usuario",this.MEDIA + r.foto);
                        //this.$vm.forceUpdate();;
                        console.log(r.data.foto);
                        this.usuario.foto = this.api.MEDIA + r.data.foto;
                        console.log(this.usuario.foto);
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
    },
    created: function(){
        const usuario = localStorage.getItem("Usuario");
        this.form_foto.foto_actual = this.usuario.foto;
        this.form_foto.id_persona = this.usuario.id_persona;
        console.warn("Profile component");
    }
};
</script>

<style>
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
    .imagen_circular_preview{
        border-radius: 50%;
        width: 150px;
        height: 150px;
        background-size: cover;
    }
</style>