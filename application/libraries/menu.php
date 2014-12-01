<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class menu {
	var $arrMenu = array();
		
	function menu($arrMenu=array()){
			$this->arrMenu = $arrMenu; 		
		}
	function get_menu1(){
		$CI =& get_instance();
		$arrMenu = array('mantenedor/categoria'=>'categoria',
						'mantenedor/lenguaje'=>'lenguaje');
		$strMenu = "<ul><li>mantenedores</li><li>";
		$strMenu .= "<ul>";
		foreach($arrMenu as $strId =>$strValor){
			$strMenu .= "<li>".anchor($strId,$strValor)."</li>";
		}
		$strMenu .= "</ul></li></ul>";
		return $strMenu; 
	}
	function get_menu(){
		$this->CI =& get_instance();
		$strMenu = "";
		if(sizeof($this->arrMenu)>0){
			foreach($this->arrMenu as $strId => $strValor)
				$strMenu = anchor($this->CI->uri->segment(1)."/".$this->CI->uri->segment(2)."/$strId",$strValor);
		}else{
			$strMenu 	= anchor($this->CI->uri->segment(1)."/".$this->CI->uri->segment(2)."/index",'Home');
			$strMenu 	.= '<br>'.anchor($this->CI->uri->segment(1)."/".$this->CI->uri->segment(2)."/listar",'LISTADO');
			$strMenu 	.= '<br>'.anchor($this->CI->uri->segment(1)."/".$this->CI->uri->segment(2)."/insertar",'INSERTAR');
			$strMenu 	.= '<br>'.anchor("login/salir",'Terminar Sesion');
		}
		return $strMenu; 
	}
	  
}