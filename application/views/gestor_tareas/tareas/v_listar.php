<html>
<head>
<title></title>
</head>
<body>
<?=anchor('login/salir','Terminar session')?>
<?=form_open($strAction)?>
<?=form_hidden('id','')?>
<h2>LISTADO DE TAREAS ACTIVAS</h2>
<table border="1">
<tr>
<?php foreach($arrList as $arrRow){
		foreach($arrRow as $strId => $strValor){
?>
	<th><?=isset($arrConfig[$strId]['text'])?$arrConfig[$strId]['text']:$strId?></th>
<?php 	} break;?>
<?php }?>
<th>Opción</th>
</tr>
<?php 
$strIdentificador = '';
foreach($arrList as $arrRow){ 
	$a=0;
?>
	<tr>
		<?php foreach($arrRow as $strId => $strValor){
				if($strId==$arrConfig[$strTabla]['primary_key'])
					$strIdentificador = $strValor;
			?>
			<td><?=$strValor?></td>
		<?php }?>
		<td><a href="#" onclick="document.forms[0].id.value='<?=$strIdentificador?>';document.forms[0].submit()">Editar</a></td>
	</tr>
<?php }?>
</table>
<?=form_close()?>
</body>
</html>
