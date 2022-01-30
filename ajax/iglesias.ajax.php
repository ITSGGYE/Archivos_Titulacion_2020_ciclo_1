<?php

require_once "../controladores/iglesias.controlador.php";
require_once "../modelos/iglesias.modelo.php";

class AjaxIglesias{

	/*=============================================
	EDITAR IGLESIA
	=============================================*/	

	public $idIglesia;

	public function ajaxEditarIglesia(){

		$item = "id";
		$valor = $this->idIglesia;

		$respuesta = ControladorIglesias::ctrMostrarIglesias($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR IGLESIA
=============================================*/	

if(isset($_POST["idIglesia"])){

	$iglesia = new AjaxIglesias();
	$iglesia -> idIglesia = $_POST["idIglesia"];
	$iglesia -> ajaxEditarIglesia();

}

