<?php
namespace P5\controllers\frontend;
use P5\core\factories\ControllerFactory;

class PresentationController
{

	private $factory;

	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		
	}

	public function __invoke()
	{

		$sidebar = $this->factory->getFrontController('loginController');

		$networks = $this->factory->getFrontController('SocialNetworksController');

		echo $this->factory->getTwig()->render('views/frontend/presentation.twig', ['sidebarContent' => $sidebar,'network' => $networks] );
	}

}