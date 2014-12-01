<html>
<head>
	<title>categoria</title>
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" /> 
</head>
<body>

<?=$this->menu->get_menu()?>
<div>
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>CATEGORIA</th>
			<th>OPCIÓN</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($arrResult as $arrRow){?>
		<tr>
			<td><?=$arrRow['idcategoria']?></td>
			<td><?=$arrRow['descripcion']?></td>
			<td align="center">
				<a href=""><img src="<?=base_url()?>img/mantenedor/application_form_edit.ico" /></a>
				<img src="<?=base_url()?>img/mantenedor/delete.ico" />
			</td>
		</tr>
	<?php }?>	
	</tbody>
</table>
</div>

</body>
</html>