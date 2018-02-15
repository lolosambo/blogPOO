<?php
namespace p5\controllers\backend;

use P5\core\factories\ControllerFactory;

class PublishedCommentController
{

	private $factory;
	private $commentman;
	private $request;


	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->commentman = $this->factory->getTable()->table('Comments');
		$this->request = $this->factory->getRequest();
		$this->twig = $this->factory->getTwig();
		
	}


	public function __invoke()
	{
		$url = $this->request->server->get('REQUEST_URI');
		preg_match('#/([0-9]+)$#', $url, $match);
		$commentId = $match[1];

		$this->commentman->publishComment($commentId);
		echo $this->twig->render('views/backend/published_comment.twig');
	}

}

