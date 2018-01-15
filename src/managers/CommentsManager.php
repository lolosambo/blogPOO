<?php

namespace p5\managers;
use p5\database\DbFactory;
use \PDO;


class CommentsManager
{

	private $db;

	public function __construct()
	{
  	 	$this->db = new DbFactory();
	}


	//LIST COMMENTS------------------------------

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
		
		$deletedComment = $this->db->getPdo()->prepare
			('
				DELETE FROM Comments WHERE id = :commentId
			');

		$deletedComment->bindParam(':commentId', $comment_id);
		$deletedComment->execute();
		return $deletedComment;

	}


	//MEMBER COMMENT VALIDATION--------------------------------------

	public function publishComment($comment_id)
	{
		
		$publishedComment= $this->db->getPdo()->prepare
			('
				UPDATE Comments SET validated = 1 WHERE id = :commentId'
			);
			$publishedComment->bindParam(':commentId', $comment_id);
			$publishedComment->execute();
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

		$req= $this->db->getPdo()->query
		('
			SELECT *, c.id AS commentId, DATE_FORMAT(c.comment_update, "%d/%m/%Y à %Hh%i") AS commentUpdate FROM Users AS u
			INNER JOIN Comments AS c 
			ON u.id = c.id_user
			INNER JOIN Posts AS p
			ON c.id_post = p.id
			AND validated = 0
			ORDER BY commentUpdate
			DESC LIMIT '.$commentsFirstEntry.', '.$commentsPerPage.'
		');
		
		$data = $req->fetchAll();
		return $data;

	}



	public function getTotalComments() //Only non-validated comments
	{

	$req= $this->db->getPdo()->query('SELECT COUNT(*) AS total FROM Comments WHERE validated = 0');
	$data = $req->fetch();
	$total=$data['total'];
	return $total;
	}



}