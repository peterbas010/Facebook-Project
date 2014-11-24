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
				echo "<h1>Inloggen mislukt!</h1>" . '<meta http-equiv="refresh" content="3;url=index.php" />' ;
			}
		}

		break;

	case 'admin':

			$result = checkAdmin();
			foreach ($result as $row)
			{
				if ($row['groep_id'] == '1') 
				{
					$tpl->newBlock("home");
					$tpl->newBlock("admin");
					$tpl->newBlock("adminposttext");
					$result = getWall();
					foreach ($result as $row) 
					{
					$tpl->newBlock("adminwall");
					$tpl->assign("POSTVOORNAAM", $row['postvoornaam']);
					$tpl->assign("POSTACHTERNAAM", $row['postachternaam']);
					$tpl->assign("TITEL", $row['titel']);
					$tpl->assign("POSTCONTENT", $row['postcontent']);
					$tpl->assign("POSTDATUM", $row['postdatum']);
					$tpl->assign("PERSOONID", $row['persoonidpost']);
					$tpl->assign("POSTID", $row['postid']);
					$tpl->assign("EMAIL", $row['email']);
					$tpl->newBlock("admindeledit");
					$tpl->assign("POSTID", $row['postid']);
					$postid = $row['postid'];

					$result = getComment($postid);
					foreach ($result as $row) 
					{
					$tpl->newBlock("admincomments");
					$tpl->assign("COMMENTVOORNAAM", $row['voornaam']);
					$tpl->assign("COMMENTACHTERNAAM", $row['achternaam']);
					$tpl->assign("COMMENTCONTENT", $row['content']);
					$tpl->assign("COMMENTDATUM", $row['datum']);
					$tpl->assign("COMMENTID", $row['commentid']);
					$tpl->newBlock("admindelcomment");
					$tpl->assign("COMMENTID", $row['commentid']);
					}
					}
					$result = getAllUsers();
					foreach ($result as $row) 
					{
					$tpl->newBlock("admindeluser");
					$tpl->newBlock("adminuser");
					$tpl->assign("VOORNAAM", $row['voornaam']);
					$tpl->assign("ACHTERNAAM", $row['achternaam']);
					$tpl->assign("EMAIL", $row['email']);
					if ($row['status'] == '0')
						{
						$row['status'] = 'Actief';
						}
					elseif ($row['status'] == '1')
						{
						$row['status'] = 'Inactief';
						}
					$tpl->assign("STATUS", $row['status']);
					$tpl->newBlock("admindellink");
					$tpl->assign("GEBRUIKERID", $row['gebruikerid']);					
					}

				}
				else
				{
				header("Location:index.php");
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
			$tpl->assign("EMAIL", $row['email']);
			if ($row['gebruikerid'] == $_SESSION['user']) 
				{
					$tpl->newBlock("profieledit");
				}
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
			if ($row['gebruikerid'] == $_SESSION['user']) 
				{
					$tpl->newBlock("profieldeledit");
					$tpl->assign("POSTID", $row['postid']);
				}

			$result = getComment($postid);
			foreach ($result as $row) 
			{
			$tpl->newBlock("profielcomments");
			$tpl->assign("COMMENTVOORNAAM", $row['voornaam']);
			$tpl->assign("COMMENTACHTERNAAM", $row['achternaam']);
			$tpl->assign("COMMENTCONTENT", $row['content']);
			$tpl->assign("COMMENTDATUM", $row['datum']);
			$tpl->assign("COMMENTID", $row['commentid']);
			if ($row['gebruikerid'] == $_SESSION['user']) 
				{
					$tpl->newBlock("profieldelcomment");
					$tpl->assign("COMMENTID", $row['commentid']);
				}
			}
			$result = checkAdmin();
			foreach ($result as $row)
				{
				if ($row['groep_id'] == '1')
				{
				$tpl->newBlock("adminbutton");
				}
			}
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
		 header("Location:index.php?actie=wall");
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
		 echo "<h1>Profiel bijgewerkt!</h1>" . '<meta http-equiv="refresh" content="2;url=index.php?actie=wall" />' ;
		}
	break;

	case 'wall':

		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		elseif (isset($_POST['dislike'])) {
			disLikePost($_SESSION['user'], $_GET['postid']);
			header('Location:index.php?actie=wall');
		}
		elseif (isset($_POST['like'])) {
			likePost($_SESSION['user'], $_GET['postid']);
			header('Location:index.php?actie=wall');
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
			$tpl->assign("POSTVOORNAAM", $row['postvoornaam']);
			$tpl->assign("POSTACHTERNAAM", $row['postachternaam']);
			$tpl->assign("TITEL", $row['titel']);
			$tpl->assign("POSTCONTENT", $row['postcontent']);
			$tpl->assign("POSTDATUM", $row['postdatum']);
			$tpl->assign("PERSOONID", $row['persoonidpost']);
			$tpl->assign("POSTID", $row['postid']);
			$tpl->assign("EMAIL", $row['email']);
			$postid = $row['postid'];
			$liked = checklike($postid);
			if ($liked)
			{
				$tpl->newBlock("disliken");
				$tpl->assign("POSTID", $row['postid']);
			}
			else
			{
				$tpl->newBlock("liken");
				$tpl->assign("POSTID", $row['postid']);
			}
			if ($row['gebruikerid'] == $_SESSION['user']) 
				{
					$tpl->newBlock("deledit");
					$tpl->assign("POSTID", $row['postid']);
				}

			$result = getComment($postid);
			foreach ($result as $row) 
			{
			$tpl->newBlock("comments");
			$tpl->assign("COMMENTVOORNAAM", $row['voornaam']);
			$tpl->assign("COMMENTACHTERNAAM", $row['achternaam']);
			$tpl->assign("COMMENTCONTENT", $row['content']);
			$tpl->assign("COMMENTDATUM", $row['datum']);
			$tpl->assign("COMMENTID", $row['commentid']);
			if ($row['gebruikerid'] == $_SESSION['user']) 
				{
					$tpl->newBlock("delcomment");
					$tpl->assign("COMMENTID", $row['commentid']);
				}
			}
			$result = getLikes($postid);
			foreach ($result as $row)
				{
					$tpl->newBlock("likes");
					$tpl->assign("COUNT", $row['count']);
				}
			$result = checkAdmin();
			foreach ($result as $row)
				{
				if ($row['groep_id'] == '1')
				{
				$tpl->newBlock("adminbutton");
				}
			}
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
		header("Location:index.php?actie=wall");
		}

	break;

	case 'deluser':

		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
		$userid = $_GET['id'];
		deleteUser($userid);
		header("Location:index.php?actie=admin");
		}

	break;

	case 'activateuser':

		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
		$userid = $_GET['id'];
		activateUser($userid);
		header("Location:index.php?actie=admin");
		}

	break;

		case 'postcomment':

		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
			$content = $_POST['addcomment'];
			$postid = $_GET['id'];
			postComment($content, $postid);
			header("Location:index.php?actie=wall");
		}

	break;

	case 'deletecomment':

		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
		$commentid = $_GET['id'];
		deleteComment($commentid);
		header("Location:index.php?actie=wall");
		}

	break;

	case 'editcomment':

		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
		$commentid = $_GET['id'];
		$result = getSingleComment($commentid);
		foreach ($result as $row)
			{
			$tpl->newBlock("home");
			$tpl->newBlock("editcomment");
			$tpl->assign("CONTENT", $row['content']);
			$tpl->assign("COMMENTID", $row['id']);
			}
		}

	break;

		case 'editcommentcheck':
		if(!isset($_SESSION['user'])) 
		{
		 header("Location:index.php");
		}
		else
		{
		$commentid = $_GET['id'];
		$commentedit = $_POST['commentedit'];

		editComment($commentid, $commentedit);
		 header("Location:index.php?actie=wall");
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