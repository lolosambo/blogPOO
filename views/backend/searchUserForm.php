
<?php 
 
ob_start();
?>



<form method="POST" action="index.php?p=searchUser" name="connexion">

<label for="search">Rechercher un utilisateur</label>
<input type="text" name="search" lenght=30>

<button type="submit" class="btn btn-warning" name="valider">Rechercher</button>

<br><br>

</form>

<?php 

if (isset($_POST['valider']))
{

	if($user != null)
	{

		echo '<p>'.$user->getPseudo().' - Inscrit(e) le : '.$user->getInscr_date().'</p>';
		echo '<p>Adresse mail : '.$user->getMail().'</p>';

		if ($user->getId_role() == 1)
		{
			
			echo'<a href="index.php?p=changeToAdmin"><button type="button" class=" btn btn-dark">Passer en administrateur</button> </a>';
			echo'<a href="index.php?p=deleteUser"><button type="button" class=" btn btn-dark">Supprimer cet utilisateur</button> </a>';
			
		}
	
		else if ($user->getId_role() == 2)
		{
			
			echo '<a href="index.php?p=changeToUser"><button type="button" class=" btn btn-dark">Passer en utilisateur</button> </a>';
			echo'<a href="index.php?p=deleteUser"><button type="button" class=" btn btn-dark">Supprimer cet utilisateur</button> </a>';
			
		}

	}

	else
	{
		echo '<p>Cet utilisateur n\'existe pas.</p>';
	}

}


$title = "GESTION DES UTILISATEURS";
$content = ob_get_clean();

require('../../views/templates/admin_template.php');

?>