<?php
class Sql_usuario extends Model{
	function sql_usuario(){
		parent::Model();
	}
	function validar_usuario($strUsuario,$strPass){
		$this->load->database();
		$strSql = "select * from usuario u, usuario_perfil up where u.username = '".$strUsuario."' and u.idusuario = up.idusuario";
		$oQuery = $this->db->query($strSql);
		$arrResult = $oQuery->result_array();
		$this->db->close();
		foreach ($arrResult as $arrRow) {
			if(trim($arrRow['pass']) == trim($strPass))
				return $arrRow;
			return array();	
		}
		return array();
	}
	
	function get_perfil($strUsuario){
		$this->load->database();
		$strSql = "select * from usuario where username = '".$strUsuario."'";
		$oQuery = $this->db->query($strSql);
		$arrResult = $oQuery->result_array();
		$this->db->close();
		foreach ($arrResult as $arrRow) {
			if(trim($arrRow['pass']) == trim($strPass))
				return true;
			return false;	
		}
		return false;
	}
}
	