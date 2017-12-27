
<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="public/bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
		<link rel="stylesheet" href="public/css/style.css" type="text/css"/>	
	</head>
	
<body>

<h3>INSCRIPTION</h3>

<form method="POST" action="http://www.b-log-lille.fr/p5/index.php?action=inscriptionStatus" name="inscription">

	<label for="pseudo">Pseudo</label><br>
	<input type="text" name="pseudo" lenght=30><br><br>

	<label for="password1">Mot de passe</label><br>
	<input type="password" name="password1" length=30><br><br>

	<label for="password2">Confirmez le mot de passe</label><br>
	<input type="password" name="password2" length=30><br><br>

	<label for="mail">Adresse e-mail</label><br>
	<input type="text" name="mail" lenght=100><br><br>

	<button type="submit" name="inscrire" class="btn btn-warning">S'inscrire</button><br><br>

</form>


</body>
</html>
