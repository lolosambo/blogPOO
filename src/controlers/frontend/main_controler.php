<?php 
session_cache_limiter('private_no_expire, must-revalidate');
session_start(); 

require('model/frontend/model.php');


// POSTS CONTROLER---------------------------------

function getPostsList()
{

	$posts = getPosts(0, 1000000);

	require('views/frontend/list_posts_view.php');

}



function getSinglePost($post_id, $comment_id)
{

	$post = getPost($post_id);
	$comments = getComments($comment_id);

	require('views/frontend/post_view.php');

}


// COMMENTS CONTROLER
function addComment()
{

	if($_SESSION['id_role'] == 1)
	{
	addCommentMembers($_GET['postId'], $_SESSION['id'], $_POST['comment']);
	}
	else if($_SESSION['id_role'] == 2)
	{
	addCommentAdmin($_GET['postId'], $_SESSION['id'], $_POST['comment']);
	}
}



// SESSION CONTROLER--------------------------------

function setSession($pseudo, $password)
{

	if(isset($_POST['valider']))
	{
		$user= getUser($pseudo, $password);

			if (isset($user['pseudo'])) 
			{
				
				$_SESSION['pseudo'] = $user['pseudo'];
				$_SESSION['id'] = $user['id'];
				$_SESSION['id_role'] = $user['id_role'];
				$_SESSION['verified'] = $user['verified'];
					
			}

	}

}

function deleteSession()
{
	session_destroy();



}


// USER CONTROLER------------------------------------

function newUser($pseudo, $password1, $password2, $mail)
{
	
	$user = compareUsers($pseudo);
	$_SESSION['db_pseudo'] = $user['pseudo'];
	
	if ($pseudo == $user['pseudo'])
	{
		
		// require('views/inscription_view.php');
		// echo '<p>Ce pseudo existe déjà</p>';
		
	}

	else if (empty($pseudo) || empty($password1) || empty($password2) || empty($mail))
	{
		
		// require('views/inscription_view.php');
		// echo '<p>Veuillez remplir tous les champs</p>';
		

	}

	else if ($password1 !== $password2)
	{
		// require('views/inscription_view.php');
		// echo '<p>Les 2 mots de passe doivent être identiques</p>';
	}
	
	else
	{
		insertUser($pseudo, $password1, $mail);
		// echo '<p>Votre inscription a bien été prise en compte.</p>';
		// echo '<p>Vérifiez votre boîte mail, un courriel de confirmation vous a été envoyé.</p>';
		// Confirmation Mail

		$objet = 'Confirmation de votre inscription sur le blog de Laurent BERTON' ;
		$to = $mail;
		$header =
		'Content-type: text/html; charset=utf-8' . "\r\n" .
		'From: contact@b-log-lille.fr' . "\r\n" .
		'Reply-To: contact@b-log-lille.fr' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

		$message = 
		'<p>Bonjour '.ucfirst($pseudo).' et bienvenue sur le blog professionnel de Laurent BERTON,</p>
 
		<p>Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur.</p>
 
		<p>http://www.b-log-lille.fr/p5/index.php?action=activation&amp;log='.$pseudo.'&amp;key='.$_SESSION['activation_key'].'</p><br><br>
 
 
		---------------<br>
		<p>Ceci est un mail automatique, Merci de ne pas y répondre.</p>';
          
		//Send mail
		mail($to, $objet, $message, $header);
	}
	
	
}



function account_activation($pseudo, $activKey)
{

	$res = accActivation($pseudo, $activKey);
	$activationKey = $res['activation_key'];	
    $verified = $res['verified']; 

    
    if($verified == '1') 
 	{
    	// echo "Votre compte est déjà actif !";
  	}
	else 
  	{
    	if($activKey == $activationKey) 
      		{
          		
          		// echo "<p>Votre compte a bien été activé !</p>
          		// <p>Vous pouvez maintenant <a href='http://www.b-log-lille.fr/p5/index.php'>vous connecter</a>";

          		setValidated($pseudo);
      		}
     	else // if the two keys are different
       		{
         		// echo "Erreur ! Votre compte ne peut être activé...";
      		}
  	}

 $_SESSION['activKey'] = $activKey;
 $_SESSION['activationKey'] = $activationKey;
 $_SESSION['update_verfied'] =  $verified;


}

function postsPagination()
{

	$total = getTotalPosts();
	$postsNbr = $total['total'];

	$postsPerPage = 4; // Change the number of posts in the homepage

	$pagesNbr = ceil($postsNbr/$postsPerPage);


		if(isset($_GET['page'])) 
    	{ 
    		$currentPage=intval($_GET['page']);
 
     			if($currentPage>$pagesNbr)
     			{
        		  	$currentPage=$pagesNbr;
    			}
		}
		else
		{
     		$currentPage=1;   
		}

	$firstEntry = ($currentPage-1) * $postsPerPage;

	$posts = getPosts($firstEntry, $postsPerPage);

require('views/frontend/list_posts_view.php');

}


function sendMail($name, $mail, $phone, $object, $message)

{

		$objet = 'Nouveau message de B-LOG' ;
		$to = 'contact@b-log-lille.fr';
		$header =
		'Content-type: text/html; charset=utf-8' . "\r\n" .
		'From: contact@b-log-lille.fr' . "\r\n" .
		'Reply-To: '.$mail."\r\n" .
		'X-Mailer: PHP/' . phpversion();

		$message = 
		'<p>Message en provenance de '.$name.'.</p>
		<p>Numéro de téléphone : '.$phone.'</p>
		<p>Adresse mail : '.$mail.'</p>
		<p>Sujet du message : '.$object.'</p>
		<p>Message : '.$message.'</p>';
		
          
		//Send mail
		mail($to, $objet, $message, $header);		

}


	
	
	












