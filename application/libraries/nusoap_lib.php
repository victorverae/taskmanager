<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class nusoap_lib{
function Nusoap_lib(){
    require_once(str_replace("\\","/",APPPATH).'libraries/nusoap/lib/nusoap'.EXT); //Por si estamos ejecutando este script en un servidor Windows
}
}
?>