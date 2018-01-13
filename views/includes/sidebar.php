<?php 
require '../vendor/autoload.php';
use p5\app\Session;
$session = new Session();

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="css/bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
		<link rel="stylesheet" href="css/style.css" type="text/css"/>
		<link href="https://fonts.googleapis.com/css?family=Muli|Nunito|Nunito+Sans|Oswald" rel="stylesheet"> 	
	</head>
	
<body>

	
<?php 




//Show connexion form
if (!isset($_GET['action']) && ($session->getSessionVar('pseudo') == FALSE))
{
	require('../views/frontend/connexion_view.php');
}

else if ($_GET['action'] == 'logout')
{
	require('../views/frontend/connexion_view.php');
}


//Show inscription form
else if ($_GET['action'] == 'inscriptionForm')
{
	require('../views/frontend/inscription_view.php');
}


// Error message If invalid pseudo or password

else if (($_GET['action'] == 'connexionStatus') && ($session->getSessionVar('pseudo') == FALSE))
{
	require('../views/frontend/connexion_view.php');
	echo '<p>Identifiant et/ou mot de passe invalide(s)</p>';
	echo '<p>Pour vous connecter et laisser des commentaires, merci de <a href ="index.php?action=inscriptionForm">créer un compte</a></p>';

}

//Show connexion status after success login
else if (isset($_GET['action']) && ($session->getSessionVar('pseudo') != null))
{

	if($session->getSessionVar('id_role') == 2)
	{
		
		echo '<p>Bonjour '.$session->getSessionVar('pseudo').'</p>';
		echo '<p><a href="/admin/">Accéder à l\'administration</a></p>';
		echo '<p><a href="index.php?action=logout">Se déconnecter</a></p>';
		
	}
	else if($session->getSessionVar('id_role') == 1)
	{
		
		echo '<p>Bonjour '.$session->getSessionVar('pseudo').'</p>';
		echo '<p><a href="index.php?action=logout">Se déconnecter</a></p>';
		
	}

}


else if ($_GET['action'] == 'inscriptionStatus')
{

	if ($_POST['pseudo'] == $session->getSessionVar('db_pseudo'))
	{
		
		require('../views/frontend/inscription_view.php');
		echo '<p>Ce pseudo existe déjà</p>';
		echo '<p><a href="index.php">Revenir à la page de connexion<a></p>';
		
	}

	else if (empty($_POST['pseudo']) || empty($_POST['password1']) || empty($_POST['password2']) || empty($_POST['mail']))
	{
		
		require('../views/frontend/inscription_view.php');
		echo '<p>Veuillez remplir tous les champs</p>';
		echo '<p><a href="index.php">Revenir à la page de connexion<a></p>';
		

	}

	else if ($_POST['password1'] !== $_POST['password2'])
	{
		require('../views/frontend/inscription_view.php');
		echo '<p>Les 2 mots de passe doivent être identiques</p>';
		echo '<p><a href="index.php">Revenir à la page de connexion<a></p>';
	}
	
	else
	{
		
		echo '<p>Votre inscription a bien été prise en compte.</p>';
		echo '<p>Vérifiez votre boîte mail, un courriel de confirmation vous a été envoyé.</p>';
		echo '<p><a href="index.php">Revenir à la page de connexion<a></p>';
	}

}


// if ($_GET['action'] == "activation")
// {
   

//    if($session->getSession('update_verified') == '1') 
//  	{
//     	echo "Votre compte est déjà actif !";
//   	}
// 	else 
//   	{
//     	if( $session->getSession('activKey') ==  $session->getSession('activationKey')) 
//       		{
          		
//           		echo "<p>Votre compte a bien été activé !</p>
//           		<p>Vous pouvez maintenant <a href='index.php'>vous connecter</a>";

          		
//       		}
//      	else // if the two keys are different
//        		{
//          		echo "Erreur ! Votre compte ne peut être activé...";
//       		}
//   	}

// }



























?>

</body>
</html>