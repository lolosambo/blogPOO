<?php
namespace P5\controllers\backend;

use P5\core\factories\ControllerFactory;


class AddNetworkController
{

	private $factory;

	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
			
	}

	public function __invoke()
	{
		echo $this->factory->getTwig()->render('views/backend/add_network_form.twig');	
	}

}
