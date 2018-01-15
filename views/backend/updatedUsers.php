<?php 
ob_start();
?>



<p>L'utilsateur <?= $_SESSION['foundUser'] ?> a bien été mis à jour.</p>

<form method="POST" action="index.php?p=searchUser" name="connexion">

	<label for="search">Rechercher un autre utilisateur</label>
	<input type="text" name="search" lenght=30>

	<button type="submit" class="btn btn-warning" name="valider">Rechercher</button>

	<br><br>

</form>


<?php 

$title = "Confirmation changement d'état utilisateur";
$content = ob_get_clean();

require('../../views/templates/admin_template.php');

?>
