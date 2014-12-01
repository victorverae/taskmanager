<?php

class Maps extends Controller {

	function maps()
	{
		parent::Controller();	
	}
	
	function index()
	{
		//rescata de la bd
		$this->load->database();
		$query = $this->db->query('SELECT * FROM ubicacion');
		$arrDatos['arrResult'] = $query->result_array();	
		$this->load->view('maps/v_map1',$arrDatos);
	}
}