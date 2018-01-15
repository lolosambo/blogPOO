<?php 
require '../../vendor/autoload.php';
use p5\app\Session;
$session = new Session();
$session->startSession();


use p5\managers\PostsManager;
use p5\managers\CommentsManager;
use p5\managers\UsersManager;
use p5\managers\NetworksManager;
use p5\controllers\backend\AdminUsersController;
use p5\controllers\backend\AdminPostsController;
use p5\controllers\backend\AdminCommentsController;
use p5\controllers\backend\ImagesController;
use p5\controllers\frontend\NetworksController;
use p5\controllers\frontend\PaginationController;



$postcont= new AdminPostsController();
$userman = new UsersManager();
$postman = new PostsManager();
$commentman = new CommentsManager();
$commentcont = new AdminCommentsController();
$usercont = new AdminUsersController();
$pagincont = new PaginationController();
$imgcont = new ImagesController();
$networkman = new NetworksManager();
$networkcont = new NetworksController();



if (isset($_GET['p']))
{

// USERS SECTION

	if ($_GET['p'] == 'searchUser')
	{
		
		if(isset($_POST['search']))
		{
			$search = htmlspecialchars($_POST['search']);
			$usercont->searchUserForm($userman, $search);

		}

		else
		{
			require('../../views/backend/searchUserForm.php');
		}

	}

	else if ($_GET['p'] == 'changeToAdmin')
	{
		$usercont->changeToAdmin($userman, $session->getSessionVar('foundUser'));
	}

	else if ($_GET['p'] == 'changeToUser')
	{
		$usercont->changeToUser($userman, $session->getSessionVar('foundUser'));
	}

	else if ($_GET['p'] == 'deleteUser')
	{
		$usercont->deleteUser($userman, $session->getSessionVar('foundUser'));
	}



//POSTS SECTION

	else if ($_GET['p'] == 'posts')
	{
		$postcont->showPosts($postman, $pagincont);
	}

	
	else if ($_GET['p'] == 'addPostForm')
	{

		$postcont->addPostForm();
	}



	else if ($_GET['p'] == 'addPost')
	{

		$title = htmlspecialchars($_POST['title']);
		$heading = htmlspecialchars($_POST['heading']);
		$content = htmlspecialchars($_POST['content']);


		if(isset($_POST['publier']))
		{
	
			$img_url = $imgcont->verifyImg();

			if(isset($img_url))
			{
				$postcont->addPost($postman, $_SESSION['id'], $title, $heading, $content, $img_url);
			}

			else
			{
				$imgcont->img_message();
			}
		}

		else
		{
    		echo $error;
		}
		
	}

	else if ($_GET['p'] == 'updatePost')
	{
		
		$postId = intval($_GET['postId']);
		$postcont->selectPost($postman, $postId);

	}

	else if ($_GET['p'] =='postUpdated')
	{
		
		$title = htmlspecialchars($_POST['title']);
		$heading = htmlspecialchars($_POST['heading']);
		$content = htmlspecialchars($_POST['content']);
		$postId = intval($_GET['postId']);

		$postcont->updatePost($postman, $postId, $title, $heading, $content);
	
	}

	else if ($_GET['p'] == 'deletePost')
	{
		$postId = intval($_GET['postId']);
		$postcont->deletePost($postman, $postId);
	}
	

// COMMENTS SECTION

	else if ($_GET['p'] == 'comments')
	{
		$commentcont->allUnvalidComments($commentman, $pagincont);
	}

	else if ($_GET['p'] == 'validComment')
	{

		$commentId = intval($_GET['commentId']);
		$commentcont->validComment($commentman, $commentId);
		
	}

	else if ($_GET['p'] == 'refuseComment')
	{

		$commentId = intval($_GET['commentId']);
		$commentcont->refuseComment($commentman, $commentId);
		
	}


// // CV SECTION
// 	else if ($_GET['p'] == 'cv')
// 	{
// 		showCv();
// 	}


// SOCIAL NETWORKS SECTION

	else if ($_GET['p'] == 'networks')
	{
		$networkcont->showNetworks($networkman);
	}
	else if ($_GET['p'] == 'addNetwork')
	{
		$networkcont->addNetwork($networkman);
	}
	else if ($_GET['p'] == 'addedNetwork')
	{
		$name = htmlspecialchars($_POST['name']);
		$address = htmlspecialchars($_POST['address']);

		$networkcont->addedNetwork($networkman, $name, $address);
	}

	else if ($_GET['p'] == 'updateNetwork')
	{
		$address = htmlspecialchars($_POST['address']);

		$networkcont->updateNetwork($networkman, $_GET['networkId'], $address);
	}
	else if ($_GET['p'] == 'deleteNetwork')
	{
		$networkId = intval($_GET['networkId']);
		$networkcont->deleteNetwork($networkman, $networkId);
	}

}

else if (isset($_GET['page']))
{
	$postcont->showPosts($postman, $pagincont);

}

else if (isset($_GET['cpage']))
	{
		$commentcont->allUnvalidComments($commentman, $pagincont);
	}

else
{

	if($session->getSessionVar('id_role') != 2)
	{
		echo '<p>Section non autorisée</p>';
		echo '<p><a href="../index.php">Revenir au blog</a></p>';
	}
	else
	{
	$usercont->showDaschboard($userman, $postman, $commentman);
	}

}






