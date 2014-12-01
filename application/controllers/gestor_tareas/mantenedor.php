<?php
class Mantenedor extends Controller {

	function mantenedor()
	{
		parent::Controller();
		$this->load->helper('form');
		$this->load->library('menu');
		$this->load->library('session');
		$this->load->library('mantenedor_form');
		$this->load->library('template');
		//verificar session en un futuro
		$this->load->library('control_perfil');
		$this->control_perfil->controlar_session();
	}
	function index(){
		$this->listar_tablas();
	}
	function insertar()
	{
		$strTabla = $this->get_tabla();
		$arrConfig = $this->get_arrCampos();
		$arrCampos = $this->mantenedor_form->get_form($strTabla,$arrConfig);
		$arrDatos['arrCampos'] = $arrCampos;
		$arrDatos['strAction'] = "gestor_tareas/mantenedor/insertar";
		if(isset($_POST['enviar'])){
			$bInsert = $this->mantenedor_form->insert($strTabla,$arrConfig);
			$strBody = $this->load->view('alerts/v_insert_ok',$arrDatos,true);
		}else{
			$strBody = $this->load->view('gestor_tareas/mantenedor/v_mantenedor',$arrDatos,true);
		}
		
		$this->template->set_body($strBody);
		$this->template->template_init();
	}

	function listar(){
		$arrDatos['arrConfig'] 	= $this->get_arrCampos();
		$strTabla 	= $this->get_tabla();
		$this->load->database();
		//$strSelect = "select idtarea,idtarea_padre,nombre_tarea,fecha_creacion from ".$strTabla." order by fecha_creacion asc";
		$strSelect = "select * from ".$strTabla."";
		$oQuery = $this->db->query($strSelect);
		$arrDatos['strAction'] = "gestor_tareas/mantenedor/edit";
		$arrDatos['arrList'] = $this->mantenedor_form->get_datos_listar($strTabla,$oQuery->result_array(),$this->get_arrCampos());
		$strBody = $this->load->view('gestor_tareas/mantenedor/v_listar',$arrDatos,true);
		$this->template->set_body($strBody);
		$this->template->template_init();
	}
	function get_tabla(){
		return $this->session->userdata('tabla');
	}

	function edit(){
		$strTabla = $arrDatos['strTabla'] = $this->get_tabla();
		$arrConfig = $this->get_arrCampos();
		$arrDatos['id'] = $_POST['id'];
		$arrCampos = $this->mantenedor_form->get_form_edit($strTabla,$arrConfig,$arrDatos['id']);
		$arrDatos['arrCampos'] = $arrCampos;
		$arrDatos['strAction'] = "gestor_tareas/mantenedor/edit";
		$strBody = "";
		if(isset($_POST['enviar'])){
			$bInsert = $this->mantenedor_form->update($strTabla,$arrConfig,$arrDatos['id']);
			$strBody = $this->load->view('alerts/v_insert_ok',$arrDatos,true);
		}else{
			$strBody = $this->load->view('gestor_tareas/mantenedor/v_mantenedor_edit',$arrDatos,true);
		}
		$this->template->set_body($strBody);
		$this->template->template_init();
	}

	function get_arrCampos(){
		return $this->mantenedor_form->get_config();
	}
	
	function listar_tablas(){
		$this->load->database();
		$oQuery = $this->db->query("SHOW TABLES");
		$arrResult = $oQuery->result_array();
		$arrDatos['arrList'] = $arrResult;
		$arrDatos['strAction'] = "gestor_tareas/mantenedor/elegir_tabla";
		$strBody = $this->load->view('gestor_tareas/mantenedor/v_listar_tabla',$arrDatos,true);
		$this->template->set_body($strBody);
		$this->template->template_init();
	}
	function elegir_tabla(){
		$this->session->set_userdata('tabla',$_POST['tabla']);
		$this->listar();
	}
}