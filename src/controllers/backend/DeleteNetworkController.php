<?php
namespace P5\controllers\backend;

use P5\core\factories\ControllerFactory;


class DeleteNetworkController {

	private $factory;
	private $networkman;
	private $request;

	public function __construct() {
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->networkman = $this->factory->getTable()->table('Networks');
		$this->request = $this->factory->getRequest();	
	}



	public function __invoke() {
		$url = $this->request->server->get('REQUEST_URI');
		preg_match('#/([0-9]+)$#', $url, $match);	
		$networkId = $match[1];
		$this->networkman->eraseNetwork($networkId);
		echo $this->factory->getTwig()->render('views/backend/delete_network.twig');	
	}

}

