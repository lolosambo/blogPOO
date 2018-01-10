<?php

namespace p5\managers;
use p5\database\DbFactory;



class PostsManager
{

	private $db;

	
	public function __construct()
	{
  	 	$this->db = new DbFactory();
	}

	
	public function countPosts()
	{

		$req = $this->db->getPdo()->query('SELECT COUNT(*) AS total FROM Posts');
		$data = $req->fetch();
		$total=$data['total'];
		return $total;
	}


	public function getPosts($firstEntry, $postsPerPage)
	{

		$posts = $this->db->getPdo()->query
		('
			SELECT *, p.id as postId, DATE_FORMAT(p.post_update, "%d/%m/%Y à %Hh%i") AS postUpdate 
			FROM Posts AS p
			INNER JOIN Users AS u
			ON u.id = p.id_user
			ORDER BY p.post_date 
			DESC LIMIT '.$firstEntry.', '.$postsPerPage.'
		');
		$res = $posts->fetchAll();
		return $res;
		
	}

	
	public function getPost($post_id)
	{
	
		$post = $this->db->getPdo()->prepare
		('
	
			SELECT *, p.id AS postId, DATE_FORMAT(p.post_update, "%d/%m/%Y à %Hh%i") AS postUpdate
			FROM Users AS u 
			INNER JOIN Posts AS p ON u.id = p.id_user
			AND p.id = :postId 
		');

		$post->bindParam(':postId', $post_id);
		$post->execute();
		$data = $post->fetch();
		return $data;
	}


	public function addPost($user_id, $title, $heading, $post_content, $img)
	{
		$newPost = $this->db->getPdo()->prepare
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
	
}