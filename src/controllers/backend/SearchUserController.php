<?php
namespace P5\controllers\backend;

use P5\core\factories\ControllerFactory;


class SearchUserController {

	
	private $factory;
	private $userman;
	private $session;
	private $request;
	private $builder;
	
	public function __construct() {
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->userman = $this->factory->getTable()->table('Users');
		$this->session = $this->factory->getSession();
		$this->request = $this->factory->getRequest();
		$this->builder = $this->factory->getBuilder();
	}


	public function __invoke() {
		$req = $this->request->request->get('search');
		$res = $this->userman->searchUser($req);
		if ($res !== null) {
            $user = $this->builder->builder('user')->create($res)->build();
            $valider = $this->request->request->get('valider');

            $this->session->set('foundUser', $user->getPseudo());
            $this->session->set('foundUserRole', $user->getIdrole());
        }

		echo $this->factory->getTwig()->render('views/backend/updateUsers.twig', 
			['user' => $user, 
			 'valider' => $valider]);	
	}

}

