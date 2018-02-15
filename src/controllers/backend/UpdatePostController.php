<?php
namespace P5\controllers\backend;

use P5\core\factories\ControllerFactory;

class UpdatePostController
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
		$url = urldecode($this->request->server->get('REQUEST_URI'));

		preg_match('#([^/]+)$#', $url, $match);
		$title = str_replace('_', ' ', $match[1]);
		$res = $this->postman->onePost($title);

		echo $this->factory->getTwig()->render('views/backend/update_post_form.twig', 
		['post' => $res]);
		
		return $res['postId'];

	}


}

