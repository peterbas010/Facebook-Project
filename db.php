<?php
	function openModel()
	{
	global $db;
	$db = new PDO('mysql:host=localhost;dbname=peepzbook', 'root', ''); 
 	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	}

	function closeModel()
	{
	global $db;
	$db = null;	
	}

	function addUser($email, $wachtwoord)
	{
		global $db;
		$naamreg = $_POST['naamreg'];
		$wwreg = $_POST['wwreg'];
		$sql="INSERT INTO gebruiker(email, password)VALUES('$naamreg', '$wwreg')";
		$stmt = $db->prepare( $sql );
		$stmt->bindParam(':naamreg', $email, PDO::PARAM_STR);
		$stmt->bindParam(':wwreg', $password, PDO::PARAM_STR);
		$stmt->execute();

		header("Location:index.php?msg=U kunt nu inloggen!");
	}

	function checkUser($email, $password)
	{
		global $db;

		$result = $db->prepare("SELECT * FROM gebruiker WHERE email= :email AND password= :password");
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		$result->execute();
		$rows = $result->fetch(PDO::FETCH_NUM);
		if($rows > 0) {
				session_start();
				$_SESSION['user'] = $email; 
				header("Location:home.php?");
				}
		else{
				header("Location:index.php");
			}
	}
	function getUserPromo()
	{
		global $db;
		$sql = "SELECT * FROM gebruiker
				left join persoon on
				gebruiker.id = persoon.id
				where email = '$_SESSION[user]'";
		$result = $db->prepare("SELECT * FROM gebruiker
				left join persoon on
				gebruiker.id = persoon.id
				where email = '$_SESSION[user]'");
		$result = $db->query($sql);
		foreach ($result as $row)
		{
		echo 
			'<img class="promoimg" src="profielfoto/standaard.png"'. '>' . '</a>' .
			'<p>' . $row['voornaam'] . ' ' . $row['achternaam'] .'</p>' . 
			'<p>' . $row['woonplaats'] . '</p>' . 
			'<a href="edit.php">' . '<i>Informatie bewerken!</i>' . '</a>' ;
		}
	}

	function getWall()
	{
		global $db;
		$sql = "SELECT * FROM post
				LEFT JOIN gebruiker on
				post.gebruiker_id=gebruiker.id
				LEFT JOIN persoon on
				gebruiker.id=persoon.id
				ORDER BY datum DESC";
		$result = $db->prepare("SELECT * FROM post
				LEFT JOIN gebruiker on
				post.gebruiker_id=gebruiker.id
				LEFT JOIN persoon on
				gebruiker.id=persoon.id
				ORDER BY datum DESC");
		$result = $db->query($sql);
		foreach ($result as $row)
		{
		echo 
			'<div class="post">'.
			'<h2 class="naam">' . $row['voornaam'] . ' ' . $row['achternaam'] . '</h2>'.
			'<h2 class="titel">' . $row['titel'] . '</h2>'.
			'<p class="postcontent">' . $row['content'] . '</p>'.
			'<p class="postdatum">'. 'Geplaatst op: ' . $row['datum'] . '</p>'.
			'</div>'
			;
		}
	}
	?>	