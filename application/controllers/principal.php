<?php

class Principal extends Controller {

	function principal()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('principal/index');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */