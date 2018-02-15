<?php
namespace P5\controllers\backend;

use P5\core\factories\ControllerFactory;

class UpdateUserController
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

		if ($this->session->get('foundUserRole') == 1) {
			$this->changeToAdmin($foundUser);
		} elseif ($this->session->get('foundUserRole') == 2) {
			$this->changeToUser($foundUser);
		}
		

	}

	public function changeToAdmin($pseudo)
	{	
		$this->userman->updateToAdmin($pseudo);
		echo $this->factory->getTwig()->render('views/backend/updatedUsers.twig', ['foundUser' => $pseudo]);
	}

	public function changeToUser($pseudo)
	{
		$this->userman->updateToUser($pseudo);
		echo $this->factory->getTwig()->render('views/backend/updatedUsers.twig', ['foundUser' => $pseudo]);
	}

}

