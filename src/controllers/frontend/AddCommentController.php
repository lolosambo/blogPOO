<?php

namespace P5\controllers\frontend;
use P5\core\factories\ControllerFactory;


class AddCommentController
{

	private $factory;
	private $commentman;
	private $twig;
	private $session;

	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->commentman = $factory->getTable()->Table('comments');
		$this->twig = $factory->getTwig();
		
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