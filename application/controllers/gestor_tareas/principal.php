<?php

class Principal extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->scaffolding('proyecto');	
	}
	
	function index()
	{
		//echo anchor('gestor_tareas/mantenedor','MANTENCION');
		echo '<br>'.anchor('gestor_tareas/tareas','MODULO TAREAS');
		//rescata de la bd
//		$this->load->database();
//		$query = $this->db->query('SELECT * FROM categoria');
//		$arrDatos['arrResult'] = $query->result_array();	
//		$this->load->view('mantenedor/categoria/v_categoria',$arrDatos);
	}
}