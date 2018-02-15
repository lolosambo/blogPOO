<?php	
namespace P5\controllers\frontend;

use P5\core\factories\ControllerFactory;


class UserConnectionController
{

	private $userman;
	private $builder;
	private $factory;
	private $session;

	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->session = $this->factory->getSession();
		$manager = $factory->getTable()->Table('Users');
		$this->userman = $manager;
		$builder = $factory->getBuilder()->Builder('User');
		$this->builder = $builder;
	}


	public function login($pseudo, $password)
	{	
		$res = $this->userman->login($pseudo, $password);
		if (isset($res['pseudo'])) {
			$user = $this->builder->create($res)->build();
			$this->session->set('id', $user->getId());
			$this->session->set('pseudo', $user->getPseudo());
			$this->session->set('id_role', $user->getIdRole());
			$this->session->set('verified', $user->getVerified());
			return $user;	
		}			
	}



}

