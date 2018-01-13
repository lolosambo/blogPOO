<?php
namespace p5\controllers\frontend;
use p5\managers\UsersManager;
use p5\entities\Users;
use p5\app\Session;
use p5\traits\MailerTrait;

class UsersController
{
	use MailerTrait;

	public function userConnexion(UsersManager $userman, $pseudo, $password)
	{
		
		$res = $userman->getUser($pseudo, $password);
		if (isset($res['pseudo']))
		{
			$user = new Users($res);
			$session = new Session();
			$session->setSession('id', $user->getId());
			$session->setSession('pseudo', $user->getPseudo());
			$session->setSession('id_role', $user->getId_role());
			$session->setSession('verified', $user->getVerified());
			return $user;
			
		}	
	
			
	}


	public function insertUser(UsersManager $userman, $pseudo, $password1, $password2, $mail)
	{
		
		$session = new Session();
		$res = $userman->compareUsers($pseudo);
		$session->setSession('db_pseudo', $res['pseudo']);
		
		if ($pseudo == $res['pseudo'])
		{
		
		}

		else if (empty($pseudo) || empty($password1) || empty($password2) || empty($mail))
		{
		
		}

		else if ($password1 !== $password2)
		{
			
		}
	
		else
		{
			$activKey = $userman->addUser($pseudo, $password1, $mail);
			$session->setSession('activation_key', $activKey);
			$this->sendMail($pseudo, $mail, $activKey);

		}
	}

	public function destroySession()
	{
		$session = new Session();
		$session->closeSession();
		
	}
	


}