<?php


class webserviceclient extends Controller {

	function webserviceclient()
	{
		parent::Controller();	
		$username = "vvera";
		$password = "vvera1234gplus";
		$this->load->library("mantislib",array(
                                      'url'       => MANTIS_WEBSERVICE,
                                      'username'  => $username,
                                      'password'  => $password
                                ));
	}
	
	function index()	
	{
		
		//$this->nusoap_client = new nusoap_client(MANTIS_WEBSERVICE,true);
		
		/*
		$arrWebservice = $this->getWebservice();
		foreach($arrWebservice as $strIndice => $arrValor){
			$this->webServiceExec($strIndice,$arrValor);
		} 
		*/
		//-------------------------------------------------------
		$username = "vvera";
		$password = "vvera1234gplus";
		$mantis = new MantisLib(array(
                                      'url'       => MANTIS_WEBSERVICE,
                                      'username'  => $username,
                                      'password'  => $password
                                )
                                );
		
		$datos = $mantis->version();
		$arr_issue = $mantis->project_get_issues("11", "1", "500");
		$this->load->library('table');
		$this->table->set_heading('issue N°', 'last update', 'Proyecto','Categoria','Reportador','Asignada a');
		$arrProjects = array();
		foreach($arr_issue as $obj_issue){
			$arrProjects[$obj_issue->project->id] = $obj_issue->project->name;
			$arrDato = array(
				$obj_issue->id,
				$obj_issue->last_updated,
				$obj_issue->project->name,
				$obj_issue->category,
				$obj_issue->reporter->name,
				isset($obj_issue->handler)?$obj_issue->handler->name:""
			);
			$this->table->add_row($arrDato);
		}
		echo $this->table->generate();
		$this->table->clear();
		
		echo print_r($arrProjects);
		
		
		//--------------------------------------------------------
		/*
	 	if($this->nusoap_client->fault)
        {
             $text = 'Error: '.$this->nusoap_client->fault;
        }
        else
        {
            if ($this->nusoap_client->getError())
            {
                 $text = 'Error: '.$this->nusoap_client->getError();
            }
            else
            {
            	$strMethod = "mc_login";
            	print_r($arrWebservice[$strMethod]);
                 $row = $this->nusoap_client->call(
                          $arrWebservice[$strMethod]['name'],
                           $arrWebservice[$strMethod]['params']
                        );
                 echo "<pre>";var_dump($row);echo "</pre>";       
            }
        }
		*/
		/*
		$error = $this->nusoap_client->getError();  
			if($error){
				echo '<pre style="color: red">' . $error . '</pre>';
				die();
			}
		var_dump($error);
		
		if(true){
			$arrayResult = $this->nusoap_client->call("mc_version");
			var_dump($arrayResult);
			$result;
			$valor;
			foreach($arrayResult as $val => $i ){
			$valor=$val;
			$result=$i;
			}
				if($result != 0){
					echo $result;
				}
				else
					echo '';
		}
		*/
		/*
		$this->load->library("nusoap");
		$soapclient = new nusoap_client($webServiceName, true);	
		$error = $soapclient->getError();  
			if($error){
				echo '<pre style="color: red">' . $error . '</pre>';
				die();
			}
		// asignar los parametros de entrada 
		if(	isset($cod) and isset($fecha) and isset($web_metodo) and isset($usuario) and isset($comp)){
		$params = array('cod_tribunal' => $cod,'fecha_informacion' => $fecha,'user' => $usuario,'competencia' => $comp,'nombre_doc' => $nombre_doc,'mes' => $mes,'anho' => $anno);	
		$arrayResult = $soapclient->call($web_metodo,$params);
		$result;
		$valor;
		foreach($arrayResult as $val => $i ){
		$valor=$val;
		$result=$i;
		}
			if($result != 0){
			return $result;
			}
			else
				echo '';
		
		}
		else
			echo 'Faltan datos de entrada para ejecutar el WebService';
		*/
	}
	function printWeb($arrDato){
		var_dump($arrDato);
		if(is_array($arrDato) || is_object($arrDato)){
		echo "<table border=1>\n";
		foreach($arrDato As $strIndex => $arrValor){
			echo "<tr>";
			foreach($arrValor as $strIndex1 => $strValor){
				if(is_array($strValor) || is_object($strValor)){
					echo "<td>".$this->printWebHTML($strValor)."</td>";	
				}else{
					echo "<td>&nbsp;".$strValor."</td>";
				}
			}
			echo "</tr>\n";
		}
		echo '</table>';
		}else{
			echo "<pre>"; var_dump($arrDato); echo "</pre>";
		}
	}
	
