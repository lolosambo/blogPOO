<?php
namespace P5\controllers\frontend;

use P5\core\factories\ControllerFactory;

class CvController
{

	private $factory;

	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		
	}

	public function __invoke()
	{
		echo $this->factory->getTwig()->render('views/templates/cv.twig');
	}

}

