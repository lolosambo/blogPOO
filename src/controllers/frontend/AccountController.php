<?php
namespace P5\controllers\frontend;

use P5\core\factories\ControllerFactory;

class AccountController {
	private $userman;
	private $twig;
	private $session;
	private $request;
	

	public function __construct() {
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->userman = $factory->getTable()->Table('users');
		$this->twig = $factory->getTwig();
		$this->session = $factory->getSession();
		$this->request = $factory->getRequest();
	}

	public function __invoke() {
		$url = $this->request->server->get('REQUEST_URI');
		preg_match('#([^/]+)$#', $url, $match);
		$activKey = $match[1];

		$res = $this->userman->accActivation($activKey);
		$user = $this->factory->getBuilder()->builder('user')->create($res)->build();
		$activationKey = $user->getActivationKey();
		$pseudo = $user->getPseudo();	
		$verified = $user->getVerified(); 
    
		if($verified == '1') {
   		 	echo $this->twig->render('views/frontend/accountAllreadyActived.twig');
  		} else {
    		if($activKey == $activationKey) {
    			
    			$this->session->set('activKey', $activKey);
	  			$this->session->set('activationKey', $activationKey);
	  			$this->session->set('update_verfied',  $verified);

        		echo $this->twig->render('views/frontend/activationOk.twig');

			  	$this->userman->setVerified($pseudo);
			} else {
			  	echo $this->twig->render('views/frontend/errorActivation.twig');
			}
	  	}

	  	
	}	
}

