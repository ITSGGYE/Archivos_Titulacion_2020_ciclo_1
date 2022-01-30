<?php

class ControladorIglesias{

	/*=============================================
	CREAR IGLESIAS
	=============================================*/

	static public function ctrCrearIglesia(){

		if(isset($_POST["nuevaIglesia"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaIglesia"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"])){

			   	$tabla = "iglesias";

			   	$datos = array("nombre"=>$_POST["nuevaIglesia"],
					           "email"=>$_POST["nuevoEmail"],
					           "telefono"=>$_POST["nuevoTelefono"],
					           "direccion"=>$_POST["nuevaDireccion"]);

			   	$respuesta = ModeloIglesias::mdlIngresarIglesia($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La iglesia ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "iglesias";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La iglesia no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "iglesias";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR IGLESIAS
	=============================================*/

	static public function ctrMostrarIglesias($item, $valor){

		$tabla = "iglesias";

		$respuesta = ModeloIglesias::mdlMostrarIglesias($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR IGLESIA
	=============================================*/

	static public function ctrEditarIglesia(){

		if(isset($_POST["editarIglesia"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarIglesia"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])){

			   	$tabla = "iglesias";

			   	$datos = array("id"=>$_POST["idIglesia"],
			   				   "nombre"=>$_POST["editarIglesia"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"]);

			   	$respuesta = ModeloIglesias::mdlEditarIglesia($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La iglesia ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "iglesias";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La iglesia no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "iglesias";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR IGLESIA
	=============================================*/

	static public function ctrEliminarIglesia(){

		if(isset($_GET["idIglesia"])){

			$tabla ="iglesias";
			$datos = $_GET["idIglesia"];

			$respuesta = ModeloIglesias::mdlEliminarIglesia($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La iglesia ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "iglesias";

								}
							})

				</script>';

			}		

		}

	}

}
