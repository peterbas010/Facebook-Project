<?php
	function openModel()
	{
	global $db;
	$db = new PDO('mysql:host=localhost;dbname=peepzbook', 'peterbas', 'Peterbas010'); 
 	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	}

	function closeModel()
	{
	global $db;
	$db = null;	
	}

	function addUser($naam, $wachtwoord)
	{
		global $db;
		$naamreg = $_POST['naamreg'];
		$wwreg = $_POST['wwreg'];
		$sql="INSERT INTO user(name, password)VALUES('$naamreg', '$wwreg')";
		$stmt = $db->prepare( $sql );
		$stmt->bindParam(':naamreg', $name, PDO::PARAM_STR);
		$stmt->bindParam(':wwreg', $password, PDO::PARAM_STR);
		$stmt->execute();

		header("Location:index.php?msg=U kunt nu inloggen!");
	}

	function checkUser($name, $password)
	{
		global $db;

		$result = $db->prepare("SELECT * FROM user WHERE name= :name AND password= :password");
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		$result->execute();
		$rows = $result->fetch(PDO::FETCH_NUM);
		if($rows > 0) {
				session_start();
				$_SESSION['user'] = $name; 
				header("Location:home.php");
				}
		else{
				header("Location:index.php");
			}
	}
	?>