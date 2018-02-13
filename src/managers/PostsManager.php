<?php

namespace P5\managers;
use P5\core\factories\DbFactory;
use P5\managers\MainManager;
use \PDO;


class PostsManager extends MainManager
{

	protected $db;

	public function __construct()
	{
		$this->getDb(); 
  	 	return $this->db;
	}

	
	
	public function countAllPosts()
	{

		$req= $this->getDb()->getPdo()->query('SELECT COUNT(*) AS total FROM Posts');
		$data = $req->fetch();
		$total=$data['total'];
		return $total;
	}


	public function allPosts($firstEntry, $postsPerPage)
	{

		$posts = $this->db->getPdo()->prepare
		('
			SELECT *, p.id as postId, DATE_FORMAT(p.postUpdate, "%d/%m/%Y à %Hh%i") AS postUpdate 
			FROM Posts AS p
			INNER JOIN Users AS u
			ON u.id = p.idUser
			ORDER BY p.postDate 
			DESC LIMIT :firstEntry, :postsPerPage
		');
		$posts->bindparam(':firstEntry', $firstEntry, PDO::PARAM_INT);
		$posts->bindparam(':postsPerPage', $postsPerPage, PDO::PARAM_INT);
		$posts->execute();
		$res = $posts->fetchAll();
		return $res;
		
	}

	
	public function onePost($title)
	{
		$post = $this->db->getPdo()->prepare
		('
	
			SELECT *, p.id AS postId, DATE_FORMAT(p.postUpdate, "%d/%m/%Y à %Hh%i") AS postUpdate
			FROM Users AS u 
			INNER JOIN Posts AS p ON u.id = p.idUser
			AND p.postTitle = :title
		');

		$post->bindParam(':title', $title);
		$post->execute();
		$data = $post->fetch();
		return $data;
	}


	public function insertPost($user_id, $title, $heading, $post_content, $img)
	{
		$newPost = $this->db->getPdo()->prepare
		("
			INSERT INTO Posts (idUser, postTitle, postHeading, postContent, postDate, postUpdate, postImgUrl) 
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


	public function get3LastPosts()
	{

		$req = $this->db->getPdo()->query 
		('
			SELECT *, DATE_FORMAT(p.postUpdate, "%d/%m/%Y à %Hh%i") AS postUpdate, p.id AS postId
			FROM Posts AS p
			INNER JOIN Users AS u
			ON p.idUser = u.id 
			ORDER BY postUpdate
			DESC
			LIMIT 0, 3
		');

		return $req;
	}

	public function updatePost($postId, $title, $heading, $content)
	{

		$req = $this->db->getPdo()->prepare
		('
			UPDATE Posts 
			SET 
			postTitle = :post_title,
			postHeading = :post_heading,
			postContent = :post_content
			WHERE id = :post_id
		');

		$req->bindParam(':post_id', $postId);
		$req->bindParam(':post_title', $title);
		$req->bindParam(':post_heading', $heading);
		$req->bindParam(':post_content', $content);
	
		$req->execute();
		return $req;
	}


	public function deletePost($postId)
	{
		$req = $this->erase('Posts', 'id', $postId);
		$req = $this->getDb()->getPdo()->prepare('DELETE FROM Posts WHERE id = :param');
		$req->bindParam(':param', $param);
		$req->execute();

	}
	
}


