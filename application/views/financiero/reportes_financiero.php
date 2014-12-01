<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en_US" xml:lang="en_US">
<head>
<title>Reportes</title>
<style type="text/css">
td{
	border:solid black 1px;
}
</style>
<link href="<?=base_url()?>css/minimal.css?a=1" type="text/css" />
</head>
<body>
<?=anchor("financiero/importar_archivo","Importar datos")?>
<?php echo form_open('financiero/reportes_financiero')?>
<h2>Filtros</h2>
<div class="minimalbox" style="background-color: #f5f5f5;">
asdasdasda	
</div>

<div class="minimalbox" style="">
año: <?php echo $anno;?><br></br>
mes: <?php echo $mes;?><br></br>
cuenta: <?php echo $cuenta;?><br></br>
</div>
<?=form_submit("enviar","Consultar")?>
<?php 
foreach($reporte as $strIndice => $strValor){
	echo $strValor;
}
?>
</form>
</body>
</html>