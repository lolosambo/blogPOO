<?php

namespace P5\managers;
use P5\core\factories\DbFactory;
use P5\managers\MainManager;
use \PDO;


class CommentsManager extends MainManager
{

	protected $db;

	public function __construct()
	{
		$this->getDb(); 
  	 	return $this->db;
	}


	public function getTotalComments() //Only non-validated comments
	{
		return $this->count('Comments', 'validated', 0);
	}
	

	public function getComments($post_id)
	{
		
		
		$comments = $this->db->getPdo()->prepare
			('
	
				SELECT *, DATE_FORMAT(c.comment_update, "%d/%m/%Y à %Hh%i") AS commentUpdate FROM Users AS u
				INNER JOIN Comments AS c ON u.id = c.id_user
				AND c.id_post = :postId
				ORDER BY commentUpdate
				DESC
			');

		$comments->bindParam(':postId', $post_id);
		$comments->execute();
		$res = $comments->fetchAll();
		return $res;

	}


	//ADD COMMENT FOR MEMBERS--------------------------

	public function addCommentMembers($post_id, $user_id, $comment)
	{
		$req = $this->db->getPdo()->prepare
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

	public function addCommentAdmin($post_id, $user_id, $comment)
	{
		
		$req = $this->db->getPdo()->prepare
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

	public function deleteComment($comment_id)
	{
		
		$deletedComment = $this->erase('Comments', 'id', $comment_id);
		return $deletedComment;

	}


	//MEMBER COMMENT VALIDATION--------------------------------------

	public function publishComment($comment_id)
	{
		
		$publishedComment= $this->update('Comments', 'validated', 1, 'id', $comment_id);
			
		return $publishedComment;

	}


	public function get3LastValidComments()
	{

		$req= $this->db->getPdo()->query
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


	public function get3LastUnvalidComments()
	{

		$req= $this->db->getPdo()->query
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


	public function getUnvalidComments($commentsFirstEntry, $commentsPerPage)
	{

		$req= $this->db->getPdo()->prepare
		('
			SELECT *, c.id AS commentId, DATE_FORMAT(c.comment_update, "%d/%m/%Y à %Hh%i") AS commentUpdate FROM Users AS u
			INNER JOIN Comments AS c 
			ON u.id = c.id_user
			INNER JOIN Posts AS p
			ON c.id_post = p.id
			AND validated = 0
			ORDER BY commentUpdate
			DESC LIMIT :commentsFirstEntry, :commentsPerPage
		');
		$req->bindparam(':commentsFirstEntry', $commentsFirstEntry, PDO::PARAM_INT);
		$req->bindparam(':commentsPerPage',$commentsPerPage, PDO::PARAM_INT);
		$req->execute();
		
		$data = $req->fetchAll();
		return $data;

	}

}