	function printWebHTML($arrDato,$bret=false){
		$strTexto = "";
		if(is_array($arrDato) || is_object($arrDato)){
			foreach($arrDato As $strIndex => $arrValor){
				if(is_array($arrValor) || is_object($arrValor)){
					foreach($arrValor as $strIndex1 => $strValor){
						if(is_object($strValor) || is_array($strValor)){
							$strTexto .= " ".$this->printWebHTML($strValor)." ";
						}else{
							$strTexto .= " ".$strValor." ";
						}
							
					}
				}else{
					$strTexto .= " ".$arrValor." ";
				}
			}
		}else{
		}
		return $strTexto ;
	}
	function webServiceExec($strMethod,$arrParams){
		$this->nusoap_client = new nusoap_client(MANTIS_WEBSERVICE,true);
		$arrWebservice = $this->getWebservice();
	 	if($this->nusoap_client->fault)
        {
             $text = 'Error: '.$this->nusoap_client->fault;
        }
        else
        {
            if ($this->nusoap_client->getError())
            {
                 $text = 'Error: '.$this->nusoap_client->getError();
            }
            else
            {
            	Echo "Metodo:".$strMethod."<br>";
                 $row = $this->nusoap_client->call(
                          $strMethod,
                           $arrParams
                        );
                 echo "<pre>";var_dump($row);echo "</pre>";       
            }
        }
	}
	function getWebservice(){
		$username = "vvera";
		$password = "vvera1234gplus";
		//$arrWebservice['mc_version']= array();
		/*
		$arrWebservice['mc_login'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_status'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_priorities'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_severities'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_reproducibilities'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_projections'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_etas'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_resolutions'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_access_levels'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_project_status'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_project_view_states'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_view_states'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_custom_field_types'] = array("username"=>$username,"password"=>$password);
		*/
		/*
		$arrWebservice['mc_enum_get'] = array("username"=>$username,"password"=>$password, "enumeration"=>"");
		$arrWebservice['mc_issue_exists'] = array("username"=>$username,"password"=>$password, "issue_id"=>"");
		$arrWebservice['mc_issue_get']= array("username"=>$username,"password"=>$password, "issue_id"=>"");
		$arrWebservice['1']['name'] = 'mc_issue_get_biggest_id';
		$arrWebservice['1']['params'] = array("username"=>$username,"password"=>$password, "project_id"=>"");
		$arrWebservice['mc_issue_get_id_from_summary'] = array("username"=>$username,"password"=>$password, "summary"=>"");
		
		*/
		/*
		$arrWebservice['mc_issue_add'];
		$arrWebservice['mc_issue_update'];
		$arrWebservice['mc_issue_set_tags'];
		$arrWebservice['mc_issue_delete'];
		$arrWebservice['mc_issue_note_add'];
		$arrWebservice['mc_issue_note_delete'];
		$arrWebservice['mc_issue_note_update'];
		$arrWebservice['mc_issue_relationship_add'];
		$arrWebservice['mc_issue_relationship_delete'];
		$arrWebservice['mc_issue_attachment_add'];
		$arrWebservice['mc_issue_attachment_delete'];
		$arrWebservice['mc_issue_attachment_get'];
		$arrWebservice['mc_project_add'];
		$arrWebservice['mc_project_delete'];
		$arrWebservice['mc_project_update'];
		$arrWebservice['mc_project_get_id_from_name'];
		*/
		// OK $arrWebservice['mc_project_get_issues'] = array("username"=>$username,"password"=>$password,"project_id"=>"25","page_number"=>"1","per_page"=>"50");
		
		// OK $arrWebservice['mc_project_get_issue_headers'] = array("username"=>$username,"password"=>$password,"project_id"=>"","page_number"=>"1","per_page"=>"100");
		/*
		$arrWebservice['mc_project_get_users'];
		$arrWebservice['mc_projects_get_user_accessible'];
		$arrWebservice['mc_project_get_categories'];
		$arrWebservice['mc_project_add_category'];
		$arrWebservice['mc_project_delete_category'];
		$arrWebservice['mc_project_get_versions'];
		$arrWebservice['mc_project_version_add'];
		$arrWebservice['mc_project_version_update'];
		$arrWebservice['mc_project_version_delete'];
		$arrWebservice['mc_project_get_released_versions'];
		$arrWebservice['mc_project_get_unreleased_versions'];
		$arrWebservice['mc_project_get_attachments'];
		$arrWebservice['mc_project_get_custom_fields'];
		$arrWebservice['mc_project_attachment_get'];
		$arrWebservice['mc_project_attachment_add'];
		$arrWebservice['mc_project_attachment_delete'];
		*/
		$arrWebservice['mc_project_get_all_subprojects'] = array("username"=>$username,"password"=>$password,"project_id"=>"11");
		/*
		$arrWebservice['mc_filter_get'];
		$arrWebservice['mc_filter_get_issues'];
		$arrWebservice['mc_filter_get_issue_headers'];
		$arrWebservice['mc_config_get_string'];
		$arrWebservice['mc_issue_checkin'];
		$arrWebservice['mc_user_pref_get_pref'];
		*/
		//$arrWebservice['mc_user_profiles_get_all'] = array("username"=>$username,"password"=>$password,"page_number"=>"1","per_page"=>"50");
		
		/*$arrWebservice['mc_tag_get_all'];
		$arrWebservice['mc_tag_add'];
		$arrWebservice['mc_tag_delete'];
		*/
		return $arrWebservice;
	}
}
	