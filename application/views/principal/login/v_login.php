<html>
<body>
<?=form_open('login/ingresar')?>
<div class="login">
	<p>usuario:<?=form_input('username','')?></p>
	<p>pass:<?=form_password('pass','')?></p>
	<p><?=form_submit('enviar','Ingresar')?></p>
</div>
</body>
</html>