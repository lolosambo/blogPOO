
<?php 
session_cache_limiter('private_no_expire, must-revalidate');
session_start();  


ob_start();
?>



<form method="POST" action="http://www.b-log-lille.fr/p5/public/admin/index.php?p=searchUser" name="connexion">

<label for="search">Rechercher un utilisateur</label>
<input type="text" name="search" lenght=30>

<button type="submit" class="btn btn-warning" name="valider">Rechercher</button>

<br><br>

</form>

<?php 

if(isset($data['pseudo']))
{

	echo '<p>'.$data['pseudo'].' - Inscrit(e) le : '.$data['inscrDate'].'</p>';
	echo '<p>Adresse mail : '.$data['mail'].'</p>';

	if ($data['id_role'] == 1)
	{
			
		echo'<a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=changeToAdmin"><button type="button" class=" btn btn-dark">Passer en administrateur</button> </a>';
		echo'<a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=deleteUser"><button type="button" class=" btn btn-dark">Supprimer cet utilisateur</button> </a>';
			
	}
	
	else if ($data['id_role'] == 2)
	{
			
		echo '<a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=changeToUser"><button type="button" class=" btn btn-dark">Passer en utilisateur</button> </a>';
		echo'<a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=deleteUser"><button type="button" class=" btn btn-dark">Supprimer cet utilisateur</button> </a>';
			
	}

}





$title = "GESTION DES UTILISATEURS";
$content = ob_get_clean();

require('../../views/backend/admin_template.php');

?>