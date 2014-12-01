<?php

class Locacion extends Controller {

	function locacion()
	{
		parent::Controller();	
	}
	
	function index()
	{
		//rescata de la bd
		$this->load->database();
		$query = $this->db->query('SELECT * FROM locacion');
		$arrDatos['arrResult'] = $query->result_array();	
		$this->load->view('mantenedor/locacion/v_locacion',$arrDatos);
	}
}