<?php
class Sql_categoria extends Model{
	function sql_categoria(){
		parent::Model();
	}
	function get_categoria($strIdCategoria_padre){
		$this->load->database();
		$strSql = "select * from categoria where idcategoria_padre = ".$strIdCategoria_padre;
		$oQuery = $this->db->query($strSql);
		$arrResult = $oQuery->result_array();
		$this->db->close();
		return $arrResult;
	}
	function get_categoria_combo($strIdCategoria_padre){
		$this->load->database();
		$strSql = "select * from categoria where idcategoria_padre = ".$strIdCategoria_padre;
		$oQuery = $this->db->query($strSql);
		$arrResult = $oQuery->result_array();
		$this->db->close();
		$arrCombo = array('','Seleccionar');
		foreach($arrResult as $arrRow){
			$arrCombo[$arrRow['idcategoria']] = $arrRow['nombre_categoria'];					
		}
		return $arrCombo;
	}
}