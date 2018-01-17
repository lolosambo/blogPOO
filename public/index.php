<?php
require '../vendor/autoload.php';
use p5\builders\Builder;

$builder = new Builder();
$session = $builder->createApp('session')->build();
$session->startSession();

$postcont = $builder->createFrontController('posts')->build();
$usercont = $builder->createFrontController('users')->build();
$commentcont = $builder->createFrontController('comments')->build();
$pagincont = $builder->createFrontController('pagination')->build();




if (isset($_GET['action']))
{
	
	if (($_GET['action'] == 'posts') || ($_GET['action'] == 'page'))
	{
		
		$postcont->allPosts($builder);

	}

	else if ($_GET['action'] == 'singlePost')
	{
		if ($_GET['postId'] > 0)
		{
			$res = $postcont->onePost($builder, $_GET['postId']);
			
			
		}

		else
		{
			echo 'L\'article n\'a pas pu être trouvé.';
		}
	}

	else if ($_GET['action'] == 'addComment')
	{
		
		$postId = intval($_GET['postId']);
		$comContent = htmlspecialchars($_POST['comment']);
		$commentcont->addComment($builder, $postId, $session->getSessionVar('id'), $comContent);
		$onePost = $postcont->onePost($builder, $postId);

	}


	else if ($_GET['action'] == 'connexionStatus')
	{
		$user = $usercont->userConnexion($builder, $_POST['pseudo'], $_POST['password']);
		
		$postcont->allPosts($builder);
	}

	else if ($_GET['action'] == 'inscriptionForm')
	{
		$postcont->allPosts($builder);
	}

	else if ($_GET['action'] == 'inscriptionStatus')
	{
		$pseudo = $_POST['pseudo'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$mail = $_POST['mail'];
		$usercont->insertUser($builder, $pseudo, $password1, $password2, $mail);
		$postcont->allPosts($builder);
	}
	
	else if ($_GET['action'] == 'activation')
	{
		$log = $_GET['log'];
		$key = $_GET['key'];
		$usercont->account_activation($builder, $log, $key);
		$postcont->allPosts($builder);
	}
	else if ($_GET['action'] == 'logout')
	{
		$usercont->destroySession($builder);
		$postcont->allPosts($builder);
		
	}
	
	else if ($_GET['action'] == 'contact')
	{
		
		$name = htmlspecialchars($_POST['name']);
		$mail = htmlspecialchars($_POST['mail']);
		$phone = htmlspecialchars($_POST['phone']);
		$object = htmlspecialchars($_POST['object']);
		$message = htmlspecialchars($_POST['message']);
		$usercont->sendMailContact($name, $mail, $phone, $object, $message);
		$postcont->allPosts($builder);
		
	}



}

else
{
	
	$postcont->allPosts($builder);

}






?>



</body>
</html>