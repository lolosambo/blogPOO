<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" href="css/style.css" type="text/css"/>


</head>
<body>






<form method="POST" action="index.php?action=contact" name="contact" class="contactForm">

	<h3>CONTACTEZ-MOI</h3><br><br>

	<label for="name">Votre nom : </label>
	<input type="name" name="name" lenght=30 required><br><br>

	<label for="phone">Téléphone (optionnel) : </label>
	<input type="phone" name="phone" lenght=30><br><br>

	<label for="message">Mail : </label>
	<input type="mail" name="mail" lenght=30 required><br><br>

	<label for="object">Objet : </label>
	<input type="text" name="object" lenght=30 required><br><br>

	<label for="message" required>Message : </label><br>
	<textarea name="message" cols=10 rows=50/></textarea><br><br>

<!--
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<div class="g-recaptcha" data-sitekey="6LeVwz0UAAAAAIj5SV_oArSrmS-jM4neQaP5nOvh"></div><br><br>
-->


	<button type="submit" class="btn btn-warning" name="valider">Envoyer</button><br>

</form><br>

<?php

if (isset($_POST['valider']))
{
	echo 'Votre message a bien été transmis, vous recevrez une réponse dans les plus brefs délais.<br><br><br><br>';
}

?>

</body>
</html>
