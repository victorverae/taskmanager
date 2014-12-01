<?php
class Recurso extends Controller {

	function recurso()
	{
		parent::Controller();
		$this->load->helper('form');
		$this->load->library('menu');
		//$this->load->library('session');
		$this->load->library('mantenedor_form');
		//verificar session en un futuro
		$this->load->library('control_perfil');
		$this->control_perfil->controlar_session();
		$this->load->model('sql_categoria');
	}
	
	function index()
	{
		$arrDatos['arrConfig'] 	= $this->mantenedor_form->get_config();
		$arrDatos['arrCategoriaPrincipal'] = $this->sql_categoria->get_categoria_combo("0");
		$arrCat = array(0=>'cat_0',1=>'cat_1',2=>'cat_2');
		$strCatHijo = "";
		foreach($arrCat as $strId => $strValor){
			if((isset($_POST['cat_'.($strId-1)]) && $_POST['cat_'.($strId-1)]!='' ) or $strValor=='cat_0'){
				$strSelPost = isset($_POST[$strValor])?$_POST[$strValor]:"";
				$strCatPadre = "0";
				if($strValor!='cat_0')
					$strCatPadre = $_POST['cat_'.($strId-1)];
				$arrCat = $this->sql_categoria->get_categoria_combo($strCatPadre);
				$strCatHijo .= "<tr><th>Categoria</th><td>".form_dropdown('cat_'.$strId,$arrCat,$strSelPost,'onchange="document.forms[0].submit();"')."</td></tr>";
			}
		}
		$arrDatos['strCatHijo'] = $strCatHijo;
		$arrDatos['strAction'] = "gestion_conocimiento/recurso/index";
		
		$arrDatos['arrList'] = "";
		$this->load->view('gestion_conocimiento/v_listar',$arrDatos);
	}
	
	function arbol(){
		$arrCategoriaPrincipal = $this->sql_categoria->get_categoria("0");
		$strArbol = "<ul>";
		foreach($arrCategoriaPrincipal as $arrRow){
			$strArbol .= "<li>".$arrRow['nombre_categoria'];
			$arrHijo1 = $this->sql_categoria->get_categoria($arrRow['idcategoria']);
			if(sizeof($arrHijo1)>0){
				$strArbol .= "<ul>";
				foreach($arrHijo1 as $arrRow1){
					$strArbol .= "<li>".$arrRow1['nombre_categoria']."";
					$arrHijo2 = $this->sql_categoria->get_categoria($arrRow1['idcategoria']);
					if(sizeof($arrHijo2)>0){
						$strArbol .= "<ul>";
						foreach($arrHijo2 as $arrRow2){
							$strArbol .= "<li>".$arrRow2['nombre_categoria']."</li>";
						}
						$strArbol .= "</ul>";
					}
				}
				$strArbol .= "</li></ul>";
			}
			$strArbol .="</li>";			
		}
		$strArbol .= "</ul>";
		$arrDatos['strCatHijo'] = "";
		$arrDatos['strArbol'] = $strArbol;
		$arrDatos['strAction'] = "gestion_conocimiento/recurso/index";
		$arrDatos['arrList'] = "";
		$this->load->view('gestion_conocimiento/v_listar',$arrDatos);
	}
	function get_hijo($idCategoria){
	
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