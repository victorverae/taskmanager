<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html> 
  <head> 
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
  </head> 
  <body> 
  <?=form_open("webserviceclient")?>
  	<?=form_input("param1",(isset($_POST['param1'])?$_POST['param1']:""))?>
  	<?=form_input("param1",(isset($_POST['param1'])?$_POST['param1']:""))?>
  	<?=form_input("param2",(isset($_POST['param2'])?$_POST['param1']:""))?>
  	<?=form_input("param3",(isset($_POST['param3'])?$_POST['param1']:""))?>
  	<?=form_input("param4",(isset($_POST['param4'])?$_POST['param1']:""))?>
  <?=form_close()?>
  </body> 
</html> 
 
 
 
 