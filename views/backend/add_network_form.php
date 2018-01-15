<?php 
ob_start();

?>


<form action="index.php?p=addedNetwork" method="POST">

	<label for="name">Nom du réseau : </label>
	<input type="text" name="name" lenght=230/><br><br>

	<label for="address">Adresse : </label>
	<input type="text" name="address" lenght=530/><br><br>

	<button type="submit" name="create" class=" btn btn-warning">Ajouter ce réseau</button>

</form>

<?php


echo '<a href="index.php?p=networks"><button type="button" class=" btn btn-warning">Retour à la liste des réseaux</button></a>';


$title = "GESTION DES RESEAUX SOCIAUX";
$content = ob_get_clean();

require('../../views/templates/admin_template.php');

?>
