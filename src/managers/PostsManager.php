<?php
namespace P5\managers;

use P5\core\factories\DbFactory;
use P5\managers\MainManager;
use \PDO;


class PostsManager extends MainManager {
	protected $db;

	public function __construct() {
		$this->getDb();
        parent::__construct();
	}

	public function countAllPosts() {

		$req= $this->getDb()->getPdo()->query('SELECT COUNT(*) AS total FROM Posts');
		$data = $req->fetch();
		$total=$data['total'];
		return $total;
	}

	public function allPosts($firstEntry, $postsPerPage) {

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

	public function onePost($title) {

        $title = $this->validator->validateSQL($title);
        $titleVal = $this->validator->validateJavascript($title);
		$post = $this->db->getPdo()->prepare
		('
	
			SELECT *, p.id AS postId, DATE_FORMAT(p.postUpdate, "%d/%m/%Y à %Hh%i") AS postUpdate
			FROM Users AS u 
			INNER JOIN Posts AS p ON u.id = p.idUser
			AND p.postTitle = :title
		');

		$post->bindParam(':title', $titleVal);
		$post->execute();
		$data = $post->fetch();
		return $data;
	}

	public function insertPost($user_id, $title, $heading, $post_content, $img) {
        $title = $this->validator->validateSQL($title);
        $titleVal = $this->validator->validateJavascript($title);
        $user_id = $this->validator->validateSQL($user_id);
        $user_idVal = $this->validator->validateJavascript($user_id);
        $heading = $this->validator->validateSQL($heading);
        $headingVal = $this->validator->validateJavascript($heading);
        $post_content = $this->validator->validateSQL($post_content);
        $post_contentVal = $this->validator->validateJavascript($post_content);

		$newPost = $this->db->getPdo()->prepare
		("
			INSERT INTO Posts (idUser, postTitle, postHeading, postContent, postDate, postUpdate, postImgUrl) 
			VALUES (:id_user, :title, :heading, :content, NOW(), NOW(), :img_url)
		");

		$newPost->bindParam(':id_user', $user_idVal);
		$newPost->bindParam(':title', $titleVal);
		$newPost->bindParam(':heading', $headingVal);
		$newPost->bindParam(':content', $post_contentVal);
		$newPost->bindParam(':img_url', $img);
		$newPost->execute();
		return $newPost;

	}

	public function get3LastPosts() {

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

	public function updatePost($postId, $title, $heading, $content) {

        $title = $this->validator->validateSQL($title);
        $titleVal = $this->validator->validateJavascript($title);
        $postId = $this->validator->validateSQL($postId);
        $postIdVal = $this->validator->validateJavascript($postId);
        $heading = $this->validator->validateSQL($heading);
        $headingVal = $this->validator->validateJavascript($heading);
        $content = $this->validator->validateSQL($content);
        $contentVal = $this->validator->validateJavascript($content);

		$req = $this->db->getPdo()->prepare
		('
			UPDATE Posts 
			SET 
			postTitle = :post_title,
			postHeading = :post_heading,
			postContent = :post_content
			WHERE id = :post_id
		');

		$req->bindParam(':post_id', $postIdVal);
		$req->bindParam(':post_title', $titleVal);
		$req->bindParam(':post_heading', $headingVal);
		$req->bindParam(':post_content', $contentVal);
	
		$req->execute();
		return $req;
	}


	public function deletePost($postId) {

        $postId = $this->validator->validateSQL($postId);
        $postIdVal = $this->validator->validateJavascript($postId);

		$req = $this->getDb()->getPdo()->prepare('DELETE FROM Posts WHERE id = :param');
		$req->bindParam(':param', $postIdVal);
		$req->execute();

	}	
}


