<?php

namespace p5\controllers\frontend;

use p5\builders\Builder;

class CommentsController
{


	
	public function allComments(Builder $builder, $postId)
	{
		$res2 = $builder->createManager('comments')->build()->getComments($postId);
		return $res2;
		
	}



	public function addComment(Builder $builder, $postId, $userId, $comment)
	{
		
		$session = $builder->createApp('session')->build();
		$commentman = $builder->createManager('comments')->build();
		
		if($session->getSessionVar('id_role') == 1)
		{
			$commentman->addCommentMembers($postId, $userId, $comment);
		}
		else if($session->getSessionVar('id_role') == 2)
		{
			$commentman->addCommentAdmin($postId, $userId, $comment);
		}

	}





}




