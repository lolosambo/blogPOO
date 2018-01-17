<?php
namespace p5\controllers\backend;
use p5\builders\Builder;
use p5\controllers\frontend\PaginationController;

class AdminCommentsController
{

	public function allUnvalidComments(Builder $builder)
	{
		$commentman = $builder->createManager('comments')->build();
		$pagincont = $builder->createFrontController('pagination')->build();
		$pagincont->commentsPagination($builder);
		$res = $commentman->getUnvalidComments($pagincont->getCommentsFirstEntry(), PaginationController::COMMENTS_PER_PAGE);
		require('../../views/backend/comments.php');
	}

	public function validComment(Builder $builder, $commentId)
	{
		$builder->createManager('comments')->build()->publishComment($commentId);
		require('../../views/backend/published_comment.php');	
	}

	public function refuseComment(Builder $builder, $commentId)
	{
		$builder->createManager('comments')->build()->deleteComment($commentId);
		require('../../views/backend/refused_comment.php');	
	}

}