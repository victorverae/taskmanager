<?php

class Categoria extends Controller {

	function categoria()
	{
		parent::Controller();	
	}
	
	function index()
	{
		//rescata de la bd
		$this->load->database();
		$query = $this->db->query('SELECT * FROM categoria');
		$arrDatos['arrResult'] = $query->result_array();	
		$this->load->view('mantenedor/categoria/v_categoria',$arrDatos);
	}
}