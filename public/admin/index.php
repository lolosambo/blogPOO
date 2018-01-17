<?php 
require '../../vendor/autoload.php';
use p5\builders\Builder;

$builder = new Builder();
$session = $builder->createApp('session')->build();
$session->startSession();


$postcont= $builder->createBackController('posts')->build();
$commentcont = $builder->createBackController('comments')->build();
$usercont = $builder->createBackController('users')->build();
$pagincont = $builder->createFrontController('pagination')->build();
$imgcont = $builder->createBackController('images')->build();
$networkcont = $builder->createFrontController('networks')->build();



if (isset($_GET['p']))
{

// USERS SECTION

	if ($_GET['p'] == 'searchUser')
	{
		
		if(isset($_POST['search']))
		{
			$search = htmlspecialchars($_POST['search']);
			$usercont->searchUserForm($builder, $search);

		}

		else
		{
			require('../../views/backend/searchUserForm.php');
		}

	}

	else if ($_GET['p'] == 'changeToAdmin')
	{
		$usercont->changeToAdmin($builder, $session->getSessionVar('foundUser'));
	}

	else if ($_GET['p'] == 'changeToUser')
	{
		$usercont->changeToUser($builder, $session->getSessionVar('foundUser'));
	}

	else if ($_GET['p'] == 'deleteUser')
	{
		$usercont->deleteUser($builder, $session->getSessionVar('foundUser'));
	}



//POSTS SECTION

	else if ($_GET['p'] == 'posts')
	{
		$postcont->showPosts($builder);
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
				$postcont->addPost($builder, $_SESSION['id'], $title, $heading, $content, $img_url);
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
		$postcont->selectPost($builder, $postId);

	}

	else if ($_GET['p'] =='postUpdated')
	{
		
		$title = htmlspecialchars($_POST['title']);
		$heading = htmlspecialchars($_POST['heading']);
		$content = htmlspecialchars($_POST['content']);
		$postId = intval($_GET['postId']);

		$postcont->updatePost($builder, $postId, $title, $heading, $content);
	
	}

	else if ($_GET['p'] == 'deletePost')
	{
		$postId = intval($_GET['postId']);
		$postcont->deletePost($builder, $postId);
	}
	

// COMMENTS SECTION

	else if ($_GET['p'] == 'comments')
	{
		$commentcont->allUnvalidComments($builder, $pagincont);
	}

	else if ($_GET['p'] == 'validComment')
	{

		$commentId = intval($_GET['commentId']);
		$commentcont->validComment($builder, $commentId);
		
	}

	else if ($_GET['p'] == 'refuseComment')
	{

		$commentId = intval($_GET['commentId']);
		$commentcont->refuseComment($builder, $commentId);
		
	}


// // CV SECTION
// 	else if ($_GET['p'] == 'cv')
// 	{
// 		showCv();
// 	}


// SOCIAL NETWORKS SECTION

	else if ($_GET['p'] == 'networks')
	{
		$networkcont->showNetworks($builder);
	}
	else if ($_GET['p'] == 'addNetwork')
	{
		$networkcont->addNetwork($builder);
	}
	else if ($_GET['p'] == 'addedNetwork')
	{
		$name = htmlspecialchars($_POST['name']);
		$address = htmlspecialchars($_POST['address']);

		$networkcont->addedNetwork($builder, $name, $address);
	}

	else if ($_GET['p'] == 'updateNetwork')
	{
		$address = htmlspecialchars($_POST['address']);

		$networkcont->updateNetwork($builder, $_GET['networkId'], $address);
	}
	else if ($_GET['p'] == 'deleteNetwork')
	{
		$networkId = intval($_GET['networkId']);
		$networkcont->deleteNetwork($builder, $networkId);
	}

}

else if (isset($_GET['page']))
{
	$postcont->showPosts($builder);

}

else if (isset($_GET['cpage']))
	{
		$commentcont->allUnvalidComments($builder);
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
	$usercont->showDaschboard($builder);
	}

}






