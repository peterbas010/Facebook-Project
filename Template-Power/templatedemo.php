<?php

	include( "./class.TemplatePower.inc.php" );

	$tpl = new TemplatePower( "./templatedemo.tpl" );

	$tpl->prepare();

	$naam = "Peter-Bas";
	$baas = "Peter-Bas";

	if ($naam == $baas) {

		$tpl->newBlock("baas");
		$tpl->assign("NAAM", $naam);

	} else {

		$tpl->newBlock("geenbaas");
		$tpl->assign("NAAM", $naam);
	}

	$tpl->gotoBlock("_ROOT");
	
	$tpl->assign("NAAM", $naam);

	$tpl->assign("NAAM", $naam);

	$tpl->printToScreen();
	

?>