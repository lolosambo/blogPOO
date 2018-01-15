<?php 
ob_start();

while($data = $res->fetch())

{

	?>
	<br>
	<form action="index.php?p=updateNetwork&amp;networkId=<?= $data['id'] ?>" method="POST">

		<label for="network1"><?= $data['network_name'] ?></label>
		<input type="text" name="address" value="<?= $data['address'] ?>" lenght=530/><br><br>

		<button type="submit" name="update" class=" btn btn-warning">Enregistrer les modifications</button>

		<a href="index.php?p=deleteNetwork&amp;networkId=<?= $data['id'] ?>"><button type="button" class=" btn btn-warning">Supprimer ce réseau</button></a>

	</form>
	<br>


	<?php

}

echo '<a href="index.php?p=addNetwork"><button type="button" class=" btn btn-warning">Ajouter un réseau social</button>  </a>';


$title = "GESTION DES RESEAUX SOCIAUX";
$content = ob_get_clean();

require('../../views/templates/admin_template.php');

?>

</body>
</html>