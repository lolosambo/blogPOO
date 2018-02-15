<?php
namespace P5\controllers\backend;

use P5\core\factories\ControllerFactory;


class DeleteUserController
{

	private $factory;
	private $userman;
	private $session;
	

	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->userman = $this->factory->getTable()->table('Users');
		$this->session = $this->factory->getSession();
	
	}

	public function __invoke()
	{
		$foundUser = $this->session->get('foundUser');
		$this->userman->deleteUser($foundUser);
		echo $this->factory->getTwig()->render('views/backend/deleteUser.twig');

	}


}



