<?php

namespace P5\controllers\backend;
use P5\core\factories\ControllerFactory;

class DaschboardController
{
	private $factory;
	private $postman;
	private $userman;
	private $commentman;
	

	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->postman = $factory->getTable()->table('Posts');
		$this->userman = $factory->getTable()->table('Users');
		$this->commentman = $factory->getTable()->table('Comments');
	}


	public function __invoke()
	{
		$users = $this->userman->get5LastUsers();

		$posts = $this->postman->get3LastPosts();

		$comments1 = $this->commentman->get3LastValidComments();

		$comments0 = $this->commentman->get3LastUnvalidComments();

		echo $this->factory->getTwig()->render('views/templates/daschboard_template.twig', [
			'posts' => $posts, 
			'comment1' => $comments1,
			'comment0' => $comments0,
			'users' => $users,
			
		]);

	}
}

