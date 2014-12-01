<?=form_open($strAction)?>
<h2>LISTADO DE TABLAS</h2>
<?=form_hidden('tabla','')?>
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
<?php foreach($arrList as $arrRow){?>
	<tr>
		<?php foreach($arrRow as $strId => $strValor){?>
			<td><?=$strValor?></td>
		<?php }?>
		<td><a href="#" onclick="document.forms[0].tabla.value='<?=$strValor?>';document.forms[0].submit()">Editar</a></td>
	</tr>
<?php }?>
</table>
<?=form_close()?>
