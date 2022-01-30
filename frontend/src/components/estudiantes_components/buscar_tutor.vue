<template>


<main>
<!-- card de perfil de usuario    -->
<div class="row justify-content-center py-2">
   <div class="col-12 px-4">
       <div class="card">
           <div class="card-header bg-verde">
                 <center>
                     <h1 class="text-light float-center">Búsqueda de Tutor</h1>
                 </center>
           </div>

            <div class="card-body" v-show="resultados==false">
               <div class="text-left">
                   <h5>1.- Selecciona el área que buscas</h5>
               </div>
  
                <div class="row">
                    <div class="col-md-4">
                        <fieldset>
                            <legend class="col-md-7"> Matemáticas </legend>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <label class="form-group" v-for="(m,indice) in buscar_tipo('matematica')" :key="indice">
                                            <input v-model="lista_display" type="checkbox" :checked="buscar(m.id_materias_afines)" :name="m.nombre" :value="m.id_materias_afines" class="checkboxinput" />
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
                                            <input v-model="lista_display" type="checkbox"  :name="m.nombre" :value="m.id_materias_afines" class="checkboxinput" />
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
                                            <input v-model="lista_display" type="checkbox"  :name="m.nombre" :value="m.id_materias_afines" class="checkboxinput" />
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
                                             <input v-model="lista_display" type="checkbox"  :name="m.nombre" :value="m.id_materias_afines" class="checkboxinput" />
                                             {{m.nombre}} &nbsp;&nbsp; &nbsp; &nbsp;
                                         </label>
                                     </div>
                                 </div>
                         </fieldset>
                    </div>
                </div>
                <hr class="my-3">
                 <div class="text-left">
                    <h5>2.- Selecciona tu día de disponibilidad</h5><br>
                        <div class="form-row">
                            <div class="custom-control custom-control-solid custom-checkbox">
                                <input class="custom-control-input small" id="customCheck1" v-model="informacion_buscar.dias_list" value="Lunes" type="checkbox">
                                <label class="custom-control-label mr-3" for="customCheck1">Lunes.</label>
                            </div>
                            <div class="custom-control custom-control-solid custom-checkbox" >
                                <input class="custom-control-input small" id="customCheck2" v-model="informacion_buscar.dias_list" value="Martes" type="checkbox">
                                <label class="custom-control-label mr-3" for="customCheck2">Martes.</label>
                            </div>
                            <div class="custom-control custom-control-solid custom-checkbox">
                                <input class="custom-control-input small" id="customCheck3" v-model="informacion_buscar.dias_list" value="Miercoles" type="checkbox">
                                <label class="custom-control-label mr-3" for="customCheck3">Miercoles.</label>
                            </div>
                            <div class="custom-control custom-control-solid custom-checkbox">
                                <input class="custom-control-input small" id="customCheck4" v-model="informacion_buscar.dias_list" value="Jueves" type="checkbox">
                                <label class="custom-control-label mr-3" for="customCheck4">Jueves.</label>
                            </div>
                            <div class="custom-control custom-control-solid custom-checkbox">
                                <input class="custom-control-input small" id="customCheck5" v-model="informacion_buscar.dias_list" value="Viernes" type="checkbox">
                                <label class="custom-control-label mr-3" for="customCheck5">Viernes.</label>
                            </div>
                            <div class="custom-control custom-control-solid custom-checkbox">
                                <input class="custom-control-input small" id="customCheck6" v-model="informacion_buscar.dias_list" value="Sabado" type="checkbox">
                                <label class="custom-control-label mr-3" for="customCheck6">Sabado.</label>
                            </div>
                            <div class="custom-control custom-control-solid custom-checkbox">
                                <input class="custom-control-input small" id="customCheck7" v-model="informacion_buscar.dias_list" value="Domingo" type="checkbox">
                                <label class="custom-control-label mr-3" for="customCheck7">Domingo.</label>
                            </div>
                        </div>
                </div>
                <hr class="my-3">
                <div class="text-left">
                    <h5>3.- Selecciona tu horario preferido</h5>
                    <br>
                </div>
                <div class="form-row">
                      <div class="col-xs-2">
                        <div id="div_id_fecha_nacimiento" class="control-group">
                          <div class="controls">
                            <input type="time" name="fecha_nacimiento" v-model="informacion_buscar.hora_inicio" class="form-control dateinput" required="" id="id_fecha_nacimiento">
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-1">
                        <p>a</p>
                      </div>
                      <div class="col-xs-2">
                        <div id="div_id_fecha_nacimiento" class="control-group">
                          <div class="controls">
                            <input type="time" name="fecha_nacimiento" v-model="informacion_buscar.hora_fin" class="form-control " required="" id="id_fecha_nacimiento">
                          </div>
                        </div>
                      </div>
                </div>
                <br>
            </div>


            <div class="card-body" v-show="resultados==true">
                <center> <h1>Resultados de busqueda</h1> </center>
                
                <table style="width: 100%;" class="table-hovered tabla">
                    <tr style="border:0.5px;" v-for="(c) in lista_tutor " :key="c.id_tutor">
                        <td class="m-1">
                            <img :src="c.id_usuario.id_persona.foto" alt="">
                                        <span class="derecha">
                                            <div class="imagen_circular" v-bind:style="{ 'background-image': 'url( http://localhost:8000'+c.id_usuario.id_persona.foto +')' }"> 
                                            </div>
                                        </span>
                        </td>
                        <td>
                            <label class="h4"> <strong>Nombre: </strong> </label><br>
                            <label class="h4"> <strong>Disponibilidad: </strong> </label><br>
                            <label class="h4"> <strong>Horario: </strong> </label><br>
                        </td>
                        <td>
                            <label class="h4 px-2"> {{c.id_usuario.id_persona.nombres}} {{c.id_usuario.id_persona.apellidos}}  </label><br>
                            <label class="h4 px-2" > {{mostrar_horario(informacion_buscar.dias_list,c.horario)}}  </label><br>
                            <label class="h4 px-2"> {{mostrar_disponibilidad(c.horario)}}  </label><br>
                        </td>
                        <td>
                            <label class="h4 px-3"> <strong> Experto en: </strong>   </label>
                            <div class="py-4">
                                <label class="h4"></label><br>
                            </div>
                            
                        </td>
                        <td>
                            <input class="checkboxinput" type="checkbox" disabled checked> <label class="h4">{{buscar(c.id_materias_afines[0])[0].nombre}}</label>
                            <br>
                            <input type="checkbox" class="checkboxinput" disabled checked> <label class="h4">{{buscar(c.id_materias_afines[1])[0].nombre}}</label>
                            <br>
                            <a href="#" type="button" @click="Buscar_filtros(c,'Detalles')" data-toggle="modal" data-target="#exampleModalLg">Ver más...</a>
                        </td>
                        <td>
                            <center class="h4 px-4"> <strong> Rating </strong> </center><br>
                            <div class="px-4 float-right">
                                <center>
                                <star-rating class="float-right" :increment="0.2" :max-rating="10" :star-size="35"  :read-only="true" v-model="c.calificacion"></star-rating>
                                </center>
                            </div>
                            <br> <br>
                            <div class="px-6 py-1">
                                <center>
                                <a href="#" data-toggle="modal" @click="Buscar_filtros(c.comentarios_positivos,'ComentariosPositivos')" data-target="#modalComentariosPositivos" class="float-center">Comentarios positivos({{c.comentarios_positivos.length}})</a><br>
                                </center>
                            </div>
                            <div class="px-6">
                                <center>
                                <a href="#" @click="Buscar_filtros(c.comentarios_negativos,'ComentariosNegativos')" data-toggle = "modal" data-target="#modalComentariosNegativos" class="float-center">Comentarios negativos({{c.comentarios_negativos.length}})</a>
                                </center>
                            </div>

                        </td>
                    </tr>
                </table>
                <!--Modal que muestra los detalles -->
                        <div class="modal fade" id="exampleModalLg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header" >
                                    <h5 class="modal-title">  <center>Informacion detallada</center> </h5>
                                    <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="row justify-content-center">
                                        <div class="col-2 px-2">
                                            <img class="imagen_circular" width="200px" :src="informacion_tutor.foto"  alt=""/><br>
                                        </div>
                                        <div class="col-md-6">
                                           <div class="py-4">
                                            <label class="h4 strong float-left">Nombre: {{informacion_tutor.nombres.toUpperCase()}} {{informacion_tutor.apellidos.toUpperCase()}}</label>
                                            <label class="h4 strong float-left">Identificacion: {{informacion_tutor.identificacion}}</label><br>
                                            <label class="h4 strong float-left">Correo electronico: {{informacion_tutor.correo}}</label> 
                                          </div>
                                        </div>
                                    </div>
                                            <br>

                                            <fieldset>
                                                <legend class="col-md-7"> Experto en </legend>
                                                <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-2" v-for="(m,indice) in informacion_tutor.detalle_materias" :key="indice">
                                                            <label class="form-group"> <strong>- {{m.nombre}} </strong> </label>  
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </fieldset>

                                            <br>

                                            <fieldset>
                                                <legend class="col-md-7"> Horario de atencion </legend>
                                                <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-3" v-for="(m,indice) in informacion_tutor.horario" :key="indice">
                                                            <label class="form-group"> 
                                                                <strong>
                                                                - {{m.dias}} desde {{m.hora_inicio}} hasta {{m.hora_fin}} 
                                                                </strong>
                                                            </label>  
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </fieldset>

                                            <br>

                                            <fieldset>
                                                <legend class="col-md-7"> Formacion del docente </legend>
                                                <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-4" v-for="(m,indice) in informacion_tutor.educacion" :key="indice">
                                                        
                                                            <label class="float-left"> 
                                                                <strong>
                                                                - {{m.universidad}} <br>
                                                                - Titulo: {{m.titulacion}} <br>
                                                                - Nota: {{m.nota}}  
                                                                </strong>
                                                            </label>  
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </fieldset>
                                </div>
                                <div class="modal-footer">
                                    <button @click="seleccionar_tutor(informacion_tutor.id_tutor)" class="btn bg-naranja text-light strong lift" type="button" > Seleccionar tutor </button>
                                    <button class="btn btn-danger text-light strong lift" type="button" data-dismiss="modal">Cerrar </button>
                                </div>
                            </div>
                            </div>
                        </div>


                        <div class="modal fade" id="modalComentariosPositivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Comentarios positivos sobre este tutor</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset v-for="(m,indice) in informacion_tutor.comentariosList" :key="indice">
                                                <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-12">
                                                            <label class="float-left"> 
                                                                <strong> - {{m.comentario}} </strong> 
                                                            </label>  
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn bg-verde text-light" type="button" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="modalComentariosNegativos" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Comentarios negativos sobre este tutor</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset v-for="(m,indice) in informacion_tutor.comentariosNegativ" :key="indice">
                                                <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-12">
                                                            <label class="float-left"> 
                                                                <strong>- {{m.comentario_negativo}}</strong>
                                                            </label>  
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                        </fieldset>
                                        <br><br>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn bg-verde text-light" type="button" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                <!--Fin de la seccion de modales-->
            </div>
            <div class="card-footer">
                <div class="row justify-content-center">
                  <div class="col-4">
                        <button class="btn btn-block  btn-primary"  v-show="resultados==false" @click="search_result" type="button" >
                            Buscar Tutor
                        </button>

                        <button @click="resultados=false" v-show="resultados==true" class="px-4 btn-block btn bg-naranja text-light">
                            Volver a buscar
                       </button>
                  </div>
                </div>
            </div>
       </div>     
    </div>
