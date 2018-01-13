<?php

namespace p5\controllers\frontend;

use p5\app\Session;
use p5\entities\Users;
use p5\entities\Comments;
use p5\managers\CommentsManager;

class CommentsController
{


	
	public function allComments(CommentsManager $commentman, $postId)
	{
		$res2 = $commentman->getComments($postId);
		return $res2;
		
	}



	public function addComment(CommentsManager $commentman, $postId, $userId, $comment)
	{
		
		$session = new Session();
		
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




