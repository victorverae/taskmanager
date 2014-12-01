<?php

class Insert_maps extends Controller {

	function insert_maps()
	{
		parent::Controller();	
		$this->load->helper("form");
	}
	
	function index()
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM tipo_ubicacion");
		
		foreach($query->result_array() as $arrRow){
			$arrTipo[$arrRow["idtipo_ubicacion"]]=$arrRow["nombre_tipo_ubicacion"];
		}
		$arrDatos["arrTipo"] = $arrTipo; 

		print_r($_POST);
		if(isset($_POST["guardar"])){
			$query = $this->db->query("insert into ubicacion (idtipo_ubicacion,latitud,longitud,nombre_ubicacion)values(".$_POST["tipo"].",'".$_POST["latitud"]."','".$_POST["longitud"]."','".$_POST["texto"]."')");
		}
		$this->load->view("maps/v_insert_map",$arrDatos);
	}
}