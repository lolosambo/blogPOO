<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" href="css/style.css" type="text/css"/>


</head>
<body>




<h3>CONNEXION</h3>

<form method="POST" action="http://www.b-log-lille.fr/p5/index.php?action=connexionStatus" name="connexion">

	<label for="pseudo">Pseudo</label><br>
	<input type="text" name="pseudo" lenght=30><br><br>

	<label for="password">Mot de passe</label><br>
	<input type="password" name="password" length=30><br><br>

	<button type="submit" class="btn btn-warning" name="valider">Se connecter</button>

	<a href="http://www.b-log-lille.fr/p5/index.php?action=inscriptionForm"><button type="button" class="btn btn-warning">S'inscrire</button></a><br><br>

</form>





<p><a href="forgot_password.php">J'ai oublié mon mot de passe</a></p>






</body>
</html>
