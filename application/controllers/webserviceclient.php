<?php


class webserviceclient extends Controller {

	function webserviceclient()
	{
		parent::Controller();	
		$this->load->library("nusoap_lib");
	}
	
	function index()	
	{
		
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
            	$strMethod = "mc_login";
            	print_r($arrWebservice[$strMethod]);
                 $row = $this->nusoap_client->call(
                          $arrWebservice[$strMethod]['name'],
                           $arrWebservice[$strMethod]['params']
                        );
                 echo "<pre>";var_dump($row);echo "</pre>";       
            }
        }
		
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
	
	function getWebservice(){
		$username = "vvera";
		$password = "vvera1234gplus";
		$arrWebservice['mc_version']= array();
		$arrWebservice['mc_login'] = array("name"=>"mc_login","params"=>array("username"=>$username,"password"=>$password));
		$arrWebservice['mc_enum_status'] = array("name"=>"","params"=>array("username"=>$username,"password"=>$password));
		$arrWebservice['mc_enum_priorities'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_severities'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_reproducibilities'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['get_projects']['name'] = 'mc_enum_projections';
		$arrWebservice['get_projects']['params'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_etas'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_resolutions'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_access_levels'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['project_status']['name']='mc_enum_project_status'; 
		$arrWebservice['project_status']['params'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_project_view_states'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_view_states'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_custom_field_types'] = array("username"=>$username,"password"=>$password);
		$arrWebservice['mc_enum_get'] = array("username"=>$username,"password"=>$password, "enumeration"=>"");
		$arrWebservice['mc_issue_exists'] = array("username"=>$username,"password"=>$password, "issue_id"=>"");
		$arrWebservice['mc_issue_get']= array("username"=>$username,"password"=>$password, "issue_id"=>"");
		$arrWebservice['1']['name'] = 'mc_issue_get_biggest_id';
		$arrWebservice['1']['params'] = array("username"=>$username,"password"=>$password, "project_id"=>"");
		$arrWebservice['mc_issue_get_id_from_summary'] = array("username"=>$username,"password"=>$password, "summary"=>"");
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
		$arrWebservice['mc_project_get_issues'] = array("username"=>$username,"password"=>$password,"project_id"=>"","page_number"=>"","per_page"=>"";
		$arrWebservice['mc_project_get_issue_headers'];
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
		$arrWebservice['mc_project_get_all_subprojects'] = array("name"=>"mc_project_get_all_subprojects","params"=>array("username"=>$username,"password"=>$password,"project_id"=>"1"));
		/*
		$arrWebservice['mc_filter_get'];
		$arrWebservice['mc_filter_get_issues'];
		$arrWebservice['mc_filter_get_issue_headers'];
		$arrWebservice['mc_config_get_string'];
		$arrWebservice['mc_issue_checkin'];
		$arrWebservice['mc_user_pref_get_pref'];
		$arrWebservice['mc_user_profiles_get_all'];
		$arrWebservice['mc_tag_get_all'];
		$arrWebservice['mc_tag_add'];
		$arrWebservice['mc_tag_delete'];
		*/
		return $arrWebservice;
	}
}
	