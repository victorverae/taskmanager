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
			<th>NOMBRE</th>
			<th>LATITUD/LOGITUD</th>
			<th>OPCION</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($arrResult as $arrRow){?>
		<tr>
			<td><?=$arrRow['idlocacion']?></td>
			<td><?=$arrRow['nombre']?></td>
			<td><?=$arrRow['lat_long']?></td>
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