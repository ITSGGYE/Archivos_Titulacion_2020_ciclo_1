<template>
     <div class="card shadow mx-4">
                        <div class="card-header bg-verde justify-content-center" >
                        <div class="row " >
                            <div class="col-12">
                                <h1 class="text-light" style=""> <strong> Horario </strong> </h1><!-- separador  o espacios-->
                            </div>
                        </div>
                        </div>
                        <div class="card-body">

                            <hr class="my-3">

                            <!-- form row: para tener varias columnas en una fila con sus respectivos col-md-sm-xs-lg-etc...-->
                            <!--Lunes-->
                            <div class="form-row">
                                <div class="col-sm-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" v-model="lunes.estado" id="customCheck1" type="checkbox"><label class="custom-control-label mr-3" for="customCheck1">lunes</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" v-model="lunes.hora_inicio"  name="fecha_nacimiento" class="form-control dateinput"  id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <p>a</p>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" v-model="lunes.hora_fin" name="fecha_nacimiento" class="form-control "  id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" v-model="lunes.virtual" id="customCheck2" type="checkbox"><label class="custom-control-label mr-3" for="customCheck2">En linea</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" v-model="lunes.prescencial" id="customCheck3" type="checkbox"><label class="custom-control-label mr-3" for="customCheck3">Presencial</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!--Martes-->
                            <div class="form-row">
                                <div class="col-sm-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" v-model="martes.estado" id="customCheck11" type="checkbox"><label class="custom-control-label mr-3" for="customCheck11">Martes</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" v-model="martes.hora_inicio" name="fecha_nacimiento" class="form-control dateinput" required="" id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <p>a</p>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" name="fecha_nacimiento" v-model="martes.hora_fin" class="form-control " required="" id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" v-model="martes.virtual" id="customCheck22" type="checkbox"><label class="custom-control-label mr-3" for="customCheck22">En linea</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" v-model="martes.prescencial" id="customCheck33" type="checkbox"><label class="custom-control-label mr-3" for="customCheck33">Presencial</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!--Miercoles-->
                            <div class="form-row">
                                <div class="col-sm-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" v-model="miercoles.estado" id="customCheck111" type="checkbox"><label class="custom-control-label mr-3" for="customCheck111">Miercoles</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" name="fecha_nacimiento" v-model="miercoles.hora_inicio" class="form-control dateinput" required="" id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <p>a</p>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" name="fecha_nacimiento" v-model="miercoles.hora_fin" class="form-control " required="" id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" id="customCheck222" v-model="miercoles.virtual" type="checkbox"><label class="custom-control-label mr-3" for="customCheck222">En linea</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" id="customCheck333" v-model="miercoles.prescencial" type="checkbox"><label class="custom-control-label mr-3" for="customCheck333">Presencial</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!--Jueves-->
                            <div class="form-row">
                                <div class="col-sm-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" id="customCheck1111" v-model="jueves.estado" type="checkbox"><label class="custom-control-label mr-3" for="customCheck1111">Jueves</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" name="fecha_nacimiento" class="form-control dateinput" v-model="jueves.hora_inicio"  required="" id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <p>a</p>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" name="fecha_nacimiento" class="form-control " v-model="jueves.hora_fin" required="" id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" id="customCheck2222" v-model="jueves.virtual" type="checkbox"><label class="custom-control-label mr-3" for="customCheck2222">En linea</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" id="customCheck3333" v-model="jueves.prescencial" type="checkbox"><label class="custom-control-label mr-3" for="customCheck3333">Presencial</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!--viernes-->
                            <div class="form-row">
                                <div class="col-sm-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" id="customCheck11111" v-model="viernes.estado" type="checkbox"><label class="custom-control-label mr-3" for="customCheck11111">Viernes</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" name="fecha_nacimiento"  v-model="viernes.hora_inicio" class="form-control dateinput" required="" id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <p>a</p>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" name="fecha_nacimiento"  v-model="viernes.hora_fin" class="form-control " required="" id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" id="customCheck22222"  v-model="viernes.virtual" type="checkbox"><label class="custom-control-label mr-3" for="customCheck22222">En linea</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" id="customCheck33333"  v-model="viernes.prescencial" type="checkbox"><label class="custom-control-label mr-3" for="customCheck33333">Presencial</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!--sabado-->
                            <div class=
                            "form-row">
                                <div class="col-sm-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small"  v-model="sabado.estado" id="customCheck111111" type="checkbox"><label class="custom-control-label mr-3" for="customCheck111111">Sabado</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" name="fecha_nacimiento"  v-model="sabado.hora_inicio" class="form-control dateinput" required="" id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <p>a</p>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" name="fecha_nacimiento" class="form-control" v-model="sabado.hora_fin" required="" id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" id="customCheck222222" v-model="sabado.virtual" type="checkbox"><label class="custom-control-label mr-3" for="customCheck222222">En linea</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" id="customCheck333333" v-model="sabado.prescencial" type="checkbox"><label class="custom-control-label mr-3" for="customCheck333333">Presencial</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!--Domingo-->
                            <div class="form-row">
                                <div class="col-sm-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" id="customCheck1111111" v-model="domingo.estado" type="checkbox"><label class="custom-control-label mr-3" for="customCheck1111111">Domingo</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" name="fecha_nacimiento" v-model="domingo.hora_inicio" class="form-control dateinput" required="" id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <p>a</p>
                                </div>
                                <div class="col-xs-2">
                                    <div id="div_id_fecha_nacimiento" class="control-group">
                                        <div class="controls">
                                            <input type="time" name="fecha_nacimiento" class="form-control " v-model="domingo.hora_fin" required="" id="id_fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" id="customCheck2222222" v-model="domingo.virtual" type="checkbox"><label class="custom-control-label mr-3" for="customCheck2222222">En linea</label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="custom-control custom-control-solid custom-checkbox">
                                        <input class="custom-control-input small" id="customCheck3333333" type="checkbox" v-model="domingo.prescencial"><label class="custom-control-label mr-3" for="customCheck3333333">Presencial</label>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">
                            <div class="row justify-content-center">
                                <div class="col-6">
                                     <button type="button" @click="guardar_todo" :disabled="bloquear_boton==true" class="btn btn-primary btn-block ">&nbsp; &nbsp;Guardar cambios&nbsp;&nbsp; &nbsp;</button>
                                </div>
                            </div>

                            <br>
                        </div>
                    </div>
