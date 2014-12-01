<?php

class Menu_financiero extends Controller {

	function menu_financiero()
	{
		parent::Controller();	
		$this->load->helper("form");
	}
	
	function index()
	{
		$arrDatos['message'] = "";
		$this->load->view("financiero/menu/v_menu",$arrDatos);
	}
	
	function dashboard()
	{
		$arrDatos['message'] = "";
		$this->load->view("financiero/menu/v_dashboard",$arrDatos);
	}
	
	function getCuentas(){
		$this->load->database();
		$strSQL = "SELECT * FROM cuenta";
		$query = $this->db->query($strSQL);
		$arrRep['type'] = "select";
		$arrRep['text'] = "Cuenta";
		$arrRep['name'] = "cuenta";
		$arrRep['clase'] = "cuenta_class";
		$arrRep['id'] = "cuenta_id";
		$arrRep['data'] = $query->result_array();
		echo json_encode($arrRep);
	}
}