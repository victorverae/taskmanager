<?php
class Tareas extends Controller {

	function tareas()
	{
		parent::Controller();
		$this->load->helper('form');
		$this->load->library('menu');
		//$this->load->library('session');
		$this->load->library('mantenedor_form');
		//verificar session en un futuro
		$this->load->library('control_perfil');
		$this->control_perfil->controlar_session();
	}
	
	function index()
	{
		$arrDatos['arrConfig'] 	= $this->mantenedor_form->get_config();
		$strTabla = $arrDatos['strTabla'] = "tarea";
		$this->load->database();
		$strSelect = "select idtarea,idprioridad,idtarea_padre,idtipotarea,nombre,fecha_creacion,fecha_entrega from ".$strTabla." where idusuario = ".$this->session->userdata('idusuario')." and idestado_tarea not in(3) order by fecha_entrega asc";
		$oQuery = $this->db->query($strSelect);
		$arrDatos['strAction'] = "gestor_tareas/tareas/edit";
		$arrDatos['arrList'] = $this->mantenedor_form->get_datos_listar($strTabla,$oQuery->result_array(),$arrDatos['arrConfig']);
		$this->load->view('gestor_tareas/tareas/v_listar',$arrDatos);
	}
	function edit(){
		$strTabla = $arrDatos['strTabla']	= "tarea";
		$arrConfig = $this->mantenedor_form->get_config();
		$arrConfig['idusuario'] = array('text'=>'Usuario','form_type'=>'hidden','por_defecto'=>$this->session->userdata('user'));
		$arrConfig['fecha_creacion'] = array('text'=>'Usuario','form_type'=>'hidden');
		$arrConfig['hora_creacion'] = array('text'=>'Usuario','form_type'=>'hidden');
		$arrConfig['des_tarea'] = array_merge($arrConfig['des_tarea'],array('extra'=>'disabled="disabled"'));
		$arrConfig['des_encargado'] = array_merge($arrConfig['des_tarea'],array('no_mostrar'=>'true'));
		$arrDatos['id'] = $_POST['id'];
		$arrCampos = $this->mantenedor_form->get_form_edit($strTabla,$arrConfig,$arrDatos['id']);
		$arrDatos['arrCampos'] = $arrCampos;
		$arrDatos['strAction'] = "gestor_tareas/tareas/edit";
		if(isset($_POST['enviar'])){
			$bInsert = $this->mantenedor_form->update($strTabla,$arrConfig,$arrDatos['id']);
			$this->load->view('alerts/v_insert_ok',$arrDatos);
		}else{
			$this->load->view('gestor_tareas/tareas/v_tareas_edit',$arrDatos);
		}
	}
	function listar(){
		$this->index();
	}
	function insertar()
	{
		$strTabla = "tarea";
		$arrConfig = $this->mantenedor_form->get_config();
		$arrConfig['idusuario'] = array('text'=>'Usuario','form_type'=>'hidden','por_defecto'=>$this->session->userdata('idusuario'));
		$arrConfig['idtarea_padre'] = array('text'=>'Tarea','form_type'=>'hidden','por_defecto'=>'');
		$arrCampos = $this->mantenedor_form->get_form($strTabla,$arrConfig);
		
		$arrDatos['arrCampos'] = $arrCampos;
		$arrDatos['strAction'] = "gestor_tareas/tareas/insertar";
		if(isset($_POST['enviar'])){
			$bInsert = $this->mantenedor_form->insert($strTabla,$arrConfig);
			$this->load->view('alerts/v_insert_ok',$arrDatos);
		}else{
			$this->load->view('gestor_tareas/mantenedor/v_mantenedor',$arrDatos);
		}

	}
}