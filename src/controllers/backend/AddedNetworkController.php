<?php
namespace P5\controllers\backend;

use P5\core\factories\ControllerFactory;


class AddedNetworkController {

	use \P5\core\traits\ImgTrait;

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
		
		$name = $this->request->request->get('name');
		$address = $this->request->request->get('address');
		$img = $this->verifyImg();		
		$this->networkman->createNetwork($name, $address, $img);
		echo $this->factory->getTwig()->render('views/backend/added_network.twig');	
	}

}
