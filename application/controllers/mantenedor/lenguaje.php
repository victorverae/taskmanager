<?php

class Lenguaje extends Controller {

	function Lenguaje()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('mantenedor/lenguaje/v_lenguaje');	
	}
}