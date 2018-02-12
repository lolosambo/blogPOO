<?php

namespace P5\controllers\frontend;
use P5\core\factories\ControllerFactory;


class AddCommentController
{

	private $commentman;

	public function __construct()
	{
		$factory = new ControllerFactory();

		$this->commentman = $factory->getTable()->Table('comments');

		
	}

	public function addComment($postId, $id_role, $userId, $comment)
	{
			
		if($id_role == 1)
		{
			$this->commentman->addCommentMembers($postId, $userId, $comment);
		}
		else if($id_role == 2)
		{
			$this->commentman->addCommentAdmin($postId, $userId, $comment);
		}

	}

}