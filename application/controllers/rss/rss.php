<?php

class Rss extends Controller {

	function Rss()
	{
		parent::Controller();
	}

	function index()
	{
		//rescata de la bd
//		$this->load->database();
//		$query = $this->db->query('SELECT * FROM ubicacion');
//		$arrDatos['arrResult'] = $query->result_array();
		//$this->load->view('maps/v_map1',$arrDatos);
		//$this->lectorRSS('http://feeds.feedburner.com/webintenta/WVpB',5);
		$this->lectorRSS('http://www.cnnchile.com/rss/',10);
		
	}
	function lectorRSS($url,$elementos=6,$inicio=0) {
		$cache_version = "cache/" . basename($url);
		$archivo = fopen($url, 'r');
		stream_set_blocking($archivo,true);
		stream_set_timeout($archivo, 5);
		$datos = stream_get_contents($archivo);
		$status = stream_get_meta_data($archivo);
		fclose($archivo);
		if ($status['timed_out']) {
			$noticias = simplexml_load_file($cache_version);
		}
		else {
			$archivo_cache = fopen($cache_version, 'w');
			fwrite($archivo_cache, $datos);
			fclose($archivo_cache);
			$noticias = simplexml_load_string($datos);
		}
		$ContadorNoticias=1;
		echo "<ul>";
		foreach ($noticias->channel->item as $noticia) {
			//print_r($noticia);
			if($ContadorNoticias<$elementos){
				if($ContadorNoticias>$inicio){
					echo "<li><a href='".$noticia->link."' target='_blank' class='tooltip' title='".utf8_decode($noticia->title)."'>";
					echo utf8_decode($noticia->title);
					echo " ".$noticia->pubDate."</a>";
					echo $noticias->enclosure->url;
					foreach ($noticias->enclosure as $imagen) {
						print_r($imagen);
						echo "---<p>".$imagen->url."</p>";
						echo "---<p>".$imagen->type."</p>";
					}
					//print_r($noticia->enclosure);
					echo "</li>";
				}
				$ContadorNoticias = $ContadorNoticias + 1;
			}
		}
		echo "</ul>";
	}
}