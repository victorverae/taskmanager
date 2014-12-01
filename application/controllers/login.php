<?php

class Login extends Controller {

	function login()
	{
		parent::Controller();	
		$this->load->model('sql_usuario');
	}
	
	function index()
	{
		$this->load->view('principal/login/v_login');
	}
	
	function ingresar(){
		$arrUsuario = $this->sql_usuario->validar_usuario($_POST['username'],$_POST['pass']);
		if(sizeof($arrUsuario)>0){
			$this->session->set_userdata('perfil',$arrUsuario['idperfil_usuario']);
			$this->session->set_userdata('username',$_POST['username']);
			$this->session->set_userdata('idusuario',$arrUsuario['idusuario']);
			$this->redireccionar($arrUsuario);
		}else{
			$this->index();			
		}
	}
	function redireccionar($arrUsuario){
		if($arrUsuario['idperfil_usuario']=='1')
			redirect('gestor_tareas/mantenedor');
		else{
			redirect('gestor_tareas/tareas');
		}
	}
	function salir(){
		$this->session->sess_destroy();
		$this->index();
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */