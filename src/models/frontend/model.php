<?php

use p5\managers\UsersManager;
use p5\managers\PostsManager;
use p5\managers\SessionManager;




// USERS SECTION----------------------------------

$userMan = new UsersManager();


function connexion($pseudo, $password)
{
	$connexion = $userMan->getUser($pseudo, $password);
}


function insertUser($pseudo, $password, $mail)
{
	$addedUser = $userMan->addUser($pseudo, $password, $mail);
}

function searchUser($pseudo)
{
	$foundUser = $userMan->compareUser($pseudo);
}


function activation($pseudo, $key)
{
	$activation = $userMan->accActivation($pseudo, $key);

}


function valid($login)
{
	$userMan->setValidated($login);
}



// POSTS LIST (5)----------------------------




function allPosts($firstEntry, $postsPerPage)
{
	$postMan = new PostsManager();
	$allPosts = $postMan->getPosts($firstEntry, $postsPerPage);
	return $allPosts;
}

function onePost($post_id)
{
	$postMan = new PostsManager();
	$onePost = $postMan->getPost($post_id);
}

function insertPost($user_id, $title, $heading, $post_content, $img)
{
	$postMan = new PostsManager();
	$onePost = $postMan->addPost($user_id, $title, $heading, $post_content, $img);
}

function howMuchPosts()
{
	$postMan = new PostsManager();
	$count = $postMan->countPost();
}








//LIST COMMENTS------------------------------

function getComments($post_id)
{
	$db = getDb();
	$comments = $db->prepare
		('
	
			SELECT *, DATE_FORMAT(c.comment_update, "%d/%m/%Y à %Hh%i") AS commentUpdate FROM Users AS u
			INNER JOIN Comments AS c ON u.id = c.id_user
			AND c.id_post = :postId
			ORDER BY commentUpdate
			DESC
		');

	$comments->bindParam(':postId', $post_id);
	$comments->execute();
	return $comments;

}


//ADD COMMENT FOR MEMBERS--------------------------

function addCommentMembers($post_id, $user_id, $comment)
{
	$db = getDb();
	$req = $db->prepare
		("
			INSERT INTO Comments (id_post, id_user, comment_content, comment_date, comment_update, validated) 
			VALUES (:id_post, :id_user, :content, NOW(), NOW(), 0)
		");

		$req->bindParam(':id_post', $post_id);
		$req->bindParam(':id_user', $user_id);
		$req->bindParam(':content', $comment);
		$req->execute();
		return $req;
		
}


//ADD COMMENT FOR ADMINISTRATORS --------------------------

function addCommentAdmin($post_id, $user_id, $comment)
{
	$db = getDb();
	$req = $db->prepare
		("
			INSERT INTO Comments (id_post, id_user, comment_content, comment_date, comment_update, validated) 
			VALUES (:id_post, :id_user, :content, NOW(), NOW(), 1)
		");

		$req->bindParam(':id_post', $post_id);
		$req->bindParam(':id_user', $user_id);
		$req->bindParam(':content', $comment);
		$req->execute();
		return $req;

}


//DELETE COMMENT-----------------------------------------

function deleteComment($comment_id)
{
	$db = getDb();

	$deletedComment = $db->prepare
		('
			DELETE FROM Comments WHERE id = :commentId
		');

	$deletedComment->bindParam(':commentId', $comment_id);
	$deletedComment->execute();

}


//MEMBER COMMENT VALIDATION--------------------------------------

function publishComment($comment_id)
{
	$db = getDb();
	$publishedComment= $db->prepare
		('
			UPDATE Comments SET validated = 1 WHERE id = :commentId'
		);
		$publishedComment->bindParam(':commentId', $comment_id);
		$publishedComment->execute();

}



// PAGINATION------------------------------------------------------
function getTotalPosts()
{

$db = getDb();
$req = $db->query('SELECT COUNT(*) AS total FROM Posts');
$data = $req->fetch();
$total=$data['total'];
return $data;
}




// DB CONNEXION-------------------------------

function getDb()
{
	try
	{
		$db = new PDO('mysql:host=bloglilldqocrp5.mysql.db;dbname=bloglilldqocrp5', 'bloglilldqocrp5', '01Mars77');
		return $db;
	}

	catch (PDOException $e)
	{
		print "Erreur ! : ".$e->getMessage()."<br>";
		die();
	}

	
}



?>










