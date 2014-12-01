<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class template {
	
	var $strTemplate = 'template/temp1/template.html';
	var $strHead = "encabezado";
	var $strBody = "cuerpo";
	var $strFoot = "Pie";
	var $strMenu = "Menu";
	
	function template(){
		$this->CI =& get_instance();
		$this->CI->load->library('parser');
	}
	
	function template_init(){
		$arrDatos['body'] = $this->strBody;
		$arrDatos['head'] = $this->strHead;
		$arrDatos['foot'] = $this->strFoot;
		$arrDatos['menu'] = $this->CI->load->view('template/temp1/temp_menu.php','',true);
		$this->CI->parser->parse($this->strTemplate, $arrDatos);
	}
	
	function load_body(){
		
	}
	
	function load_foot(){
	
	}
	
	function set_body($strBody){
		$this->strBody = $strBody;
	}
	function set_head($strHead){
		$this->strHead = $strHead;
	}
	function set_foot($strFoot){
		$this->strFoot = $strFoot;
	}
	function set_template($strTemplate){
		$this->strTemplate = $strTemplate;
	}
	function set_menu($strMenu){
		$this->strMenu = $strMenu;
	}
}
