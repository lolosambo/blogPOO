<?php
namespace p5\controllers\frontend;
use p5\managers\UsersManager;
use p5\entities\Users;
use p5\app\Session;
use p5\interfaces\MailerInterface;

class UsersController implements MailerInterface
{
	

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

	public function sendMailInscr($pseudo, $mail_add, $activKey)
	{

		$objet = 'Confirmation de votre inscription sur le blog de Laurent BERTON' ;
		$to = $mail_add;
		$header =
		'Content-type: text/html; charset=utf-8' . "\r\n" .
		'From: contact@b-log-lille.fr' . "\r\n" .
		'Reply-To: contact@b-log-lille.fr' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		

		$message = 
		'<p>Bonjour '.ucfirst($pseudo).' et bienvenue sur le blog professionnel de Laurent BERTON,</p>
 
		<p>Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur.</p>
 
		<p><a href="http://www.b-log-lille.fr/public/index.php?action=activation&amp;log='.$pseudo.'&amp;key='.$activKey.'">Activez votre compte</a></p><br><br>
 
 
		---------------<br>
		<p>Ceci est un mail automatique, Merci de ne pas y répondre.</p>';
          
		//Send mail
		mail($to, $objet, $message, $header);

	}
	
	public function sendMailContact($name, $mail, $phone, $object, $message)
	{

		$objet = 'Nouveau message de B-LOG' ;
		$to = 'contact@b-log-lille.fr';
		$header =
		'Content-type: text/html; charset=utf-8' . "\r\n" .
		'From: contact@b-log-lille.fr' . "\r\n" .
		'Reply-To: '.$mail."\r\n" .
		'X-Mailer: PHP/' . phpversion();

		$message = 
		'<p>Message en provenance de '.$name.'.</p>
		<p>Numéro de téléphone : '.$phone.'</p>
		<p>Adresse mail : '.$mail.'</p>
		<p>Sujet du message : '.$object.'</p>
		<p>Message : '.$message.'</p>';
		
          
		//Send mail
		mail($to, $objet, $message, $header);		

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
			$this->sendMailInscr($pseudo, $mail, $activKey);

		}
	}
	
	public function account_activation(UsersManager $userman, Session $session, $pseudo, $activKey)
	{

		$res = $userman->accActivation($pseudo, $activKey);
		$activationKey = $res['activation_key'];	
		$verified = $res['verified']; 

    
		if($verified == '1') 
		{
   		 	// echo "Votre compte est déjà actif !";
  		}
  		else 
  		{
    		if($activKey == $activationKey) 
      			{
          		
        	  		// echo "<p>Votre compte a bien été activé !</p>
			  		// <p>Vous pouvez maintenant <a href='http://www.b-log-lille.fr/public/index.php'>vous connecter</a>";

			  		$userman->setValidated($pseudo);
			  		}
			  		else // if the two keys are different
			  		{
			  		// echo "Erreur ! Votre compte ne peut être activé...";
			  		}
	  	}

	  	$session->setSession('activKey', $activKey);
	  	$session->setSession('activationKey', $activationKey);
	  	$session->setSession('update_verfied',  $verified);

	}

	public function destroySession()
	{
		$session = new Session();
		$session->closeSession();
		
	}
	


}