<?php
/*
 * SQL_GENERAL VERSION 1.1
 * FECHA CREACION: ABRIL 2010 VERSION 1.0
 * FECHA MODIFICACION: 22 ABRIL 2010 VERSION 1.1
 * FUNCIONES DINAMICAS:
 * -select
 * -update
 * -insert
 * -delete
 * -existen_datos
 * */
class Sql_general extends Model{
	function sql_general(){
		parent::Model();
	}
	function select($strTabla,$arrLlaves,$arrCampos,$bDebug=false,$arrConfig=array('prefijo'=>'','order'=>'','order_sufijo'=>''),$bRows=false){
		
		$this->load->database();
		$this->funciones->procedimientos_pre_consulta();
		$strSql = "select ".$arrConfig['prefijo']." ";
		$intE=0;
		foreach($arrCampos as $strCampo => $strValor){
			if($intE==0)
				$strSql .= $strValor;
			else
				$strSql .= " , ".$strValor;
			$intE++;
		}
		$strSql .= " from $strTabla ";
		$intE=0;
		if(sizeof($arrLlaves)>0)
			$strSql.=" where ";
		foreach($arrLlaves as $strCampo => $strValor){
			if($intE==0)
				$strSql .= " $strCampo = '".$this->db->escape_str($strValor)."'";
			else
				$strSql .= " and $strCampo = '".(int)$this->db->escape_str($strValor)."'";
			$intE++;
		}
		if($arrConfig['order']!='')
			$strSql.=" order by ".$arrConfig['order']." ".$arrConfig['order_sufijo']." ";
//		if($bDebug)
//			echo '<br>select '.$strTabla.' :'.$strSql.'<br>';
		$oQuery = $this->db->query($strSql);
		$arrResult = $oQuery->result_array();
		$this->db->close();
		if($bRows)
			return $arrResult;
		foreach($arrResult as $arrRow)
			return $arrRow;
		foreach($arrCampos as $strid=>$strCampo){
			$arrResult[$strCampo]='';
		}	
		return $arrResult;
	}
	
	function update( $strTabla, $arrLlaves, $arrCampos,$bDebug=false){
		$this->load->database();
		$this->funciones->procedimientos_pre_consulta();
		$strSql = "update $strTabla set ";
		$intI=0;
		foreach ($arrCampos as $strCampo => $strValor) {
			if($intI==0)
				$strSql .= $strCampo."='".$this->db->escape_str($strValor)."'";
			else
				$strSql .= ",".$strCampo."='".$this->db->escape_str($strValor)."'";
			$intI++;
		}
		$strSql.=" where ";
		$intE=0;
		foreach($arrLlaves as $strCampo => $strValor){
			if($intE==0)
				$strSql .= $strCampo."='".$this->db->escape_str((int)$strValor)."'";
			else
				$strSql .= "and ".$strCampo."='".(int)$this->db->escape_str((int)$strValor)."'";
			$intE++;
		}
//		if($bDebug)
//			echo '<br>update: '.$strSql;
		$this->db->query($strSql);
		$this->db->close();
	}
	function update_sin_comillas( $strTabla, $arrLlaves, $arrCampos,$bDebug=false){
		$this->load->database();
		$this->funciones->procedimientos_pre_consulta();
		$strSql = "update $strTabla set ";
		$intI=0;
		foreach ($arrCampos as $strCampo => $strValor) {
			if($intI==0)
				$strSql .= $strCampo."=".$strValor."";
			else
				$strSql .= ",".$strCampo."=".$strValor."";
			$intI++;
		}
		$strSql.=" where ";
		$intE=0;
		foreach($arrLlaves as $strCampo => $strValor){
			if($intE==0)
				$strSql .= $strCampo."=".$strValor."";
			else
				$strSql .= "and ".$strCampo."=".$strValor."";
			$intE++;
		}
//		if($bDebug)
//			echo '<br>update: '.$strSql;
		$this->db->query($strSql);
		$this->db->close();
	}
	function insert($strTabla, $arrLlaves, $arrCampos=array(),$bDebug=false,$bSolo_insert=false){
		$this->load->database();
		$strSql = "insert into $strTabla (";
		$intE=0;
		foreach($arrLlaves as $strCampo => $strValor){
			if($intE==0)
				$strSql .= $strCampo;
			else
				$strSql .= " , ".$strCampo;
			$intE++;
		}
		$strSql .=") values (";
		$intE=0;
		foreach($arrLlaves as $strCampo => $strValor){
			if($intE==0)
				$strSql .= "'".$this->db->escape_str((int)$strValor)."'";
			else
				$strSql .= " , '".(int)$this->db->escape_str((int)$strValor)."'";
			$intE++;
		}
		$strSql .=")";
		if(DBDEBUG)
			echo '<br>insert: '.$strSql;
		$this->db->query($strSql);
		$this->db->close();
	}
	function insert_sin_comillas($strTabla, $arrLlaves, $arrCampos=array(),$bDebug=false,$bSolo_insert=false){
		$this->load->database();
		$this->funciones->procedimientos_pre_consulta();
		$strSql = "insert into $strTabla (";
		$intE=0;
		foreach($arrLlaves as $strCampo => $strValor){
			if($intE==0)
				$strSql .= $strCampo;
			else
				$strSql .= " , ".$strCampo;
			$intE++;
		}
		$strSql .=") values (";
		$intE=0;
		foreach($arrLlaves as $strCampo => $strValor){
			if($intE==0)
				$strSql .= "".$strValor."";
			else
				$strSql .= " , ".$strValor."";
			$intE++;
		}
		$strSql .=")";
//		if($bDebug)
			//echo '<br>insert: '.$strSql;
		$this->db->query($strSql);
		if(!$bSolo_insert)
			$this->update_sin_comillas($strTabla,$arrLlaves,$arrCampos);
		$this->db->close();
	}
	function delete($strTabla, $arrLlaves,$bDebug=false){
		$this->load->database();
		$this->funciones->procedimientos_pre_consulta();
		$strSql = "delete ";
		$strSql .= " $strTabla where ";
		$intE=0;
		foreach($arrLlaves as $strCampo => $strValor){
			if($intE==0)
				$strSql .= " $strCampo = '".$this->db->escape_str($strValor)."'";
			else
				$strSql .= " and $strCampo = '".(int)$this->db->escape_str($strValor)."'";
			$intE++;
		}
//		if($bDebug)
			//echo '<br>delete: '.$strSql;
		$this->db->query($strSql);
		$this->db->close();	
	}	
	function existen_datos($strTabla, $arrLlaves){
		$this->load->database();
		$this->funciones->procedimientos_pre_consulta();
		$strSql = "select count(*) as cuenta";
		$strSql .= " from $strTabla where ";
		$intE=0;
		foreach($arrLlaves as $strCampo => $strValor){
			if($intE==0)
				$strSql .= " $strCampo = '".$this->db->escape_str($strValor)."'";
			else
				$strSql .= " and $strCampo = '".(int)$this->db->escape_str($strValor)."'";
			$intE++;
		}
		$oQuery = $this->db->query($strSql);
		$arrResult = $oQuery->result_array();
		$this->db->close();
		foreach($arrResult as $arrRow){
			if($arrRow['cuenta']>0)
				return true;
		}
		return false;
	}
}