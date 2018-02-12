<?php
namespace P5\controllers\frontend;
use P5\core\factories\ControllerFactory;

class SocialNetworksController 
{
	
	private $factory;
	private $networkman;
	
	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->networkman = $factory->getTable()->table('Networks');
		$this->factory = $factory;

		
	}

	public function __invoke()
	{
		$networks = $this->networkman->networkList();
		echo $this->factory->getTwig()->render('views/frontend/socialNetworks.twig', ['network' => $networks]);


	}

}

