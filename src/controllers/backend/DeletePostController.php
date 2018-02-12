<?php
namespace P5\controllers\backend;
use P5\core\factories\ControllerFactory;

class DeletePostController
{
	private $factory;
	private $postman;
	private $request;
	

	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->postman = $this->factory->getTable()->table('Posts');
		$this->request = $this->factory->getRequest();
	
	}

	public function __invoke()
	{
		$url = $this->request->server->get('REQUEST_URI');
		preg_match('#/([0-9]+)$#', $url, $match);
		$postId = $match[1];

		$this->postman->deletePost($postId);
		echo $this->factory->getTwig()->render('views/backend/deleted_post.twig');
	}


}

