<?php 
session_cache_limiter('private_no_expire, must-revalidate');
session_start();  


ob_start();

?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../public/css/menu.css" type="text/css">
</head>

<body>

<?php 

while($data = $res->fetch())

{

	?>
	<br>
	<form action="http://www.b-log-lille.fr/p5/public/admin/index.php?p=updateNetwork&amp;networkId=<?= $data['id'] ?>" method="POST">

		<label for="network1"><?= $data['network_name'] ?></label>
		<input type="text" name="address" value="<?= $data['address'] ?>" lenght=530/><br><br>

		<button type="submit" name="update" class=" btn btn-warning">Enregistrer les modifications</button>

		<a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=deleteNetwork&amp;networkId=<?= $data['id'] ?>"><button type="button" class=" btn btn-warning">Supprimer ce réseau</button></a>

	</form>
	<br>


	<?php

}

echo '<a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=addNetwork"><button type="button" class=" btn btn-warning">Ajouter un réseau social</button>  </a>';


$title = "GESTION DES RESEAUX SOCIAUX";
$content = ob_get_clean();

require('../../views/backend/admin_template.php');

?>

</body>
</html>