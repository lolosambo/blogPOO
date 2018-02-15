<?php
namespace P5\controllers\backend;

use P5\core\factories\ControllerFactory;


class NetworksController
{
	
	private $factory;
	private $networkman;

	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->networkman = $this->factory->getTable()->table('Networks');
		
	}

	public function __invoke()
	{
		$res = $this->networkman->networkList();
		echo $this->factory->getTwig()->render('views/backend/networks.twig', 
		['network' => $res]);		
	}


}