</template>

<script>
import axios from "axios";
import swal from 'sweetalert';
export default {

name: 'HoratiosTutor',
data(){
    return{
        url: "http://173.212.250.236:8000",
        lunes:{id_horario:0,tutor:0,estado:false,dias:'lunes',hora_inicio:'',hora_fin:'',prescencial:false,virtual:false},
        martes:{id_horario:0,tutor:0,estado:false,dias:'martes',hora_inicio:'',hora_fin:'',prescencial:false,virtual:false},
        miercoles:{id_horario:0,tutor:0,estado:false,dias:'miercoles',hora_inicio:'',hora_fin:'',prescencial:false,virtual:false},
        jueves:{id_horario:0,tutor:0,estado:false,dias:'jueves',hora_inicio:'',hora_fin:'',prescencial:false,virtual:false},
        viernes:{id_horario:0,tutor:0,estado:false,dias:'viernes',hora_inicio:'',hora_fin:'',prescencial:false,virtual:false},
        sabado:{id_horario:0,tutor:0,estado:false,dias:'sabado',hora_inicio:'',hora_fin:'',prescencial:false,virtual:false},
        domingo:{id_horario:0,tutor:0,estado:false,dias:'domingo',hora_inicio:'',hora_fin:'',prescencial:false,virtual:false},
        bloquear_boton: false
    }
},
methods:{
    llenar_horario(){
        const id = localStorage.getItem("Usuario")
        const path = this.url+"/HorariosTutorApi/?id="+id
        axios.get(path).then((response) => {
            //console.log(response.data)
            this.lunes=response.data[0]
            this.martes=response.data[1]
            this.miercoles=response.data[2]
            this.jueves=response.data[3]
            this.viernes=response.data[4]
            this.sabado=response.data[5]
            this.domingo=response.data[6]
        })
    },
    guardar_todo(){
        this.bloquear_boton = true
        const path = this.url+"/HorariosTutorApi/"
        axios.put(path,this.lunes).then((response) =>{ }).catch((error) => {console.log(error)})
        axios.put(path,this.martes).then((response) =>{ }).catch((error) => {console.log(error)})
        axios.put(path,this.miercoles).then((response) =>{ }).catch((error) => {console.log(error)})
        axios.put(path,this.jueves).then((response) =>{ }).catch((error) => {console.log(error)})
        axios.put(path,this.viernes).then((response) =>{ }).catch((error) => {console.log(error)})
        axios.put(path,this.sabado).then((response) =>{ }).catch((error) => {console.log(error)})
        axios.put(path,this.domingo).then((response) =>{ }).catch((error) => {console.log(error)})
        setTimeout(() => this.bloquear_boton = false, 4000);
        swal("Cambios guardados","Este horario se mostrara en la busqueda al estudiante.","success")

    }


},created: function(){
    this.llenar_horario()
}


}
</script>

<style>

</style>