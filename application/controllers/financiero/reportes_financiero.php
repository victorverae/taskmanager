<?php

class Reportes_financiero extends Controller {

	function reportes_financiero()
	{
		parent::Controller();	
		$this->load->helper("form");
	}
	
	function index()
	{
		$this->load->database();
		$this->load->library('table');
		$strFiltros = $this->get_filtros("transaccion");
		$strSQL = "SELECT * FROM transaccion ".$strFiltros;
		echo $strSQL;
		
		$query = $this->db->query($strSQL);
		$arrRep1 = $query->result_array();
		$arrDatRep1 = array();
		$this->table->set_heading('Descripcion', 'Fecha', 'Monto');
		foreach($arrRep1 as $arrDat){
			$this->table->add_row($arrDat['descripcion_transaccion'], $arrDat['fecha_transaccion'], $arrDat['monto_transaccion']);
		}	
		$arrDatos['reporte']['reporte1'] = $this->table->generate(); 
		
		$this->table->clear(); 
		$strSql = "select (select nombre_cuenta from cuenta where t.idcuenta = idcuenta) as cuenta, descripcion_transaccion, (select nombre_tipo_transaccion from tipo_transaccion where t.idtipo_transaccion = idtipo_transaccion) as tipo_transaccion, t.monto_transaccion from transaccion t where idusuario = 2";
		$query = $this->db->query($strSql);
		$arrRep2 = $query->result_array();
		$this->table->set_heading('Cuenta','Descripcion transaccion', 'Monto', 'Tipo transaccion');
		foreach($arrRep2 as $arrDat){
			$this->table->add_row($arrDat['cuenta'], $arrDat['descripcion_transaccion'], $arrDat['monto_transaccion'], $arrDat['tipo_transaccion']);
		}	
		$arrDatos['reporte']['reporte2'] = $this->table->generate(); 
		$arrDatos['anno'] = form_dropdown('anno', $this->get_anno(), isset($_POST['anno'])?$_POST['anno']:'2014');
		$arrDatos['mes'] = form_dropdown('mes', $this->get_mes(), isset($_POST['mes'])?$_POST['mes']:'01');
		$arrDatos['cuenta'] = form_dropdown('idcuenta', $this->get_cuenta(), isset($_POST['idcuenta'])?$_POST['idcuenta']:'');
		$this->load->view("financiero/reportes_financiero",$arrDatos);
	}
	function get_filtros($strTabla){
		$arrFiltro = "";
		//$arrFiltros['anno']['combo'] = "";
		$arrFiltros['transaccion']['anno'] = "";
		$arrFiltros['transaccion']['mes'] = "";
		$arrFiltros['transaccion']['idcuenta'] = "";
		$arrFiltros['transaccion']['idusuario'] = "";
		$arrFiltros['transaccion']['filtro'] = "";
		//print_r($arrFiltros);
		if(isset($_POST)){
			foreach ($arrFiltros as $strIndex => $arrValue) {
				foreach ($arrValue as $strIndex1 => $strValue) {
					if(isset($_POST[$strIndex1])){
						$arrFiltros[$strIndex][$strIndex1] = $_POST[$strIndex1];
						$arrFiltros[$strIndex]['filtro'] .= $arrFiltros[$strIndex]['filtro']!=''?" and ".$strIndex1."='".$_POST[$strIndex1]."'":" where ".$strIndex1."='".$_POST[$strIndex1]."'";
					}
				}
			}
		}
		return $arrFiltros[$strTabla]['filtro'];
	}
	function get_mes(){
		$arrMes = array();
		$arrMes[1]='Enero';
		$arrMes[2]='Febrero';
		$arrMes[3]='Marzo';
		$arrMes[4]='Abril';
		$arrMes[5]='Mayo';
		$arrMes[6]='Junio';
		$arrMes[7]='Julio';
		$arrMes[8]='Agosto';
		$arrMes[9]='Septiembre';
		$arrMes[10]='Octubre';
		$arrMes[11]='Noviembre';
		$arrMes[12]='Diciembre';
		return $arrMes;
	}
	
	function get_anno(){
		return array(2013=>2013,2014=>2014);	
	}
	
	function get_cuenta(){
		$query = $this->db->query("SELECT idcuenta,nombre_cuenta FROM cuenta");
		$arrDat = array();
		$arrDat[0] = "Seleccionar";
		foreach($query->result_array() as $arrDatos){
			$arrDat[$arrDatos['idcuenta']] = $arrDatos['nombre_cuenta'];
		}
		return $arrDat;		
	}
	
	function get_tipo_transaccion(){
		$query = $this->db->query("SELECT idtipo_transaccion,nombre_tipo_transaccion FROM tipo_transaccion");
		return $query->result_array();		
	}
}