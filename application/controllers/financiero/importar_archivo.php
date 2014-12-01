<?php

class Importar_archivo extends Controller {

	function importar_archivo()
	{
		parent::Controller();	
		$this->load->helper("form");
	}
	
	function index()
	{
		$arrDatos['message'] = "";
		$this->load->view("financiero/importar_archivo",$arrDatos);
	}
	
	function upload(){
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'csv';
		$config['file_name'] = "archivo".(date("d-m-Y-i-s")).".csv";
//		$config['max_size']	= '100';
//		$config['max_width']  = '1024';
//		$config['max_height']  = '768';

		$this->load->library('upload', $config);
		print_r($this->upload->data());
		$arrData = $this->upload->data();
		if ( ! $this->upload->do_upload())
		{
			echo "paso:";
			$arrDatos['message'] = array('error' => $this->upload->display_errors());
			print_r($arrDatos['message']);
			$this->load->view('financiero/importar_archivo', $arrDatos);
		}
		else
		{
			echo "error:";
			$arrDatos['message'] = array('upload_data' => $this->upload->data());
			$this->procesar_archivo($arrData);
			$this->load->view('financiero/importar_archivo', $arrDatos);
		}
	}
	
	function procesar_archivo($arrData){
		$file = fopen($arrData['full_path'], "r") or exit("Unable to open file!");
		//Output a line of the file until the end is reached
		$cont = 0;
		$arrCampos = array();
		$arrDatos = array();
		while(!feof($file))
		{
			$strLinea = fgets($file);
			if(trim($strLinea)!=''){
				$arrLinea = explode(";",$strLinea);
				
				foreach($arrLinea as $strIndice => $strValor){
					if($cont == 0)
						$arrCampos[$strIndice] = $strValor;
					else
						$arrDatos[$cont][trim($arrCampos[$strIndice])] = $strValor;	
				}
				$cont++;
			}
		}
		
		//print_r($arrCampos);
		//print_r($arrDatos);
		fclose($file);
		$this->insertar_datos($arrCampos, $arrDatos);
	}
	function insertar_datos($arrCampos, $arrDatos){
		//idtransaccion 	idusuario 	idtipo_transaccion 	idcuenta 	idbeneficiario 	idforma_pago 	fecha_transaccion 	monto_transaccion 	descripcion_transaccion 	dia_pago 	monto_presupuestado 	cuota_actual 	total_cuotas 	fecha_inicio_cuotas 	hora_transaccion
		$strSqlCampos = "INSERT INTO transaccion (idusuario";
		$strSqlValores = ")values(2";
		$this->load->database();
		foreach($arrCampos as $strIndice => $strValor){
			$strSqlCampos.=",".$strValor;
		}
		
		foreach($arrDatos as $arrDat){
			$strSqlValoresTemp = "";
			foreach($arrDat as $strIndice => $strValor){
				if($strIndice == "fecha_transaccion"){
					if($strValor!='')
						$strSqlValoresTemp.=",STR_TO_DATE('".$strValor."','%d/%m/%Y')";
					else
						$strSqlValoresTemp.= ",''";
				}else
					$strSqlValoresTemp.=",'$strValor'";	
			}
			$this->db->query($strSqlCampos.$strSqlValores.$strSqlValoresTemp.")");
			//$this->db->query($strSql."(2,'".$arrDat['descripcion_transaccion']."','".$arrDat['monto_transaccion']."',STR_TO_DATE('".$arrDat['fecha_transaccion']."','%d/%m/%Y'))");
		}
//		foreach($arrDatos as $arrDat){
//			$data = array(
//               'idusuario' => '2',
//               'descripcion_transaccion' => $arrDat['descripcion_transaccion'],
//               'monto_transaccion' => $arrDat['monto_transaccion'],
//				'fecha_transaccion' => "STR_TO_DATE('".$arrDat['fecha_transaccion']."','%d/%m/%Y')" 
//            );
//
//		$this->db->insert('transaccion', $data); 
//		
		//$this->db->query("SHOW TABLES");
		//}
	}
}