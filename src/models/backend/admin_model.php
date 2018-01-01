<?php 


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


function get5LastUsers()
{

	$db = getDb();
	$req= $db->query 
	('
		SELECT *, DATE_FORMAT(u.inscr_date, "%d/%m/%Y à %Hh%i") AS inscrDate  FROM Users AS u
		ORDER BY id
		DESC
		LIMIT 0, 5
	');

	return $req;
}



function searchUser($pseudo)
{

	$db = getDb();
	$req= $db->prepare 
	('
		SELECT *, DATE_FORMAT(u.inscr_date, "%d/%m/%Y à %Hh%i") AS inscrDate  
		FROM Users AS u
		WHERE u.pseudo = :pseudo
	
	');

	$req->bindParam(':pseudo', $pseudo);
	$req->execute();
	$data=$req->fetch();

	return $data;

}



function updateToAdmin($pseudo)
{
	$db = getDb();
	$req= $db->prepare
	('
		UPDATE Users SET id_role = 2
		WHERE pseudo = :pseudo
	
	');

	$req->bindParam(':pseudo', $pseudo);
	$req->execute();

	return $req;

}


function updateToUser($pseudo)
{
	$db = getDb();
	$req= $db->prepare
	('
		UPDATE Users SET id_role = 1
		WHERE pseudo = :pseudo
	
	');

	$req->bindParam(':pseudo', $pseudo);
	$req->execute();

	return $req;

}


function eraseUser($pseudo)
{

	$db = getDb();
	$req= $db->prepare
	('
		DELETE FROM Users
		WHERE pseudo = :pseudo
	
	');

	$req->bindParam(':pseudo', $pseudo);
	$req->execute();

	return $req;
}


function getAllPosts($firstEntry, $postsPerPage)
{

	$db = getDb();
	$req= $db->query 
	('
		SELECT *, DATE_FORMAT(p.post_update, "%d/%m/%Y à %Hh%i") AS postUpdate, p.id AS postId FROM Posts AS p
		INNER JOIN Users AS u
		ON p.id_user = u.id 
		ORDER BY postUpdate
		DESC LIMIT '.$firstEntry.', '.$postsPerPage.'
	');

	return $req;
}


function get3LastPosts()
{

	$db = getDb();
	$req= $db->query 
	('
		SELECT *, DATE_FORMAT(p.post_update, "%d/%m/%Y à %Hh%i") AS postUpdate, p.id AS postId FROM Posts AS p
		INNER JOIN Users AS u
		ON p.id_user = u.id 
		ORDER BY postUpdate
		DESC
		LIMIT 0, 3
	');

	return $req;
}


function getPost($postId)
{

	$db = getDb();
	$req = $db->prepare
	('
	
		SELECT * FROM Users AS u
		INNER JOIN Posts AS p 
		ON p.id = :postId
		AND u.id = p.id_user
	
	');

	$req->bindParam(':postId', $postId);
	$req->execute();
	return $req;

}


function writePost($user_id, $title, $heading, $post_content, $img)
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



function modifyPost($postId, $title, $heading, $content)
{

	$db = getDb();
	$req= $db->prepare
	('
		UPDATE Posts 
		SET 
		post_title = :post_title,
		post_heading = :post_heading,
		post_content = :post_content
		WHERE id = :post_id
	');

	$req->bindParam(':post_id', $postId);
	$req->bindParam(':post_title', $title);
	$req->bindParam(':post_heading', $heading);
	$req->bindParam(':post_content', $content);
	
	$req->execute();
	return $req;

	
}

function erasePost($postId)
{
	$db = getDb();
	$req= $db->prepare
	('
		DELETE FROM Posts 
		WHERE id = :post_id
	');

	$req->bindParam(':post_id', $postId);
	$req->execute();
	return $req;

}


function get3LastValidComments()
{

	$db = getDb();
	$req = $db->query
	('
	
		SELECT *, DATE_FORMAT(c.comment_update, "%d/%m/%Y à %Hh%i") AS commentUpdate FROM Users AS u
		INNER JOIN Comments AS c 
		ON u.id = c.id_user
		INNER JOIN Posts AS p
		ON c.id_post = p.id
		AND validated = 1
		ORDER BY commentUpdate
		DESC
		lIMIT 0, 3
	');

	return $req;

}



function get3LastUnvalidComments()
{

	$db = getDb();
	$req = $db->query
	('
		SELECT *, DATE_FORMAT(c.comment_update, "%d/%m/%Y à %Hh%i") AS commentUpdate FROM Users AS u
		INNER JOIN Comments AS c 
		ON u.id = c.id_user
		INNER JOIN Posts AS p
		ON c.id_post = p.id
		AND validated = 0
		ORDER BY commentUpdate
		DESC
		lIMIT 0, 3
	');

	return $req;
}


function getUnvalidComments($firstEntry, $commentsPerPage)
{

	$db = getDb();
	$req = $db->query
	('
		SELECT *, c.id AS commentId, DATE_FORMAT(c.comment_update, "%d/%m/%Y à %Hh%i") AS commentUpdate FROM Users AS u
		INNER JOIN Comments AS c 
		ON u.id = c.id_user
		INNER JOIN Posts AS p
		ON c.id_post = p.id
		AND validated = 0
		ORDER BY commentUpdate
		DESC LIMIT '.$firstEntry.', '.$commentsPerPage.'
	');

	return $req;

}

function publishComment($commentId)
{

	$db = getDb();
	$publishedComment= $db->prepare
	('
		
		UPDATE Comments SET validated = 1 WHERE id = :commentId
	
	');
	$publishedComment->bindParam(':commentId', $commentId);
	$publishedComment->execute();
	return $publishedComment;
}

function deleteComment($commentId)
{

	$db = getDb();

	$deletedComment = $db->prepare
	('
		DELETE FROM Comments WHERE id = :commentId
	');

	$deletedComment->bindParam(':commentId', $commentId);
	$deletedComment->execute();
	return $deletedComment;
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


function getTotalComments() //Only non-validated comments
{

$db = getDb();
$req = $db->query('SELECT COUNT(*) AS total FROM Comments WHERE validated = 0');
$data = $req->fetch();
$total=$data['total'];
return $data;
}

// NETWORKS --------------------------------------------------------

function networkList()
{

$db = getDb();
$req = $db->query('SELECT * FROM Networks');
return $req;

}


function createNetwork($name, $address)
{
	$db = getDb();
	$req= $db->prepare
	('
		
		INSERT INTO Networks (network_name, address) VALUES (:name, :address)
	
	');
	$req->bindParam(':address', $address);
	$req->bindParam(':name', $name);
	$req->execute();
	return $req;

}

function changeNetwork($networkId, $networkAddress)
{
	$db = getDb();
	$req= $db->prepare
	('
		
		UPDATE Networks SET address = :address WHERE id = :id
	
	');
	$req->bindParam(':address', $networkAddress);
	$req->bindParam(':id', $networkId);
	$req->execute();
	return $req;

}

function eraseNetwork($networkId)
{

	$db = getDb();
	$req= $db->prepare
	('
		
		DELETE FROM Networks WHERE id = :id
	
	');
	$req->bindParam(':id', $networkId);
	$req->execute();
	return $req;
}











