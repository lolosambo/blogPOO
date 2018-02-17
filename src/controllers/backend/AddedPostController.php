<?php
namespace P5\controllers\backend;

use P5\core\factories\ControllerFactory;


class AddedPostControlle {

	use \P5\core\traits\ImgTrait;
	
	private $factory;
	private $postman;
	private $session;
	private $request;
	

	public function __construct() {
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->request = $this->factory->getRequest();
		$this->postman = $this->factory->getTable()->table('Posts');
		$this->session = $this->factory->getSession();
	
	}

	public function __invoke() {
		$title = $this->request->request->get('title');
		$heading = $this->request->request->get('heading');
		$post_content = $this->request->request->get('content');
		$img = $this->verifyImg();
		$user_id = $this->session->get('id');
		$this->postman->insertPost($user_id, $title, $heading, $post_content, $img);
		echo $this->factory->getTwig()->render('views/backend/added_post.twig');
	}

	

}
