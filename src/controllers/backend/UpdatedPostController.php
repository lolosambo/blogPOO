<?php
namespace P5\controllers\backend;

use P5\core\factories\ControllerFactory;

class UpdatedPostController {

	private $factory;
	private $postman;
	private $request;
	
	

	public function __construct() {
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->postman = $this->factory->getTable()->table('Posts');
		$this->request = $this->factory->getRequest();
		
	}

	public function __invoke() {
		$url = $this->request->server->get('REQUEST_URI');
		preg_match('#/([0-9]+)$#', $url, $match);
		$postId = $match[1];

		
		$title = $this->request->request->get('title');
		$heading = $this->request->request->get('heading');
		$content = $this->request->request->get('content');

		$this->postman->updatePost($postId, $title, $heading, $content);
		echo $this->factory->getTwig()->render('views/backend/updated_post.twig');

	}

}

