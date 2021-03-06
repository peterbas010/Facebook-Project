
<!-- START BLOCK : index -->
<html lang="en">
<head>
	<link rel="shortcut icon" href="images/logo.ico">
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
				   <label class="naam">Email</label>
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
<!-- START BLOCK : register -->
			<h2> Nog geen account? Registreer hier!</h2>
			<form method="post" action="index.php?actie=register">
				  <p>
				   <label class="naamreg">Email</label>
				   <input class="naamreg" type="text" name="naamreg" />
				  </p>
				  <p>
				   <label class="wwreg">Wacthwoord</label>
				   <input class="wwreg" type="password" name="wwreg" />
				  </p>
					<input name="register" class="register" type="submit" value="Registreren"/>
				  </p>
				  </form>
<!-- END BLOCK : register -->
<!-- START BLOCK : gegevens -->
			<form method="post" action="index.php?actie=register">
				  <p>
				   <label class="voornaam">Voornaam</label>
				   <input class="voornaam" type="text" name="voornaam" />
				  </p>
				  <p>
				   <label class="achternaam">Achternaam</label>
				   <input class="achternaam" type="text" name="achternaam" />
				  </p>
				  <p>
				   <label class="gbdatum">Geboortedatum</label>
				   <input class="gbdatum" type="date" name="geboortedatum"/>
				  </p>
				  <p>
				   <label class="adres">Adres</label>
				   <input class="adres" type="text" name="adres"/>
				  </p>
				  <p>
				   <label class="postcode">Postcode</label>
				   <input class="postcode" type="text" name="postcode"/>
				  </p>
				  <p>
				   <label class="woonp">Woonplaats</label>
				   <input class="woonp" type="text" name="woonplaats"/>
				  </p>
				  <p>
				   <label class="mobiel">Mobiel</label>
				   <input class="mobiel" type="text" name="mobiel"/>
				  </p>
				  <p>
				   <label class="tel">Telefoon</label>
				   <input class="tel" type="text" name="telefoon"/>
				  </p>
				  <input type="hidden" name="naamreg" value="{EMAIL}">
				  <input type="hidden" name="wwreg" value="{PASSWORD}">
				  </p>
					<input name="gegevens" class="register2" type="submit" value="Registreren"/>
				  </p>
				  </form>
<!-- END BLOCK : gegevens -->
			</div>
		</div>
</body>
</html>
<!-- END BLOCK : index -->


<!-- START BLOCK : home -->
<html lang="en">
<head>
	<link rel="shortcut icon" href="images/logo.ico">
	<meta charset="UTF-8">
	<link href="style.css" rel="stylesheet" type="text/css">
	<title>P-Book</title>
</head>
<body class="home">
	<div class="headerhome"></div>
	<div class="outerhome">
	    <span class="bannerhome">
	    <a href="index.php?actie=home"><img src="images/logo-reversed.png" class="logo"></a>
		<a href="friends.php"><img src="images/friends-button.png" class="friends"></a>
		<a href="index.php?actie=logout"><img src="images/logout-button.png" class="logout"></a>
		</span>
	</div>
<!-- START BLOCK : userpromo -->
	<div class="userpromo">
		<div class="userpromocont">
		<img class="promoimg" src="profielfoto/standaard.png"></a>
		<p>{VOORNAAM} {ACHTERNAAM}</p> 
		<p>{WOONPLAATS}</p>
		<a href="index.php?actie=eigenprofiel"><i>Profiel Weergeven!</i></a>
		</div>
	</div>
<!-- END BLOCK : userpromo -->
<!-- START BLOCK : wallpost -->
	<div class="wall">
		<form method="post" action="index.php?actie=post">
		<input class="titelveld" name="titelveld" type="text"  placeholder="Titel" />
		<textarea class="postveld" name="postveld" cols="40" rows="5" placeholder="Wat heb je vandaag gedaan?"></textarea>
		<input name="postknop" type="submit" value="Post!" class="postknop" />
		</form>
		<div class="wallcontent">
<!-- END BLOCK : wallpost -->
<!-- START BLOCK : wall -->
			<div class="post">
			<h2 class="naam"><a href="index.php?actie=profiel&email={EMAIL}">{VOORNAAM} {ACHTERNAAM}</a></h2>
			<h2 class="titel">{TITEL}</h2>
			<p class="postcontent">{CONTENT}</p>
			<p class="postdatum">Geplaatst op: {DATUM}</p>
			</div>
<!-- END BLOCK : wall -->
		</div>
	</div>
	</body>
