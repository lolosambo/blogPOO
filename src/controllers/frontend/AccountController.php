<?php
	
namespace P5\controllers\frontend;
use p5\core\factories\ControllerFactory;



class AccountController
{

	private $userman;
	private $factory;
	private $twig;
	private $builder;
	private $session;
	

	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->userman = $factory->getTable()->Table('users');
		$this->twig = $factory->getTwig();
		$this->builder = $factory->getBuilder();
		$this->session = $factory->getSession();
	}

	public function account_activation($pseudo, $activKey)
	{

		$res = $this->userman->accActivation($pseudo);
		$user = $this->builder->getBuilder('User')->create($res);
		$activationKey = $user->getActivation_key();	
		$verified = $user->getVerified(); 

    
		if($verified == '1') 
		{
   		 	echo $this->twig->render('views/frontend/accountAllreadyActived.twig');
  		}
  		else 
  		{
    		if($activKey == $activationKey) 
      		{
          		
        	  	echo $this->twig->render('views/frontend/activationOk.twig');

			  	$this->userman->setVerified($pseudo);
			}
			 else // if the two keys are different
			{
			  	echo $this->twig->render('views/frontend/errorActivation.twig');
			}
	  	}

	  	$this->session->set('activKey', $activKey);
	  	$this->session->set('activationKey', $activationKey);
	  	$this->session->set('update_verfied',  $verified);

	}
	
}