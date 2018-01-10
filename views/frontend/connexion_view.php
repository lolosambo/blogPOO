
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8" />
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" type="text/css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" type="text/css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js" type="text/css"/>
		<link rel="stylesheet" href="css/style.css" type="text/css"/>
		<link href="https://fonts.googleapis.com/css?family=Muli|Nunito|Nunito+Sans|Oswald" rel="stylesheet"> 	
	</head>
<body>




<h3>CONNEXION</h3>

<form method="POST" action="index.php?action=connexionStatus" name="connexion">

	<label for="pseudo">Pseudo</label><br>
	<input type="text" name="pseudo" lenght=30><br><br>

	<label for="password">Mot de passe</label><br>
	<input type="password" name="password" length=30><br><br>

	<button type="submit" class="btn btn-warning" name="valider">Se connecter</button>

	<a href="index.php?action=inscriptionForm"><button type="button" class="btn btn-warning">S'inscrire</button></a><br><br>

</form>





<p><a href="forgot_password.php">J'ai oublié mon mot de passe</a></p>






</body>
</html>
