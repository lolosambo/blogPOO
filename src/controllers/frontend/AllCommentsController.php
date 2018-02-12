<?php

namespace P5\controllers\frontend;
use P5\core\factories\ControllerFactory;

class AllCommentsController
{

	private $factory;
	private $commentman;
	private $twig;

	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->commentman = $factory->getTable()->Table('comments');
		$this->twig = $factory->getTwig();
	}

	public function allComments($postId)
	{
		$res = $this->commentman->getComments($postId);
		return $res;
	
	}


}