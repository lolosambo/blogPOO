<?php 
require '../../vendor/autoload.php';
use p5\app\Session;
$session = new Session();
$session->startSession();


use p5\managers\PostsManager;
use p5\managers\CommentsManager;
use p5\managers\UsersManager;
use p5\controllers\backend\AdminUsersController;
use p5\controllers\backend\AdminPostsController;
use p5\controllers\backend\AdminCommentsController;
use p5\controllers\frontend\PaginationController;


$postcont= new AdminPostsController();
$userman = new UsersManager();
$postman = new PostsManager();
$commentman = new CommentsManager();
$commentcont = new AdminCommentsController();
$usercont = new AdminUsersController();
$pagincont = new PaginationController();



if (isset($_GET['p']))
{


// USERS SECTION

	if ($_GET['p'] == 'searchUser')
	{
		
		if(isset($_POST['search']))
		{
			$search = htmlspecialchars($_POST['search']);
			$usercont->searchUserForm($search);

		}

		else
		{
			require('../../views/backend/searchUserForm.php');
		}

	}

	else if ($_GET['p'] == 'changeToAdmin')
	{
		$usercont->changeToAdmin($_SESSION['foundUser']);
	}

	else if ($_GET['p'] == 'changeToUser')
	{
		$usercont->changeToUser($_SESSION['foundUser']);
	}

	else if ($_GET['p'] == 'deleteUser')
	{
		$usercont->deleteUser($_SESSION['foundUser']);
	}



// //POSTS SECTION

// 	else if (($_GET['p'] == 'posts') || isset($_GET['page']))
// 	{
// 		postsPagination();
// 	}

	
// 	else if ($_GET['p'] == 'addPostForm')
// 	{

// 		addPostForm();
// 	}



// 	else if ($_GET['p'] == 'addPost')
// 	{

// 		$title = htmlspecialchars($_POST['title']);
// 		$heading = htmlspecialchars($_POST['heading']);
// 		$content = htmlspecialchars($_POST['content']);


// 		if(isset($_POST['publier']))
// 		{
	
// 			$img_url = verifyImg();

// 			if(isset($img_url))
// 			{
// 				addPost($_SESSION['id'], $title, $heading, $content, $img_url);
// 			}

// 			else
// 			{
// 				img_message();
// 			}
// 		}

// 		else
// 		{
//     		echo $error;
// 		}


		
// 	}

// 	else if ($_GET['p'] == 'updatePost')
// 	{
		
// 		$postId = intval($_GET['postId']);
// 		selectPost($postId);

// 	}

// 	else if ($_GET['p'] =='postUpdated')
// 	{
		
// 		$title = htmlspecialchars($_POST['title']);
// 		$heading = htmlspecialchars($_POST['heading']);
// 		$content = htmlspecialchars($_POST['content']);
// 		$postId = intval($_GET['postId']);

// 		updatePost($postId, $title, $heading, $content);
	
// 	}

// 	else if ($_GET['p'] == 'deletePost')
// 	{
// 		$postId = intval($_GET['postId']);
// 		deletePost($postId);
// 	}
	

// // COMMENTS SECTION

// 	else if (($_GET['p'] == 'comments') || isset($_GET['cpage']))
// 	{
// 		commentsPagination();
// 	}

// 	else if ($_GET['p'] == 'validComment')
// 	{

// 		$commentId = intval($_GET['commentId']);
// 		validComment($commentId);
		
// 	}

// 	else if ($_GET['p'] == 'refuseComment')
// 	{

// 		$commentId = intval($_GET['commentId']);
// 		refuseComment($commentId);
		
// 	}


// // CV SECTION
// 	else if ($_GET['p'] == 'cv')
// 	{
// 		showCv();
// 	}


// // SOCIAL NETWORKS SECTION

// 	else if ($_GET['p'] == 'networks')
// 	{
// 		showNetwork();
// 	}
// 	else if ($_GET['p'] == 'addNetwork')
// 	{
// 		addNetwork();
// 	}
// 	else if ($_GET['p'] == 'addedNetwork')
// 	{
// 		$name = htmlspecialchars($_POST['name']);
// 		$address = htmlspecialchars($_POST['address']);

// 		addedNetwork($name, $_adress);
// 	}

// 	else if ($_GET['p'] == 'updateNetwork')
// 	{
// 		$address = htmlspecialchars($_POST['address']);

// 		updateNetwork($_GET['networkId'], $address);
// 	}
// 	else if ($_GET['p'] == 'deleteNetwork')
// 	{
// 		$networkId = intval($_GET['networkId']);
// 		deleteNetwork($networId);
// 	}


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





