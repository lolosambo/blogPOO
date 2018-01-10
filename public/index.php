<?php
session_cache_limiter('private_no_expire, must-revalidate');
session_start(); 
require '../vendor/autoload.php';

use p5\managers\PostsManager;
use p5\managers\UsersManager;
use p5\controllers\frontend\UsersController;
use p5\controllers\frontend\PostsController;
use p5\controllers\frontend\PaginationController;


$postcont= new PostsController();
$postman = new PostsManager();
$userman = new UsersManager();
$usercont = new UsersController();
$pagincont = new PaginationController();

?>
<!DOCTYPE html>
<html>
<head>
	

</head>
<body>

<?php




if (isset($_GET['action']))
{
	if (($_GET['action'] == 'posts') || ($_GET['action'] == 'page'))
	{
		
		$postcont->allPosts($postman, $pagincont);

	}

	else if ($_GET['action'] == 'singlePost')
	{
		if ($_GET['id'] > 0)
		{
			$res = $postcont->onePost($postman, $_GET['id']);
			
		}

		else
		{
			echo 'L\'article n\'a pas pu être trouvé.';
		}
	}


	else if ($_GET['action'] == 'connexionStatus')
	{
		$usercont->userConnexion($userman, $_POST['pseudo'], $_POST['password']);
		$postcont->allPosts($postman, $pagincont);
	}

	else if ($_GET['action'] == 'inscriptionForm')
	{
		$postcont->allPosts($postman, $pagincont);
	}

	else if ($_GET['action'] == 'inscriptionStatus')
	{
		$pseudo = $_POST['pseudo'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$mail = $_POST['mail'];
		$usercont->insertUser($userman, $pseudo, $password1, $password2, $mail);
		$postcont->allPosts($postman, $pagincont);
	}
	else if ($_GET['action'] =='logout')
	{
		$usercont->destroySession();
		$postcont->allPosts($postman, $pagincont);
		
	}



}

else
{
	$usercont->destroySession();
	$postcont->allPosts($postman, $pagincont);

}






?>



</body>
</html>