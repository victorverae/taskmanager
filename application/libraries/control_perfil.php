<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Control_perfil {
	
	function control_perfil(){
		$this->CI =& get_instance();
	}
	function controlar_session(){
		$arrConfig = $this->get_configuracion();
		if(isset($arrConfig[$this->CI->uri->segment(2)]))
			if(!in_array($this->CI->session->userdata('perfil'),$arrConfig[$this->CI->uri->segment(2)]))
				redirect('login');
	}
	function get_configuracion(){
		$arrConfig = array(	'tareas'=>array('2','3'),
							'mantenedor'=>array('1')
							);
		return $arrConfig;
	}
	
}