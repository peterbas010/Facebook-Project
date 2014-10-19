<?php

 function home()
{
	?>
	<html lang="en">
	<head>
		<LINK rel="shortcut icon" href="images/logo.png">
		<meta charset="UTF-8">
		<link href="style.css" rel="stylesheet" type="text/css">
		<title>P-Book</title>
	</head>
	<body class="home">
		<div class="headerhome"></div>
		<div class="outerhome">
		    <span class="bannerhome">
		    <a href="home.php"><img src="images/logo-reversed.png" class="logo"></a>
			<a href="friends.php"><img src="images/friends-button.png" class="friends"></a>
			<a href="logout.php"><img src="images/logout-button.png" class="logout"></a>
			<?php
			echo "<p class='session'>" . $_SESSION['user'] . "</p>";  
			?>
			</span>
		</div>
		<div class="userpromo">
			<div class="userpromocont">
			<?php 
					getUserPromo();
			?>
			</div>
		</div>
		<div class="wall">
			<p> The wall </p>
		</div>
	</body>
	</html>
<?php

}
 function index()
{
	?>
	<html lang="en">
	<head>
	<LINK rel="shortcut icon" href="images/logo.png">
	<meta charset="UTF-8">
	<link href="style.css" rel="stylesheet" type="text/css">
	<title>P-Book</title>
	</head>
	<body class="index">
		<div class="headerindex"></div>
		<div class="outerindex">
		    <span class="bannerindex">
		    <a href="index.php"><img src="images/naam.png" class="naam"></a>
		    	<form method="post" action="index.php?actie=login">
				  <p>
				   <label class="naam">Naam</label>
				   <input type="text" name="name" class="naam" />
				  </p>
				  <p>
				   <label class="wachtwoord">Wacthwoord</label>
				   <input type="password" name="password" class="wachtwoord" />
				  </p>
				  </p>
					<input name="login" type="submit" value="Lets Go!" class="aanmelden" />
				  </p>
			</span>
			</form>
		</div>
		<div class="contentindex">
			<div class="boodschap">
			<img src="images/promo.png">
			</div>
			<div class="registratie">
			<h2> Nog geen account? Registreer hier!</h2>
			<form method="post" action="index.php?actie=register">
				  <p>
				   <label class="naamreg">Naam</label>
				   <input class="naamreg" type="text" name="naamreg" />
				  </p>
				  <p>
				   <label class="wwreg">Wacthwoord</label>
				   <input class="wwreg" type="password" name="wwreg" />
				  </p>
				  <p>
				   <label class="regrep">(Herhaal)Wacthwoord</label>
				   <input class="regrep" type="password" name="wwrep"/>
				  </p>
				  </p>
					<input name="register" class="register" type="submit" value="Registreren"/>
				  </p>
				  </form>
				 <?php echo "<h3>" . $msg . "</h3>" ?>
			</div>
		</div>
	</body>
	</html>
<?php

}

?>