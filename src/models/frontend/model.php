<?php

use p5\managers\UsersManager;
use p5\managers\PostsManager;
use p5\managers\SessionManager;

$userMan : new UsersManager();



function connexion($pseudo, $password)
{
	$userMan->getUser($pseudo, $password);
}


function insertUser($pseudo, $password, $mail)
{
	$userMan->addUser($pseudo, $password, $mail);
}

function searchUser($pseudo)
{
	$userMan->compareUser($pseudo);
}


function activation($pseudo, $key)
{
	$userMan->accActivation($pseudo, $key);

}


function valid($login)
{
	$userMan->setValidated($login);
}



// POSTS LIST (5)----------------------------

function getPosts($firstEntry, $postsPerPage)
{
	$db = getDb();

	$posts = $db->query
	('
			SELECT *, p.id as postId, DATE_FORMAT(p.post_update, "%d/%m/%Y à %Hh%i") AS postUpdate FROM Posts AS p
			INNER JOIN Users AS u
			ON u.id = p.id_user
			ORDER BY p.post_date 
			DESC LIMIT '.$firstEntry.', '.$postsPerPage.'
	');

	return $posts;
}




// ONE POST ONLY------------------------------

function getPost($post_id)
{
	$db = getDb();
	$post = $db->prepare
		('
	
			SELECT *, p.id AS postId, DATE_FORMAT(p.post_update, "%d/%m/%Y à %Hh%i") AS postUpdate FROM Users AS u 
			INNER JOIN Posts AS p ON u.id = p.id_user
			AND p.id = :postId 
		');

		$post->bindParam(':postId', $post_id);
		$post->execute();
		return $post;
}


// ADD POST-------------------------------------

function addPost($user_id, $title, $heading, $post_content, $img)
{
	$db = getDb();
	$newPost = $db->prepare
		("
			INSERT INTO Posts (id_user, post_title, post_heading, post_content, post_date, post_update, post_img_url) 
			VALUES (:id_user, :title, :heading, :content, NOW(), NOW(), :img_url)
		");

	$newPost->bindParam(':id_user', $user_id);
	$newPost->bindParam(':title', $title);
	$newPost->bindParam(':heading', $heading);
	$newPost->bindParam(':content', $post_content);
	$newPost->bindParam(':img_url', $img);
	$newPost->execute();
	return $newPost;

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










