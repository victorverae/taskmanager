<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=base_url()?>recursos/css/date_input.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>recursos/css/timePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=base_url()?>recursos/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>recursos/js/jquery.date_input.js"></script>
<script type="text/javascript" src="<?=base_url()?>recursos/js/jquery.timePicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>recursos/js/DrawObject.js"></script>
<script type="text/javascript" src="<?=base_url()?>recursos/js/utils.js"></script>
<script type="text/javascript">
$($.date_input.initialize);
jQuery(function() {
    $(".time_input").timePicker({
		  startTime: "00:00",  // Using string. Can take string or Date object.
		  endTime: new Date(0, 0, 0, 23, 55, 0),  // Using Date object.
		  show24Hours: true,
		  separator:':',
		  step: 5});
    });
</script>
</head>
<body>
<?=$this->menu->get_menu()?>
<?=form_open($strAction)?>
<table>
<?php foreach($arrCampos as $arrC){
if($arrC['html']!=''){
?>
<tr><td><?=$arrC['campo']?></td><td><?=$arrC['html']?></td></tr>
<?php }else{ 
	if(isset($arrC['hidden']))
		echo $arrC['hidden'];
	}
?>
<?php }?>
</table>
<?=form_submit('enviar','Enviar')?>
<?=form_close()?>
</body>
</html>