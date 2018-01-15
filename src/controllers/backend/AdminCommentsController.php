<?php
namespace p5\controllers\backend;
use p5\managers\CommentsManager;
use p5\entities\Comments;
use p5\controllers\frontend\PaginationController;
use p5\app\Session;

class AdminCommentsController
{

	public function allUnvalidComments(CommentsManager $commentman, PaginationController $pagincont)
	{
		$pagincont->commentsPagination($commentman);
		$res = $commentman->getUnvalidComments($pagincont->getCommentsFirstEntry(), PaginationController::COMMENTS_PER_PAGE);
		require('../../views/backend/comments.php');
	}

	public function validComment(CommentsManager $commentman, $commentId)
	{
		$commentman->publishComment($commentId);
		require('../../views/backend/published_comment.php');	
	}

	public function refuseComment(CommentsManager $commentman, $commentId)
	{
		$commentman->deleteComment($commentId);
		require('../../views/backend/refused_comment.php');	
	}

}