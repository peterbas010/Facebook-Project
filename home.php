<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['user'])) 
	{
	 header("Location:index.php");
	}
	include("../Template-Power/class.TemplatePower.inc.php");

	include('db.php');

	  $tpl = new TemplatePower( "./templatepeepz.tpl" );

	  $tpl->prepare();

	openModel();

	if(isset($_GET['actie'])){

	$actie = $_GET['actie'];
	}

	else{
		$actie = null;
	}

	$tpl->newBlock("home");
	$tpl->printToScreen();

closeModel();
?>