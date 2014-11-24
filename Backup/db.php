<?php
	function openModel()
	{
	global $db;
	/* $db = new PDO('mysql:host=185.13.227.3:2222;dbname=wall', 'jimgenp140_wall', 'thewall'); */
	$db = new PDO('mysql:host=localhost;dbname=peepzbook', 'root', '');
 	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	}

	function closeModel()
	{
	global $db;
	$db = null;	
	}

	function addUser($email, $password, $voornaam, $achternaam, $geboortedatum, $adres, $postcode, $woonplaats, $telefoon, $mobiel)
	{
		
		global $db;

		$sql= "INSERT INTO persoon (voornaam, achternaam, geboortedatum, adres, postcode, woonplaats, telefoon, mobiel)
		VALUES (:voornaam, :achternaam, :geboortedatum, :adres, :postcode, :woonplaats, :telefoon, :mobiel)";

		$stmt = $db->prepare($sql);
		$stmt->bindParam(':voornaam', $voornaam, PDO::PARAM_STR);
		$stmt->bindParam(':achternaam', $achternaam, PDO::PARAM_STR);
		$stmt->bindParam(':geboortedatum', $geboortedatum, PDO::PARAM_STR);
		$stmt->bindParam(':adres', $adres, PDO::PARAM_STR);
		$stmt->bindParam(':postcode', $postcode, PDO::PARAM_STR);
		$stmt->bindParam(':woonplaats', $woonplaats, PDO::PARAM_STR);
		$stmt->bindParam(':telefoon', $telefoon, PDO::PARAM_STR);
		$stmt->bindParam(':mobiel', $mobiel, PDO::PARAM_STR);

		$stmt->execute();
		$newPersonID = $db->lastInsertID();




		$sql = "INSERT INTO gebruiker (email, password, persoon_id)
				VALUES (:email, :password, :persoon_id)";

		$stmt = $db->prepare($sql);

		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':persoon_id', $newPersonID, PDO::PARAM_STR);

		$stmt->execute();

	}

	function checkUser($email, $password)
	{
		global $db;

		$result = $db->prepare("SELECT * FROM gebruiker WHERE email= :email AND password= :password");
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		$result->execute();
		$rows = $result->fetch(PDO::FETCH_NUM);

		return $rows;
	}
	function getUserPromo()
	{
		global $db;
		$sql = "SELECT * FROM gebruiker
				INNER join persoon on
				gebruiker.persoon_id = persoon.id
				where gebruiker.id = '$_SESSION[user]'";
		$result = $db->query($sql);
		return $result;
	}

	function getWall()
	{
		global $db;
		$sql = "SELECT post.id as postid, gebruiker.id as gebruikerid, titel, content, voornaam, achternaam, datum, persoon.id, gebruiker.persoon_id, email FROM post
				LEFT JOIN gebruiker on
				post.gebruiker_id=gebruiker.persoon_id
				LEFT JOIN persoon on
				gebruiker.persoon_id=persoon.id
				WHERE post.status =0
				ORDER BY datum DESC";
		$result = $db->prepare($sql);
		$result = $db->query($sql);
		return $result;
	}

	function postContent()
	{
		global $db;
		$sql = "SELECT gebruiker.persoon_id as gebruikerpersoonid FROM gebruiker
				INNER JOIN persoon
				on persoon.id=gebruiker.persoon_id
				where gebruiker.id = '$_SESSION[user]'";
		$stmt = $db->query($sql);
		return $stmt;
	}
	function postContentCheck($titel, $content, $posterID)
	{
		global $db;
		$sql = "INSERT INTO post (titel, content, gebruiker_id) 
		VALUES (:titel, :content, :poster_id)";

		$stmt = $db->prepare($sql);

		$stmt->bindParam(':titel', $titel, PDO::PARAM_STR);
		$stmt->bindParam(':content', $content, PDO::PARAM_STR);
		$stmt->bindParam(':poster_id', $posterID, PDO::PARAM_STR);

		$stmt->execute();
	}
		function getUserInfo()
	{
		global $db;
		$sql = "SELECT * FROM gebruiker
				INNER join persoon on
				gebruiker.persoon_id = persoon.id
				where gebruiker.id = '$_SESSION[user]'";
		$result = $db->query($sql);
		return $result;
	}
	function editUser($persoonid, $voornaam, $achternaam, $geboortedatum, $adres, $postcode, $woonplaats, $telefoon, $mobiel)
	{
		
		global $db;

		$sql= "UPDATE persoon
				SET voornaam=:voornaam, achternaam=:achternaam, geboortedatum=:geboortedatum, adres=:adres, postcode=:postcode, woonplaats=:woonplaats, telefoon=:telefoon, mobiel=:mobiel
				WHERE id=:persoonid";

		$stmt = $db->prepare($sql);
		$stmt->bindParam(':voornaam', $voornaam, PDO::PARAM_STR);
		$stmt->bindParam(':achternaam', $achternaam, PDO::PARAM_STR);
		$stmt->bindParam(':geboortedatum', $geboortedatum, PDO::PARAM_STR);
		$stmt->bindParam(':adres', $adres, PDO::PARAM_STR);
		$stmt->bindParam(':postcode', $postcode, PDO::PARAM_STR);
		$stmt->bindParam(':woonplaats', $woonplaats, PDO::PARAM_STR);
		$stmt->bindParam(':telefoon', $telefoon, PDO::PARAM_STR);
		$stmt->bindParam(':mobiel', $mobiel, PDO::PARAM_STR);
		$stmt->bindParam(':persoonid', $persoonid, PDO::PARAM_STR);

		$stmt->execute();
	}
			function getInfo()
	{
		global $db;
		$sql = "SELECT * FROM persoon
				INNER join gebruiker on
				persoon.id=gebruiker.persoon_id 
				where gebruiker.id = '$_SESSION[user]'";
		$result = $db->query($sql);
		return $result;
	}
	function deletePost($postid)
	{
		global $db;
		$sql = "UPDATE post
				SET status='1'
				WHERE post.id = '$postid' ";
		$stmt = $db->prepare($sql);
		$stmt = $db->query($sql);
		$stmt->execute();
		return $stmt;
	}
	function getWallProfile($email)
	{
		global $db;
		$sql = "SELECT post.id as postid, gebruiker.id as gebruikerid, titel, content, voornaam, achternaam, datum, persoon.id, gebruiker.persoon_id, email FROM post
				LEFT JOIN gebruiker on
				post.gebruiker_id=gebruiker.persoon_id
				LEFT JOIN persoon on
				gebruiker.persoon_id=persoon.id
				WHERE post.status =0
				AND email = '$email'
				ORDER BY datum DESC";
		$result = $db->prepare($sql);
		$result = $db->query($sql);
		return $result;
	}
	function getUserInfoProfile($email)
	{
		global $db;
		$sql = "SELECT * FROM gebruiker
				INNER join persoon on
				gebruiker.persoon_id = persoon.id
				where email = '$email'";
		$result = $db->query($sql);
		return $result;
	}
	function getWallOwn()
	{
		global $db;
		$sql = "SELECT post.id as postid, gebruiker.id as gebruikerid, titel, content, voornaam, achternaam, datum, persoon.id, gebruiker.persoon_id, email FROM post
				LEFT JOIN gebruiker on
				post.gebruiker_id=gebruiker.persoon_id
				LEFT JOIN persoon on
				gebruiker.persoon_id=persoon.id
				WHERE post.status =0
				AND gebruiker.id = '$_SESSION[user]'
				ORDER BY datum DESC";
		$result = $db->prepare($sql);
		$result = $db->query($sql);
		return $result;
	}
	function getDeletePostButton()
		{
		global $db;
		$sql = "SELECT * FROM gebruiker
				INNER join persoon on
				gebruiker.persoon_id = persoon.id
				WHERE gebruiker.id = '$_SESSION[user]'";
		$result = $db->query($sql);
		return $result;
		}
	function getSinglePost($postid)
	{
		global $db;
		$sql = "SELECT post.id as postid, gebruiker.id as gebruikerid, titel, content, datum, persoon.id, gebruiker.persoon_id
				FROM post
				LEFT JOIN gebruiker on
				post.gebruiker_id=gebruiker.persoon_id
				LEFT JOIN persoon on
				gebruiker.persoon_id=persoon.id
				WHERE post.status =0
				AND post.id = '$postid'
				ORDER BY datum DESC";
		$result = $db->prepare($sql);
		$result = $db->query($sql);
		return $result;
	}
	function editPost($postid, $contentedit, $titeledit)
	{
		
		global $db;

		$sql= "UPDATE post
				SET titel=:titeledit, content=:contentedit
				WHERE post.id='$postid'";

		$stmt = $db->prepare($sql);
		$stmt->bindParam(':titeledit', $titeledit, PDO::PARAM_STR);
		$stmt->bindParam(':contentedit', $contentedit, PDO::PARAM_STR);
		$stmt->execute();
	}
	?>	