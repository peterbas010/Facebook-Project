<!DOCTYPE html>
<?php
	session_start();
	if(isset($_SESSION['user'])) 
	{
	 header("Location:home.php");
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

	if(isset($_GET['msg'])){

	$msg = $_GET['msg'];
	}

	else{
		$msg = null;
	}
	switch ($actie) {
	case 'login':
		
		if (isset($_POST['login'])) {
			$email = $_POST['name'];
			$password = $_POST['password'];
			checkUser($email, $password);

		}

		break;

	case 'register':
		{
			$naamreg = $_POST['naamreg'];
			$wwreg = $_POST['wwreg'];
			$wwrep = $_POST['wwrep'];

		if( $_POST['wwreg'] == $_POST['wwrep'] )
			{
			addUser($naamreg, $wwreg, $wwrep);
			}
		else 
			{
			header("Location:index.php?msg=De ingevoerde wachtwoorden komen niet overeen!");
			}
		}
		break;

		default:

		$tpl->newBlock("index");

		break;
    }
    $tpl->printToScreen();
    closeModel();
?>