<!DOCTYPE html>
<?php
	session_start();

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

	switch ($actie) {
	case 'login':
		
		if (isset($_POST['login'])) {
			$email = $_POST['name'];
			$password = $_POST['password'];
			$rows = checkUser($email, $password);
			if($rows != null) {
				$_SESSION['user'] = $rows[0]['ID']; 
				$actie = 'wall';
				header("location:index.php?actie=wall");
				}
		else{
				echo "<h1>Gebruikersnaam of wacthwoord incorrect!</h1>" . '<meta http-equiv="refresh" content="3;url=index.php" />' ;
			}
		}

		break;

	case 'post':

	if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
	elseif (isset($_POST['postknop'])) 
	{
		$stmt = postContent();
		foreach ($stmt as $row) 
			{
			$posterID = $row['gebruikerpersoonid'];
			}
		$titel = $_POST['titelveld'];
		$content = $_POST['postveld'];
		postContentCheck($titel, $content, $posterID);
		header("location:index.php?actie=wall");
	}
		break;

	case 'profiel':

		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
		$tpl->newBlock("home");
		$email = $_GET['email'];
		$result = getUserInfoProfile($email);
		foreach ($result as $row) 
			{
			$tpl->newBlock("profiel");
			$tpl->assign("VOORNAAM", $row['voornaam']);
			$tpl->assign("ACHTERNAAM", $row['achternaam']);
			$tpl->assign("GEBOORTEDATUM", $row['geboortedatum']);
			$tpl->assign("ADRES", $row['adres']);
			$tpl->assign("POSTCODE", $row['postcode']);
			$tpl->assign("WOONPLAATS", $row['woonplaats']);
			$tpl->assign("TELEFOON", $row['telefoon']);
			$tpl->assign("MOBIEL", $row['mobiel']);
			}
		$result = getWallProfile($email);
		foreach ($result as $row) 
			{
			$tpl->newBlock("profielwall");
			$tpl->assign("VOORNAAM", $row['voornaam']);
			$tpl->assign("ACHTERNAAM", $row['achternaam']);
			$tpl->assign("TITEL", $row['titel']);
			$tpl->assign("CONTENT", $row['content']);
			$tpl->assign("DATUM", $row['datum']);
			$tpl->assign("PERSOONID", $row['id']);
			$tpl->assign("POSTID", $row['postid']);
			$tpl->assign("EMAIL", $row['email']);
			$postid = $row['postid'];
			}
		}
	break;

	case 'eigenprofiel':

		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
		$tpl->newBlock("home");
		$result = getUserInfo();
		foreach ($result as $row) 
			{
			$tpl->newBlock("profiel");
			$tpl->assign("VOORNAAM", $row['voornaam']);
			$tpl->assign("ACHTERNAAM", $row['achternaam']);
			$tpl->assign("GEBOORTEDATUM", $row['geboortedatum']);
			$tpl->assign("ADRES", $row['adres']);
			$tpl->assign("POSTCODE", $row['postcode']);
			$tpl->assign("WOONPLAATS", $row['woonplaats']);
			$tpl->assign("TELEFOON", $row['telefoon']);
			$tpl->assign("MOBIEL", $row['mobiel']);
			$tpl->newBlock("profieledit");			
			}
		$result = getWallOwn();
		foreach ($result as $row) 
			{
			$tpl->newBlock("eigenwall");
			$tpl->assign("VOORNAAM", $row['voornaam']);
			$tpl->assign("ACHTERNAAM", $row['achternaam']);
			$tpl->assign("TITEL", $row['titel']);
			$tpl->assign("CONTENT", $row['content']);
			$tpl->assign("DATUM", $row['datum']);
			$tpl->assign("PERSOONID", $row['id']);
			$tpl->assign("POSTID", $row['postid']);
			$tpl->assign("EMAIL", $row['email']);
			$postid = $row['postid'];
			}
		}
	break;

		case 'editpost':

		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
		$postid = $_GET['id'];
		$result = getSinglePost($postid);
		foreach ($result as $row)
			{
			$tpl->newBlock("home");
			$tpl->newBlock("editpost");
			$tpl->assign("TITEL", $row['titel']);
			$tpl->assign("CONTENT", $row['content']);
			$tpl->assign("DATUM", $row['datum']);
			$tpl->assign("PERSOONID", $row['id']);
			$tpl->assign("POSTID", $row['postid']);
			$postid = $row['postid'];
			}
		}

	break;

		case 'editpostcheck':
		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
		$postid = $_GET['id'];
		$contentedit = $_POST['contentedit'];
		$titeledit = $_POST['titeledit'];

		editPost($postid, $contentedit, $titeledit);
		 header("Location:index.php?actie=eigenprofiel");
		}
	break;

	case 'edit':

		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
		$result = getInfo();
		foreach ($result as $row)
		{
			$tpl->newBlock("home");
			$tpl->newBlock("edit");
			$tpl->assign("VOORNAAM", $row['voornaam']);
			$tpl->assign("ACHTERNAAM", $row['achternaam']);
			$tpl->assign("GEBOORTEDATUM", $row['geboortedatum']);
			$tpl->assign("ADRES", $row['adres']);
			$tpl->assign("POSTCODE", $row['postcode']);
			$tpl->assign("WOONPLAATS", $row['woonplaats']);
			$tpl->assign("TELEFOON", $row['telefoon']);
			$tpl->assign("MOBIEL", $row['mobiel']);
		}
		}

	break;

	case 'editcheck':
		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
		$result = getUserInfo();
		foreach ($result as $row)
		{
			$persoonid= $row['persoon_id'];
		}
		$voornaam = $_POST['vooredit'];
		$achternaam = $_POST['achteredit'];
		$geboortedatum = $_POST['gbedit'];
		$adres = $_POST['adresedit'];
		$postcode = $_POST['postedit'];
		$woonplaats = $_POST['woonedit'];
		$telefoon = $_POST['teledit'];
		$mobiel = $_POST['mobedit'];

		editUser($persoonid, $voornaam, $achternaam, $geboortedatum, $adres, $postcode, $woonplaats, $telefoon, $mobiel);
		 header("Location:index.php?actie=eigenprofiel");
		}
	break;

	case 'wall':

		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
		$tpl->newBlock("home");
		$tpl->newBlock("wallpost");
		$result = getUserPromo();
		foreach ($result as $row) 
			{
			$tpl->newBlock("userpromo");
			$tpl->assign("VOORNAAM", $row['voornaam']);
			$tpl->assign("ACHTERNAAM", $row['achternaam']);
			$tpl->assign("WOONPLAATS", $row['woonplaats']);
			$GebruikerID = $row['id'];
			}
		$result = getWall();
		foreach ($result as $row) 
			{
			$tpl->newBlock("wall");
			$tpl->assign("VOORNAAM", $row['voornaam']);
			$tpl->assign("ACHTERNAAM", $row['achternaam']);
			$tpl->assign("TITEL", $row['titel']);
			$tpl->assign("CONTENT", $row['content']);
			$tpl->assign("DATUM", $row['datum']);
			$tpl->assign("PERSOONID", $row['id']);
			$tpl->assign("POSTID", $row['postid']);
			$tpl->assign("EMAIL", $row['email']);
			}
		}
	break;

	case 'verwijderen':

		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
		$postid = $_GET['id'];
		deletePost($postid);
		header("Location:index.php?actie=eigenprofiel");
		}

	break;
	
	case 'logout':

		session_start();
		unset($_SESSION['user']);
		header("Location:index.php");

	break;

	case 'register':
		{
			$naamreg = $_POST['naamreg'];
			$wwreg = $_POST['wwreg'];

		if(isset($_POST['gegevens']) )
			{
			$email = $_POST['naamreg'];
			$password = $_POST['wwreg'];
			$voornaam = $_POST['voornaam'];
			$achternaam = $_POST['achternaam'];
			$geboortedatum = $_POST['geboortedatum'];
			$adres = $_POST['adres'];
			$postcode = $_POST['postcode'];
			$woonplaats = $_POST['woonplaats'];
			$telefoon = $_POST['telefoon'];
			$mobiel = $_POST['mobiel'];

			addUser($email, $password, $voornaam, $achternaam, $geboortedatum, $adres, $postcode, $woonplaats, $telefoon, $mobiel);

			echo "<h1>U Kunt nu inloggen!</h1>" . '<meta http-equiv="refresh" content="3;url=index.php" />';
				}
		else 
				{
				$tpl->newBlock("index");
				$tpl->newBlock("gegevens");
				$tpl->assign("EMAIL", $_POST['naamreg']);
				$tpl->assign("PASSWORD", $_POST['wwreg']);
				}
			}

		break;

		default:

		if(isset($_SESSION['user'])) 
		{
		 header("Location:index.php?actie=wall");
		}
		$tpl->newBlock("index");
		$tpl->newBlock("register");

		break;
    }
    $tpl->printToScreen();
    closeModel();
?>