</div>
<br><br>
</main>

</template>

<script>
import Perfil_estudiante from "./Perfil_estudiante";
import StarRating from 'vue-star-rating'
import HelloWord from "../HelloWorld";
import axios from "axios";
import swal from "sweetalert";
import { LMap,LTileLayer,LMarker,LIcon,LPopup } from 'vue2-leaflet';

export default{
    name: 'buscar_tutor',
    components:{ Perfil_estudiante ,StarRating},
    props: ['mostrar'],
    data() {
        return {
           url: "http://173.212.250.236:8000",
           rating: 1.5,
           resultados: false, 
           estudiante:{
                id_estudiante:0,
                id_usuario:0,
                id_materias_afines:[]
            },
            lista_materias:[],
            lista_display:[],
            //Objeto que tiene todos los parametros de busqueda 
            informacion_buscar:{
                    dias_list:[],
                    hora_inicio : '',
                    hora_fin : '',
                    materias_buscar:[],
                    comentariosList: [],
                    comentariosNegativ: []

            },
          //Esta objeto contiene los detalles de una tutor al darle click en  'ver mas ..'  
          informacion_tutor:{
              detalle_materias:[],
              id_tutor:0,
              nombres:'',
              apellidos:'',
              correo:'', 
              foto:'',
              identificacion:'',
              latitud:0,
              longitud:0,
              experiencia:[],
              horario:[],
              educacion:[]
          },  
          //Lista de resultados de busqueda  
          lista_tutor:[],
          experiencia: '',
          disponibilidad: ''
        }

    },
    methods:{

        mostrar_horario(lista_dias,lista_tutor_dias){

            if (typeof lista_dias !== 'undefined' && lista_dias.length > 0) {
                 var ListaFiltrada = lista_dias.filter(
                 function(el) { 
                 for (var i = 0; i < lista_tutor_dias.length; i++) {
                     if (el == lista_tutor_dias[i].dias ) {
                         return true; 
                     }
                 }
                 return false;
                 });
                 var cadena = "- "+ListaFiltrada[0];
                 for (var i = ListaFiltrada.length - 1; i >= 0; i--) {
                     if (ListaFiltrada[i] != ListaFiltrada[0] ) {
                         cadena += " - "+ListaFiltrada[i];
                     }
                 }
                 return cadena;

            }else{
                var string = "- "+lista_tutor_dias[0].dias
                for (var i = lista_tutor_dias.length - 1; i >= 0; i--) {
                    if (lista_tutor_dias[0].dias != lista_tutor_dias[i].dias) {
                        string += " - "+lista_tutor_dias[i].dias;
                    }
                }
                return string;

            }
        },

        mostrar_disponibilidad(horario){

        },
        
       seleccionar_tutor(obj){
           var info = {
                tipo: 'notificacion_seleccion_tutor',
                id_usuario: this.estudiante.id_usuario,
                id_estudiante: this.estudiante.id_estudiante,
                id_tutor: obj,
           }
           axios.post(this.url+"/AsignarTutor/",info).then((r) => {
               if(r.status == 208 ){
                   swal("Tutor ya asignado", "","warning");
                   //this.$emit("mostrar","Perfil_estudiante");
               }
               if(r.status == 200){
                   
                   axios.post(this.url+"/Correos_electronicos/",info).then((response) => {
                        if (response.status == 200) {
                           swal("Se ha enviado tu solicitud al tutor que seleccionaste.","","success");
                           //this.$emit("mostrar","Perfil_estudiante");
                        }else{
                           swal("Error de servidor.","Intentelo mas tarde. ","error");
                        }
                   }).catch((error) => {
                      console.log(error);
                   })
                   
               }
           }).catch((error) => {
               console.log(error)
           })
       }, 

       search_result(){
           this.resultados = true
           this.informacion_buscar.materias_buscar = this.lista_display
           axios.post(this.url+"/Buscar/",this.informacion_buscar).then((response) => {
             //console.log(response.data)
             this.lista_tutor=response.data
             console.log(this.lista_tutor)
           }).catch((error) => {
               console.log(error)
           })
        },

    Comentarios(tutor){
        this.informacion_tutor.comentariosList = tutor.comentarios_positivos
        this.informacion_tutor.comentariosNegativ = tutor.comentarios_negativos
    },

    Buscar_filtros(tutor,tipo_data) {
        if (tipo_data == 'Detalles') {

            this.informacion_tutor.id_tutor = tutor.id_tutor;
            this.informacion_tutor.nombres = tutor.id_usuario.id_persona.nombres;
            this.informacion_tutor.apellidos = tutor.id_usuario.id_persona.apellidos;
            this.informacion_tutor.identificacion = tutor.id_usuario.id_persona.identificacion;
            this.informacion_tutor.educacion = tutor.educacion;
            this.informacion_tutor.latitud = tutor.id_usuario.id_persona.latitud;
            this.informacion_tutor.longitud = tutor.id_usuario.id_persona.longitud;
            this.informacion_tutor.correo = tutor.id_usuario.correo;
            this.informacion_tutor.comentariosList = tutor.comentarios_positivos;
            this.informacion_tutor.comentariosNegativ = tutor.comentarios_negativos;
            this.informacion_tutor.foto = this.url+tutor.id_usuario.id_persona.foto;
            this.informacion_tutor.horario = tutor.horario;
            //console.log(this.informacion_tutor.horario)
            var ListaFiltrada = this.lista_materias.filter(
            function(el) { // se ejecuta por cada elemento
                for (var i = 0; i < tutor.id_materias_afines.length; i++) { // iteramos sobre la lista que usamos de filtro
                    if (el.id_materias_afines == tutor.id_materias_afines[i] ) {
                        return true; // if this person knows this language
                    }
                }
                return false;
            });     
            this.informacion_tutor.detalle_materias = ListaFiltrada;   
        }
        if (tipo_data == 'ComentariosPositivos') {
            this.informacion_tutor.comentariosList = tutor;
        }
        if (tipo_data == 'comentariosNegativ') {
            this.informacion_tutor.comentariosNegativ = tutor;
        }
    },

      llenar_informacion(){
            const usuario = localStorage.getItem("Usuario")
            const path = this.url+"/MateriasEstudianteApi/?id="+usuario
            axios.get(path).then((response) => {
                //console.log(response.data)
                this.estudiante = response.data
                this.lista_display = this.estudiante.id_materias_afines
            })
            .catch((error) => {
                console.log(error);
            })
        },


        buscar(id,tipo){
            const lista = this.estudiante.id_materias_afines
            var name = false
            for (let index = 0; index < lista.length; index++) {
                const element = lista[index];
                if(element == id){
                    name = true
                }else{
                  name =  false
                }
            }
            return name
        },

          
        buscar_tipo(tipo){
            return this.lista_materias.filter(c => c.tipo.toLowerCase().indexOf(tipo) > -1);
        },

        

        buscar(tipo){
             return this.lista_materias.filter(c => c.id_materias_afines === tipo);
        },

        listar(){
            const path = this.url+"/MateriasEApi/"
            axios.get(path).then((response) => {
                //console.log(response.data)
                this.lista_materias = response.data
            })
            .catch((error) => {
                console.log(error);
            })
        }
    },



    //Funciones que se ejecutan al cargar el componente

    computed:{},
    created: function(){
        this.llenar_informacion()
        this.listar()
    },
    //Sirve para definir el tipo de datos que recibe de otros componentes
    props:{

    },
    beforeCreate: function(){
        document.body.className = "bg-light nav-fixed"
        let usuario = localStorage.getItem("Usuario")
        //console.log(usuario)
            if(usuario === null){
                this.$router.push({name:'Login'})
            }
    }


}


</script>

<style>
 .tabla tr td {
    border-top: 2px solid black;
}
fieldset{
		border: 1px solid #ddd !important;
		margin: 0;
		xmin-width: 0;
		padding: 12px;
		position: right;
		border-radius:4px;
        font-size:14px;
		background-color:#f5f5f5;
		padding-left:10px!important;
	}

legend{
			font-size:14px;
			font-weight:bold;
			margin-bottom: 0px;
			width: 30%;
			border: 1px solid #ddd;
			border-radius: 4px;
			padding: 5px 5px 5px 10px;
			background-color: #ffffff;
		}
.imagen_circular{
        border-radius: 50%;
        width: 120px;
        height: 120px;
        background-size: cover;
    }
</style>
