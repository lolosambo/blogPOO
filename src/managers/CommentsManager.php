<?php
namespace P5\managers;

use P5\core\factories\DbFactory;
use P5\managers\MainManager;
use \PDO;


class CommentsManager extends MainManager {

	protected $db;

	public function __construct() {
        $this->db =$this->getDb();
        parent::__construct();
	}


	public function getTotalComments() {
		$req= $this->db->getPdo()->query('SELECT COUNT(*) AS total FROM Comments WHERE validated  = 0');
		$data = $req->fetch();
		$total=$data['total'];
		return $total;
	}
	
	public function getComments($post_id){
        $post_id = $this->validator->validateSQL($post_id);
        $post_idVal = $this->validator->validateJavascript($post_id);

		$comments = $this->db->getPdo()->prepare
			('
	
				SELECT *, DATE_FORMAT(c.commentUpdate, "%d/%m/%Y à %Hh%i") AS commentUpdate FROM Users AS u
				INNER JOIN Comments AS c ON u.id = c.idUser
				AND c.idPost = :postId
				ORDER BY commentUpdate
				DESC
			');

		$comments->bindParam(':postId', $post_idVal);
		$comments->execute();
		$res = $comments->fetchAll();
		return $res;

	}

	public function addCommentMembers($post_id, $user_id, $comment) {

    $post_id = $this->validator->validateSQL($post_id);
    $post_idVal = $this->validator->validateJavascript($post_id);
    $user_id = $this->validator->validateSQL($user_id);
    $user_idVal = $this->validator->validateJavascript($user_id);
    $comment = $this->validator->validateSQL($comment);
    $commentVal = $this->validator->validateJavascript($comment);

		$req = $this->db->getPdo()->prepare
			("
				INSERT INTO Comments (idPost, idUser, commentContent, commentDate, commentUpdate, validated) 
				VALUES (:id_post, :id_user, :content, NOW(), NOW(), 0)
			");

			$req->bindParam(':id_post', $post_idVal);
			$req->bindParam(':id_user', $user_idVal);
			$req->bindParam(':content', $commentVal);
			$req->execute();
			return $req;
		
	}

	public function addCommentAdmin($post_id, $user_id, $comment) {

    $post_id = $this->validator->validateSQL($post_id);
    $post_idVal = $this->validator->validateJavascript($post_id);
    $user_id = $this->validator->validateSQL($user_id);
    $user_idVal = $this->validator->validateJavascript($user_id);
    $comment = $this->validator->validateSQL($comment);
    $commentVal = $this->validator->validateJavascript($comment);
		
		$req = $this->db->getPdo()->prepare
			("
				INSERT INTO Comments (idPost, idUser, commentContent, commentDate, commentUpdate, validated) 
				VALUES (:id_post, :id_user, :content, NOW(), NOW(), 1)
			");

			$req->bindParam(':id_post', $post_idVal);
			$req->bindParam(':id_user', $user_idVal);
			$req->bindParam(':content', $commentVal);
			$req->execute();
			return $req;

	}

	public function deleteComment($comment_id) {

    $comment_id = $this->validator->validateSQL($comment_id);
    $comment_idVal = $this->validator->validateJavascript($comment_id);
		
		$req = $this->db->getPdo()->prepare('DELETE FROM Comments WHERE id = :param');
		$req->bindParam(':param', $comment_idVal);
		$req->execute();

	}

	public function publishComment($comment_id) {

        $comment_id = $this->validator->validateSQL($comment_id);
        $comment_idVal = $this->validator->validateJavascript($comment_id);
			
		$req = $this->db->getPdo()->prepare('UPDATE Comments SET validated = 1 WHERE id = :param');
		$req->bindParam(':param', $comment_idVal);
		$req->execute();
		return $req;

	}

	public function get3LastValidComments() {

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

	public function get3LastUnvalidComments() {

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


	public function getUnvalidComments($commentsFirstEntry, $commentsPerPage) {

    $commentsFirstEntry = $this->validator->validateSQL($commentsFirstEntry);
    $commentsFirstEntryVal = $this->validator->validateJavascript($commentsFirstEntry);
    $commentsPerPage = $this->validator->validateSQL($commentsPerPage);
    $commentsPerPageVal = $this->validator->validateJavascript($commentsPerPage);

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
		$req->bindparam(':commentsFirstEntry', $commentsFirstEntryVal, PDO::PARAM_INT);
		$req->bindparam(':commentsPerPage',$commentsPerPageVal, PDO::PARAM_INT);
		$req->execute();
		
		$data = $req->fetchAll();
		return $data;

	}
}

