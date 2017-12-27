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



<form action="http://www.b-log-lille.fr/p5/public/admin/index.php?p=addedNetwork" method="POST">

	<label for="name">Nom du réseau : </label>
	<input type="text" name="name" lenght=230/><br><br>

	<label for="address">Adresse : </label>
	<input type="text" name="address" lenght=530/><br><br>

	<button type="submit" name="create" class=" btn btn-warning">Ajouter ce réseau</button>

</form>

<?php


echo '<a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=networks"><button type="button" class=" btn btn-warning">Retour à la liste des réseaux</button></a>';


$title = "GESTION DES RESEAUX SOCIAUX";
$content = ob_get_clean();

require('../../views/backend/admin_template.php');

?>

</body>
</html>