</html>
<!-- END BLOCK : home --> 
<!-- START BLOCK : profiel -->
<div class="profiel">
		<img class="userimage" src="profielfoto/standaard.png"></a>
		<div class="profielinhoud">
			<h2>{VOORNAAM} {ACHTERNAAM}</h2> 
			<p><b>Geboortedatum: {GEBOORTEDATUM}</b></p>
			<p><b>Adres: {ADRES}</b></p>
			<p><b>Postcode: {POSTCODE}</b></p>
			<p><b>Woonplaats: {WOONPLAATS}</b></p>
			<p><b>Telefoonnr: {TELEFOON}</b></p>
			<p><b>Mobiel: {MOBIEL}</b></p>
<!-- START BLOCK : profieledit -->
			<p><i><a href="index.php?actie=edit">Profiel Bewerken!</a></i></p>
<!-- END BLOCK : profieledit -->
		</div>
</div>
<!-- END BLOCK : profiel -->
<!-- START BLOCK : edit -->
<div class="editinhoud">
<form method="post" action="index.php?actie=editcheck">
				  <p>
				   <label class="vooredit">Voornaam</label>
				   <input class="vooredit" type="text" name="vooredit" value="{VOORNAAM}"  />
				  </p>
				  <p>
				   <label class="achteredit">Achternaam</label>
				   <input class="achteredit" type="text" name="achteredit" value="{ACHTERNAAM}"  />
				  </p>
				  <p>
				   <label class="gbedit">Geboortedatum</label>
				   <input class="gbedit" type="date" name="gbedit" value="{GEBOORTEDATUM}" />
				  </p>
				  <p>
				   <label class="adresedit">Adres</label>
				   <input class="adresedit" type="text" name="adresedit" value="{ADRES}" />
				  </p>
				  <p>
				   <label class="postedit">Postcode</label>
				   <input class="postedit" type="text" name="postedit" value="{POSTCODE}" />
				  </p>
				  <p>
				   <label class="woonedit">Woonplaats</label>
				   <input class="woonedit" type="text" name="woonedit" value="{WOONPLAATS}" />
				  </p>
				  <p>
				   <label class="mobedit">Mobiel</label>
				   <input class="mobedit" type="text" value="{MOBIEL}"  name="mobedit"/>
				  </p>
				  <p>
				   <label class="teledit">Telefoon</label>
				   <input class="teledit" type="text" value="{TELEFOON}" name="teledit"/>
				  </p>
				  <p>
					<input name="editknop" class="editknop" type="submit" value="Bewerken!"/>
				  </p>
				  </form>
</div>
<!-- END BLOCK : edit -->
<!-- START BLOCK : profielwall -->
			<div class="profielpost">
			<h2 class="naam"><a href="index.php?actie=profiel">{VOORNAAM} {ACHTERNAAM}</a></h2>
			<h2 class="titel">{TITEL}</h2>
			<p class="postcontent">{CONTENT}</p>
			<p class="postdatum">Geplaatst op: {DATUM}</p>
			</div>
<!-- END BLOCK : profielwall -->
<!-- START BLOCK : eigenwall -->
			<div class="profielpost">
			<h2 class="naam"><a href="index.php?actie=profiel">{VOORNAAM} {ACHTERNAAM}</a></h2>
			<h2 class="titel">{TITEL}</h2>
			<p class="postcontent">{CONTENT}</p>
			<p><a href="index.php?actie=verwijderen&id={POSTID}"><img class="delimg" src="images/delbutton.png"> </a></p>
			<p><a href="index.php?actie=editpost&id={POSTID}"><img class="editimg" src="images/editbutton.png"> </a></p>
			<p class="postdatum">Geplaatst op: {DATUM}</p>
			</div>
<!-- END BLOCK : eigenwall -->
<!-- START BLOCK : verwijderen -->
	<h1>Weet u zeker dat u dit wilt verwijderen?</h1>
	<form action="index.php?actie=verwijderen" method="POST">
		<label for="namen">Naam : </label>
		<input type="text" name="namen" value="{VOORNAAM}{ACHTERNAAM}"disabled><br>
		
		<label for="titel">Titel : </label>
		<input type="text" name="titel" value="{TITEL}"disabled><br>

		<label for="content">Content : </label>
		<input type="text" name="content" value="{CONTENT}" disabled><br>

		<input type="hidden" name="postid" value="{POSTID}">
		<input type="submit" name="ja" value="ja">
		<input type="submit" name="nee" value="nee">
	</form>
<!-- END BLOCK : verwijderen -->
<!-- START BLOCK : editpost -->
<div class="editpost">
<form method="post" action="index.php?actie=editpostcheck&id={POSTID}">
	<label class="titeledit">Titel:</label>
	<input class="titeledit" name="titeledit" type="text"  placeholder="{TITEL}" />
	<label class="contentedit">Content:</label>
	<textarea class="contentedit" name="contentedit" cols="40" rows="5" placeholder="{CONTENT}"></textarea>
	<input name="editknop" class="editknop" type="submit" value="Bewerken!"/>
	</form>
</div>
<!-- END BLOCK : editpost -->


