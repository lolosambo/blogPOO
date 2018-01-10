<?php

namespace p5\controllers\frontend;
use p5\managers\UsersManager;
use p5\entities\Users;
use p5\traits\SessionTrait;
use p5\traits\MailerTrait;

class UsersController
{
	use SessionTrait;
	use MailerTrait;

	public function userConnexion(UsersManager $userman, $pseudo, $password)
	{
		
		$res = $userman->getUser($pseudo, $password);
		$user = new Users($res);

		if (($user->getPseudo() != null) && ($user->getId_role() != null))
		{
			$this->setSession('pseudo', $user->getPseudo());
			$this->setSession('id_role', $user->getId_role());
			
		}
		else 
		{
			$this->setSession('pseudo', null);
		}	
	}





	public function insertUser(UsersManager $userman, $pseudo, $password1, $password2, $mail)
	{
		

		$res = $userman->compareUsers($pseudo);
		$user = $res['pseudo'];
		$this->setSession('db_pseudo', $user);
	
		if ($pseudo == $user)
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

			$res = $userman->addUser($pseudo, $password1, $mail);
			$addedUser = new Users($res);
			$activKey = $this->setSession('activation_key', $addedUser->getActivation_key());
			$this->sendMail($pseudo, $mail, $activKey);

		}
	
	
	}


	public function destroySession()
	{
		$this->closeSession();
		$this->setSession('pseudo', null);
		$this->setSession('id_role', null);
	}
	


}