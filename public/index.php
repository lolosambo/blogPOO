<?php
require '../vendor/autoload.php';
use p5\app\Session;
$session = new Session();
$session->startSession();


use p5\managers\PostsManager;
use p5\managers\CommentsManager;
use p5\managers\UsersManager;
use p5\controllers\frontend\UsersController;
use p5\controllers\frontend\PostsController;
use p5\controllers\frontend\CommentsController;
use p5\controllers\frontend\PaginationController;


$postcont= new PostsController();
$postman = new PostsManager();
$commentman = new CommentsManager();
$commentcont = new CommentsController();
$userman = new UsersManager();
$usercont = new UsersController();
$pagincont = new PaginationController();



if (isset($_GET['action']))
{
	
	if (($_GET['action'] == 'posts') || ($_GET['action'] == 'page'))
	{
		
		$postcont->allPosts($postman, $pagincont);

	}

	else if ($_GET['action'] == 'singlePost')
	{
		if ($_GET['postId'] > 0)
		{
			$res = $postcont->onePost($postman, $commentcont, $commentman, $_GET['postId']);
			
			
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
		$commentcont->addComment($commentman, $postId, $session->getSessionVar('id'), $comContent);
		$onePost = $postcont->onePost($postman, $commentcont, $commentman, $postId);

	}


	else if ($_GET['action'] == 'connexionStatus')
	{
		$user = $usercont->userConnexion($userman, $_POST['pseudo'], $_POST['password']);
		
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
	else if ($_GET['action'] == 'logout')
	{
		$usercont->destroySession();
		$postcont->allPosts($postman, $pagincont);
		
	}



}

else
{
	
	$postcont->allPosts($postman, $pagincont);

}






?>



</body>
</html>