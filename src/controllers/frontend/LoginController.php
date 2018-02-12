<?php

namespace P5\controllers\frontend;
use P5\core\factories\ControllerFactory;

class LoginController
{
	
	private $controller;
	private $session;
	private $twig;

	public function __construct()
	{
		$controller = new ControllerFactory();
		$this->controller = $controller; 
		$this->session = $controller->getSession(); 
		$this->twig = $controller->getTwig();
		$this->request = $controller->getRequest();
	}


	public function __invoke()
	{


		

		$url = $this->request->server->get('REQUEST_URI');
		$connecter = $this->request->request->get('connecter');
		$inscrire = $this->request->request->get('inscrire');
		$pseudo = $this->request->request->get(htmlspecialchars('pseudo'));
		$password = $this->request->request->get(htmlspecialchars('password'));
		$password1 = $this->request->request->get(htmlspecialchars('password1'));
		$password2 = $this->request->request->get(htmlspecialchars('password2'));
		$mail = $this->request->request->get(htmlspecialchars('mail'));



		if ($url == '/inscriptionForm/')
		{
			echo $this->twig->render('views/frontend/inscription_view.twig');
			
		}

		else if ($url == '/logout/')
 		{
   
   			$this->session->clear();
   			echo $this->twig->render('views/frontend/connection_view.twig');

		}

		else if (isset($connecter))
		{
			$user = $this->controller->getFrontController('UserConnectionController');
			$user->login($pseudo, $password);

			
			if ($this->session->get('id_role') == 2)
			{
				$pseudo = $this->session->get('pseudo');
				echo $this->twig->render('views/frontend/loginAdmin.twig', ['pseudo' => $pseudo]);
			}

			else if ($this->session->get('id_role') == 1)
			{
				$pseudo = $this->session->get('pseudo');
				echo $this->twig->render('views/frontend/loginMember.twig', ['pseudo' => $pseudo]);
			
			}

			else if ($this->session->get('pseudo') == FALSE)
			{
				echo $this->twig->render('views/frontend/errorConnection.twig');
			}
	
		}

		else if ($this->session->get('id_role') == 2)
			{
				$pseudo = $this->session->get('pseudo');
				echo $this->twig->render('views/frontend/loginAdmin.twig', ['pseudo' => $pseudo]);
			}

			else if ($this->session->get('id_role') == 1)
			{
				$pseudo = $this->session->get('pseudo');
				echo $this->twig->render('views/frontend/loginMember.twig', ['pseudo' => $pseudo]);
			
			}

		else if (isset($inscrire))
		{
			$user = $this->controller->getFrontController('UserInscriptionController');
			$user->addUser($pseudo, $password1, $password2, $mail);

			if ($pseudo == $this->session->get('db_pseudo'))
			{
				echo $this->twig->render('views/frontend/pseudoAllreadyExist.twig');	
			}

			else if (empty($pseudo) || empty($password1) || empty($password2) || empty($mail))
			{
				echo $this->twig->render('views/frontend/uncompletedForm.twig');
			}

			else if ($password1 != $password2)
			{
				echo $this->twig->render('views/frontend/differentPasswords.twig');
				
			}
	
			else
			{
				$user = $this->controller->getFrontController('UserInscriptionController');
				$user->addUser($pseudo, $password, $password, $mail);
		
				echo $this->twig->render('views/frontend/inscriptionOk.twig');

			}

		}

		else if ($url == '/activation/')
 		{
   
   			$account = $this->controller->getFrontController('AccountController');
   			$account->account_activation($pseudo, $activKey);

		}


		else
		{
			echo $this->twig->render('views/frontend/connection_view.twig');
		}

	}

}

