<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Mantenedor_form {
	
	function mantenedor_form(){
		$this->CI =& get_instance();
	}
	
	function get_form($strTabla,$arrConfig){
		//rescata de la bd
		$this->CI->load->database();
		$oQuery = $this->CI->db->query("SHOW COLUMNS FROM ".$strTabla);
		$arrCampos = array(); 
		foreach($oQuery->result_array() as $strId =>  $arrRow){
			if(strtoupper($arrRow['Key'])!="PRI"){
				$arrCampos[$strId]['campo'] = isset($arrConfig[$arrRow['Field']])?$arrConfig[$arrRow['Field']]['text']:$arrRow['Field'];
				$arrCampos[$strId]['llave'] = $arrRow['Key'];
				$arrCampos[$strId]['tipo'] = $arrRow['Type'];
				$arrDescompone = explode(" ",str_replace("("," ",str_replace(")"," ",$arrRow['Type'])));
				$strValor = isset($_POST[$arrRow['Field']])?$_POST[$arrRow['Field']]:"";
				if(isset($arrConfig[$arrRow['Field']]['form_type'])){
					if($arrConfig[$arrRow['Field']]['form_type']=='hidden'){
						if(isset($arrConfig[$arrRow['Field']]['por_defecto'])){
							$arrCampos[$strId]['hidden'] = form_hidden($arrRow['Field'],$arrConfig[$arrRow['Field']]['por_defecto']);
						}else{
							$arrCampos[$strId]['hidden'] = form_hidden($arrRow['Field'],$strValor);	
						}
						$arrCampos[$strId]['html'] = '';
						
					}
				}else{
					if(isset($arrConfig[$arrRow['Field']]['externo'])){
						
						$arrCampos[$strId]['html'] = form_dropdown($arrRow['Field'],$this->get_datos_externo($arrConfig[$arrRow['Field']]['externo']));
					}else{
						if(trim($arrDescompone[0])=="int")
							$arrCampos[$strId]['html'] = form_input($arrRow['Field'],$strValor,'maxlength="'.$arrDescompone[1].'"');
						else if($arrDescompone[0]=="varchar")
							$arrCampos[$strId]['html'] = form_input($arrRow['Field'],$strValor,'maxlength="'.$arrDescompone[1].'"');
						else if($arrDescompone[0]=="text")
							$arrCampos[$strId]['html'] = form_textarea($arrRow['Field'],$strValor);
						else if($arrDescompone[0]=="date")
							$arrCampos[$strId]['html'] = form_input($arrRow['Field'],$strValor,'style="width:100px;" readonly="readonly" class="campo date_input"');
						else if($arrDescompone[0]=="time")
							$arrCampos[$strId]['html'] = form_dropdown($arrRow['Field'],$this->get_array_time());
						else
							$arrCampos[$strId]['html'] = "";
					}
				}	
			}
		}
		return $arrCampos;	
	}
	function get_form_edit($strTabla,$arrConfig,$strId){
		//rescata de la bd
		$this->CI->load->database();
		$oQuery = $this->CI->db->query("SHOW COLUMNS FROM ".$strTabla);
		$oQuerySel = $this->CI->db->query("select * FROM ".$strTabla." where ".$arrConfig[$strTabla]['primary_key']."=".$strId);
		$arrDatos = $oQuerySel->result_array();
		if(isset($arrDatos[0]))
			$arrDatos = $arrDatos[0];
		$arrCampos = array(); 
		foreach($oQuery->result_array() as $strId =>  $arrRow){
			if(strtoupper($arrRow['Key'])!="PRI"){
				$arrCampos[$strId]['campo'] = isset($arrConfig[$arrRow['Field']])?$arrConfig[$arrRow['Field']]['text']:$arrRow['Field'];
				$arrCampos[$strId]['llave'] = $arrRow['Key'];
				$arrCampos[$strId]['tipo'] = $arrRow['Type'];
				$arrDescompone = explode(" ",str_replace("("," ",str_replace(")"," ",$arrRow['Type'])));
				$strValor = isset($_POST[$arrRow['Field']])?$_POST[$arrRow['Field']]:$arrDatos[$arrRow['Field']];
				$strExtra = isset($arrConfig[$arrRow['Field']]['extra'])?$arrConfig[$arrRow['Field']]['extra']:"";
				$bNoMostrar = isset($arrConfig[$arrRow['Field']]['no_mostrar'])?true:false;				
				
				if(!$bNoMostrar){
					if(isset($arrConfig[$arrRow['Field']]['form_type'])){
						if($arrConfig[$arrRow['Field']]['form_type']=='hidden')
							$arrCampos[$strId]['hidden'] = form_hidden($arrRow['Field'],$strValor);
							$arrCampos[$strId]['html'] = '';
					}else{
						if(isset($arrConfig[$arrRow['Field']]['externo'])){
							
							$arrCampos[$strId]['html'] = form_dropdown($arrRow['Field'],$this->get_datos_externo($arrConfig[$arrRow['Field']]['externo']),$strValor,$strExtra);
						}else{
							if(trim($arrDescompone[0])=="int")
								$arrCampos[$strId]['html'] = form_input($arrRow['Field'],$strValor,'maxlength="'.$arrDescompone[1].'" '.$strExtra);
							else if($arrDescompone[0]=="varchar")
								$arrCampos[$strId]['html'] = form_input($arrRow['Field'],$strValor,'maxlength="'.$arrDescompone[1].'" '.$strExtra);
							else if($arrDescompone[0]=="text")
								$arrCampos[$strId]['html'] = form_textarea($arrRow['Field'],$strValor,$strExtra);
							else if($arrDescompone[0]=="date")
								$arrCampos[$strId]['html'] = form_input($arrRow['Field'],$strValor,'style="width:100px;" readonly="readonly" class="campo date_input" '.$strExtra);
							else if($arrDescompone[0]=="time"){
								if($strValor[0]=='0')
									$strValor[0] = '';
								$arrCampos[$strId]['html'] = form_dropdown($arrRow['Field'],$this->get_array_time(),trim($strValor),$strExtra);
							}
							else
								$arrCampos[$strId]['html'] = "";
						}
					}
				}else{
					$arrCampos[$strId]['html'] = "";
				}	
			}
		}
		return $arrCampos;	
	}
	function get_datos_externo($arrExterno){
		$oQuery = $this->CI->db->query("select ".$arrExterno['llave'].",".$arrExterno['descripcion']." FROM ".$arrExterno['tabla']);
		$arrResult = $oQuery->result_array();
		$arrReturn = array();
		$arrReturn[''] = 'Seleccionar';
		foreach($arrResult as $arrRow){
			$arrReturn[$arrRow[$arrExterno['llave']]] = $arrRow[$arrExterno['descripcion']]; 	
		}
		return $arrReturn; 
	}
	function get_glosa_dato_externo($arrExterno,$strId){
		if($strId!=''){
			$oQuery = $this->CI->db->query("select ".$arrExterno['descripcion']." FROM ".$arrExterno['tabla']." where ".$arrExterno['llave']."=$strId");
			$arrResult = $oQuery->result_array();
			foreach($arrResult as $arrRow){
				return $arrRow[$arrExterno['descripcion']]; 	
			}
		}
		return ""; 
	}
	function get_datos_listar($strTabla,$arrList,$arrConfig){
		$arrReturn = array();
		foreach($arrList as $arrRow){
			foreach($arrRow as $strId => $strValor){
				if((isset($arrConfig[$strId]['externo']) && $strTabla!=$arrConfig[$strId]['externo']['tabla']) or (isset($arrConfig[$strId]['externo']['excluir_regla']))){
					$arrRow[$strId] = $this->get_glosa_dato_externo($arrConfig[$strId]['externo'],$strValor);
				}
			}
			$arrReturn[] = $arrRow;
		}	
		return $arrReturn;
	}
	
	//obtiene el o los campos que es llave primaria en la tabla
	function get_primary_key($strTabla){
		$this->CI->load->database();
		$oQuery = $this->CI->db->query("SHOW COLUMNS FROM ".$strTabla);
		$strLlave = "";
		foreach($oQuery->result_array() as $strId =>  $arrRow){
			if(strtoupper($arrRow['Key'])=="PRI"){
				$strLlave = $arrRow['Field']; 		
			}
		}
		return $strLlave;
	}
	
	function insert($strTabla, $arrConfig){
		$this->CI->load->database();
		$oQuery = $this->CI->db->query("SHOW COLUMNS FROM ".$strTabla);
		$data = array();
		foreach($oQuery->result_array() as $strId =>  $arrRow){
			if(strtoupper($arrRow['Key'])=="PRI"){
				$dataTemp = array($arrRow['Field']=>0);
			}else{
				$arrDescompone = explode(" ",str_replace("("," ",str_replace(")"," ",$arrRow['Type'])));
				if($_POST[$arrRow['Field']]!=''){
					if($arrDescompone[0]=="date"){
						$dateToMySQL = "";
						$tDate = strtotime($_POST[$arrRow['Field']]);
						$dateToMySQL = date("Y-m-d",$tDate);
						$dataTemp = array($arrRow['Field']=>$dateToMySQL);
					}
					else{
						$dataTemp = array($arrRow['Field']=>$_POST[$arrRow['Field']]);
					}
				}	
			}
			$data = array_merge($data,$dataTemp);
		}
		return $this->CI->db->insert($strTabla, $data);
	}
	function update($strTabla, $arrConfig,$strIdentificador){
		$this->CI->load->database();
		$oQuery = $this->CI->db->query("SHOW COLUMNS FROM ".$strTabla);
		$data = array();
		foreach($oQuery->result_array() as $strId =>  $arrRow){
			if(strtoupper($arrRow['Key'])=="PRI" or $arrConfig[$strTabla]['primary_key']==$arrRow['Field']){
				//$dataTemp = array($arrRow['Field']=>0);
			}else{
				$arrDescompone = explode(" ",str_replace("("," ",str_replace(")"," ",$arrRow['Type'])));
				$dataTemp = array();
				
				if(isset($_POST[$arrRow['Field']]) && $_POST[$arrRow['Field']]!=''){
					if($arrDescompone[0]=="date"){
						$dateToMySQL = "";
						$tDate = strtotime($_POST[$arrRow['Field']]);
						$dateToMySQL = date("Y-m-d",$tDate);
						$dataTemp = array($arrRow['Field']=>$dateToMySQL);
					}
					else{
						$dataTemp = array($arrRow['Field']=>$_POST[$arrRow['Field']]);
					}
				}
				$data = array_merge($data,$dataTemp);	
			}
			
		}
		$this->CI->db->where($arrConfig[$strTabla]['primary_key'], $strIdentificador);
		return $this->CI->db->update($strTabla, $data);
	}
	function get_array_time(){
		$arrHora = array();//array(''=>'Seleccionar');
		for($intI=8;$intI<=22;$intI++){
			$a = $intI;
			$arrHoraTemp = array(
				$a.':0:00'=>$a.':00',
				$a.':10:00'=>$a.':10',
				$a.':15:00'=>$a.':15',
				$a.':20:00'=>$a.':20',
				$a.':25:00'=>$a.':25',
				$a.':30:00'=>$a.':30',
				$a.':35:00'=>$a.':35',
				$a.':40:00'=>$a.':40',
				$a.':45:00'=>$a.':45',
				$a.':50:00'=>$a.':50',
				$a.':55:00'=>$a.':55'
			);
			
			$arrHora = array_merge($arrHora,$arrHoraTemp);
		}
		/*
		$arrHoraTemp = array(
				'0:0:00'=>'00:00',
				'0:10:00'=>'00:10',
				'0:15:00'=>'00:15',
				'0:20:00'=>'00:20',
				'0:25:00'=>'00:25',
				'0:30:00'=>'00:30',
				'0:35:00'=>'00:35',
				'0:40:00'=>'00:40',
				'0:45:00'=>'00:45',
				'0:50:00'=>'00:50',
				'0:55:00'=>'00:55'
			);
		$arrHora = array_merge($arrHora,$arrHoraTemp);
		*/
		return $arrHora;
	}
	function get_config($arrDatsTemp=array()){
		
		/*
		 * para indicar que el campo se debe rescatar la glosa de otra tabla se realiza de la manera siguiente: 
		 * 'externo'=>array('tabla'=>'encargado','llave'=>'idencargado','descripcion'=>'nombre_encargado'
		 */
		//define llaves de las tablas
		$arrDats['prioridad']['primary_key'] 		= 'idprioridad';
		$arrDats['tarea']['primary_key'] 			= 'idtarea';
		$arrDats['tipo']['primary_key'] 			= 'idtipo';
		$arrDats['proyecto']['primary_key'] 		= 'idproyecto';
		$arrDats['encargado']['primary_key'] 		= 'idencargado';
		$arrDats['usuario']['primary_key'] 			= 'idusuario';
		$arrDats['estado_usuario']['primary_key'] 	= 'idestado_usuario';
		$arrDats['perfil']['primary_key'] 			= 'idperfil';
		$arrDats['tipo_tarea']['primary_key'] 		= 'idtarea';
		$arrDats['estado']['primary_key'] 			= 'idestado';
		$arrDats['perfil_usuario']['primary_key'] 	= 'idperfil_usuario';
		$arrDats['usuario_perfil']['primary_key'] 	= 'idusuario_perfil';
		$arrDats['carpeta']['primary_key'] 			= 'idcarpeta';
		$arrDats['archivo']['primary_key'] 			= 'idarchivo';
		$arrDats['persona']['primary_key'] 			= 'idpersona';
		$arrDats['estado_tarea']['primary_key'] 	= 'idestado_tarea';
		$arrDats['categoria']['primary_key'] 		= 'idcategoria';
		$arrDats['recursos_web']['primary_key'] 	= 'idrecursos_web';
		$arrDats['bitacora']['primary_key'] 	= 'idbitacora';
		$arrDats['ubicacion']['primary_key'] 	= 'idubicacion';
		$arrDats['tipo_ubicacion']['primary_key'] 	= 'idtipo_ubicacion';
		
		//define propiedades de los campos
		/* tabla Encargado */
		$arrDats['idencargado'] 			= array('text'=>'Encargado','externo'=>array('tabla'=>'encargado','llave'=>'idencargado','descripcion'=>'nombre_encargado'));
		
		/* tabla categoria */
		$arrDats['idcategoria_padre'] 			= array('text'=>'Categoria padre','externo'=>array('tabla'=>'categoria','llave'=>'idcategoria','descripcion'=>'nombre_categoria','excluir_regla'=>'true'));
		$arrDats['idcategoria'] 			= array('text'=>'Categoria','externo'=>array('tabla'=>'categoria','llave'=>'idcategoria','descripcion'=>'nombre_categoria'));
		
		/* tabla estado_tarea */
		$arrDats['idestado_tarea'] 			= array('text'=>'Estado tarea','externo'=>array('tabla'=>'estado_tarea','llave'=>'idestado_tarea','descripcion'=>'nombre_estado'));
		
		/* tabla estado_tarea */
		$arrDats['idtarea_padre'] 			= array('text'=>'Tarea Padre','externo'=>array('tabla'=>'tarea','llave'=>'idtarea','descripcion'=>'nombre','excluir_regla'=>'true'));
		
		/* tabla usuario*/
		$arrDats['idusuario'] 			= array('text'=>'Usuario','externo'=>array('tabla'=>'usuario','llave'=>'idusuario','descripcion'=>'username'));
		
		/* tabla estado*/
		$arrDats['idestado'] 			= array('text'=>'Estado','externo'=>array('tabla'=>'estado','llave'=>'idestado','descripcion'=>'nombre_estado'));
		
		/* tabla perfil_usuario*/
		$arrDats['idperfil_usuario'] 			= array('text'=>'Perfil usuario','externo'=>array('tabla'=>'perfil_usuario','llave'=>'idperfil_usuario','descripcion'=>'nombre_perfil'));
		
		/* tabla carpeta*/
		$arrDats['idcarpeta_padre'] 			= array('text'=>'Carpeta padre','externo'=>array('tabla'=>'carpeta','llave'=>'idcarpeta','descripcion'=>'carp_nombre'));
		
		/* tabla tipo ubicacion*/
		$arrDats['idtipo_ubicacion'] 			= array('text'=>'Tipo Ubicacion','externo'=>array('tabla'=>'tipo_ubicacion','llave'=>'idtipo_ubicacion','descripcion'=>'nombre_tipo_ubicacion'));
		
		/* tabla tarea */
		$arrDats['idtarea'] 						= array('text'=>'Id Tarea');
		$arrDats['idproyecto'] 						= array('text'=>'Proyecto','externo'=>array('tabla'=>'proyecto','llave'=>'idproyecto','descripcion'=>'nombre_proyecto'));
		$arrDats['encargado_idencargado'] 			= array('text'=>'Encargado','maxlegth'=>10,'data_type'=>'int','externo'=>array('tabla'=>'encargado','llave'=>'idencargado','descripcion'=>'nombre_encargado'));
		$arrDats['nombre'] 							= array('text'=>'Nombre Tarea');
		$arrDats['fecha_creacion'] 					= array('text'=>'Fecha de Creación');
		$arrDats['hora_creacion'] 					= array('text'=>'Hora de Creación');
		$arrDats['fecha_entrega'] 					= array('text'=>'Fecha de Entrega');
		$arrDats['hora_entrega'] 					= array('text'=>'Hora de Entrega');
		$arrDats['responsable'] 					= array('text'=>'Responsable');
		$arrDats['observacion'] 					= array('text'=>'Desarrollo de la tarea');
		$arrDats['fecha_presupuestada'] 			= array('text'=>'Fecha Propuesta');
		$arrDats['des_tarea'] 						= array('text'=>'Descripción Tarea');
		
		/* tabla Perfil */
		$arrDats['idperfil'] 						= array('text'=>'Perfil','externo'=>array('tabla'=>'perfil','llave'=>'idperfil','descripcion'=>'nombre_perfil'));
		
		/* tabla estado_usuario */
		$arrDats['idestado_usuario'] 				= array('text'=>'Estado usuario','externo'=>array('tabla'=>'estado_usuario','llave'=>'idestado_usuario','descripcion'=>'nombre_estado'));
		
		/* tabla tipo */
		$arrDats['idtipotarea'] 					= array('text'=>'Tipo de tarea','maxlegth'=>10,'data_type'=>'int','externo'=>array('tabla'=>'tipo_tarea','llave'=>'idtipotarea','descripcion'=>'descripcion'));
		
		/* tabla prioridad */
		$arrDats['idprioridad'] 					= array('text'=>'Prioridad','externo'=>array('tabla'=>'prioridad','llave'=>'idprioridad','descripcion'=>'descripcion'));
		
		/* tabla prioridad */
		$arrDats['idcarpeta'] 						= array('text'=>'Carpeta','externo'=>array('tabla'=>'carpeta','llave'=>'idcarpeta','descripcion'=>'carp_nombre'));
		
		$arrDats = array_merge($arrDatsTemp,$arrDats);
		
		/* FIN TABLAS */
		/* INICIO TABLAS SISTEMA FINANCIERO */
		
		//define llaves de las tablas
		$arrDats['categoria_cuenta']['primary_key'] 		= 'idcategoria_cuenta';
		$arrDats['cuenta']['primary_key'] 					= 'idcuenta';
		$arrDats['tipo_cuenta']['primary_key'] 				= 'idtipo_cuenta';
		$arrDats['transaccion']['primary_key'] 				= 'idtransaccion';
		$arrDats['forma_pago']['primary_key'] 				= 'idforma_pago';
		$arrDats['beneficiario']['primary_key'] 			= 'idbeneficiario';
		$arrDats['tipo_transaccion']['primary_key'] 					= 'idtipo_transaccion';

		/* tabla Encargado */
		$arrDats['idcategoria_cuenta'] 			= array('text'=>'Categoria Cuenta','externo'=>array('tabla'=>'categoria_cuenta','llave'=>'idcategoria_cuenta','descripcion'=>'nombre_categoria_cuenta'));		
		$arrDats['idtipo_cuenta'] 				= array('text'=>'Tipo Cuenta','externo'=>array('tabla'=>'tipo_cuenta','llave'=>'idtipo_cuenta','descripcion'=>'nombre_tipo_cuenta'));
		$arrDats['idforma_pago'] 				= array('text'=>'Forma de Pago','externo'=>array('tabla'=>'forma_pago','llave'=>'idforma_pago','descripcion'=>'nombre_forma_pago'));
		$arrDats['idbeneficiario'] 				= array('text'=>'Beneficiario','externo'=>array('tabla'=>'beneficiario','llave'=>'idbeneficiario','descripcion'=>'nombre_beneficiario'));
		$arrDats['idtipo_transaccion'] 			= array('text'=>'Tipo de Transaccion','externo'=>array('tabla'=>'tipo_transaccion','llave'=>'idtipo_transaccion','descripcion'=>'nombre_tipo_transaccion'));
		$arrDats['idcuenta'] 					= array('text'=>'Cuenta','externo'=>array('tabla'=>'cuenta','llave'=>'idcuenta','descripcion'=>'nombre_cuenta'));
		return $arrDats;
	
	}
}