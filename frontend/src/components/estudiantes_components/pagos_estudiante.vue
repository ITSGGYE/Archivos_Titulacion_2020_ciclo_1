<template>
	<div id="PagosProfesor">

		<div class="row justify-content-center">
			<!--
			<div class="col-7 px-5" v-for="(tutor,i) in lista_estudiante" :key="i">		
				<div class="card shadow p-3" >
					    <div class="row no-gutters">
					        <div class="col-md-4">
					        	<img width="200px" class="img-fluid float-left" :src="'http://localhost:8000'+tutor.id_tutor.id_usuario.id_persona.foto"  alt="Sin imagen">
					        </div>
					        <div class="col-md-4">
					            <div class="card-body my-4">
					                <h5 class="card-title float-left">
					                	<strong>
					                		Nombre: 
										</strong>
										{{tutor.id_tutor.id_usuario.id_persona.nombres}}	
					                </h5>
					                <h5 class="card-title float-left"> <strong>Correo: </strong> {{tutor.id_tutor.id_usuario.correo}} </h5> <br>
                        			<h5 class="card-title float-left"> <strong>Identificacion: </strong> {{tutor.id_tutor.id_usuario.id_persona.identificacion}}</h5>
                    
					            </div>
					        </div>
					        <div class="col-md-4">
					        	<div class="card-body">
					        		<button class=" my-4 btn bg-naranja lift shadow  text-light">
					        			<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-wallet2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  										<path fill-rule="evenodd" d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
										</svg>
					        			 &nbsp;
					        			Realizar pagos por los servicios
					        		</button>
					        	</div>
					        </div>
					    </div>
				</div>
				<br><br>
				-->		
			</div>

			
		</div>



	</div>
</template>

<script>
	import axios from "axios"
	export default{
		name: 'PagosProfesor',
		components: {},
		data() {
			return {
            	lista_estudiante : [],
            	tutor : 0
			}
		},
		methods: {


        listar_estudiante(){
            axios.get("http://localhost:8000/AsignarTutor/?id_usuario="+this.tutor).then((response) =>{
                this.lista_estudiante = response.data
                //console.log(this.lista_estudiante)
            }).catch((err) => {
                console.log(err);
            });
        }

	},
	created: function(){
		this.tutor = localStorage.getItem('Usuario');
		this.listar_estudiante();
	}

}
</script>

<style>
	
</style>