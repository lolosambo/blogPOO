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

		$req= $this->getDb()->getPdo()->query('SELECT COUNT(*) AS total FROM Comments WHERE validated  = 0');
		$data = $req->fetch();
		$total=$data['total'];
		return $total;
	}
	

	public function getComments($post_id)
	{
		
		
		$comments = $this->db->getPdo()->prepare
			('
	
				SELECT *, DATE_FORMAT(c.commentUpdate, "%d/%m/%Y à %Hh%i") AS commentUpdate FROM Users AS u
				INNER JOIN Comments AS c ON u.id = c.idUser
				AND c.idPost = :postId
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
				INSERT INTO Comments (idPost, idUser, commentContent, commentDate, commentUpdate, validated) 
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
				INSERT INTO Comments (idPost, idUser, commentContent, commentDate, commentUpdate, validated) 
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
		
		$req = $this->getDb()->getPdo()->prepare('DELETE FROM Comments WHERE id = :param');
		$req->bindParam(':param', $comment_id);
		$req->execute();

	}


	//MEMBER COMMENT VALIDATION--------------------------------------

	public function publishComment($comment_id)
	{
		
		$req= $this->update('Comments', 'validated', 1, 'id', $comment_id);
			
		$req = $this->getDb()->getPdo()->prepare('UPDATE Comments SET validated = 1 WHERE id = :param');
		$req->bindParam(':param', $comment_id);
		$req->execute();
		return $req;

	}


	public function get3LastValidComments()
	{

		$req= $this->db->getPdo()->query
		('
	
			SELECT *, DATE_FORMAT(c.commentUpdate, "%d/%m/%Y à %Hh%i") AS commentUpdate FROM Users AS u
			INNER JOIN Comments AS c 
			ON u.id = c.idUser
			INNER JOIN Posts AS p
			ON c.idPost = p.id
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
			SELECT *, DATE_FORMAT(c.commentUpdate, "%d/%m/%Y à %Hh%i") AS commentUpdate FROM Users AS u
			INNER JOIN Comments AS c 
			ON u.id = c.idUser
			INNER JOIN Posts AS p
			ON c.idPost = p.id
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
			SELECT *, c.id AS commentId, DATE_FORMAT(c.commentUpdate, "%d/%m/%Y à %Hh%i") AS commentUpdate FROM Users AS u
			INNER JOIN Comments AS c 
			ON u.id = c.idUser
			INNER JOIN Posts AS p
			ON c.idPost = p.id
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

