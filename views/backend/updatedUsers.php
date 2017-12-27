<?php 
session_cache_limiter('private_no_expire, must-revalidate');
session_start();  


ob_start();
?>

<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../public/css/menu.css" type="text/css">
  </head>

  <body>

<p>L'utilsateur <?= $_SESSION['foundUser'] ?> a bien été mis à jour.</p>

<form method="POST" action="http://www.b-log-lille.fr/p5/public/admin/index.php?p=searchUser" name="connexion">

	<label for="search">Rechercher un autre utilisateur</label>
	<input type="text" name="search" lenght=30>

	<button type="submit" class="btn btn-warning" name="valider">Rechercher</button>

	<br><br>

</form>


<?php 

$title = "Confirmation changement d'état utilisateur";
$content = ob_get_clean();

require('../../views/backend/admin_template.php');

?>

</body>
</html>