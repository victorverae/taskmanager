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
<?=$strCatHijo?>
</table>
<?=$strArbol?>
<?=form_close()?>
</body>
</html>
