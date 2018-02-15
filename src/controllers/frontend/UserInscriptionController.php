<?php
namespace P5\controllers\frontend;

use P5\core\factories\ControllerFactory;
use P5\core\interfaces\InscrMailerInterface;


class UserInscriptionController implements InscrMailerInterface
{

	protected $userman;
	protected $session;

	public function __construct()
	{

		$factory = new ControllerFactory();
		$userman = $factory->getTable()->Table('users');
		$this->userman = $userman;
		$session = $factory->getSession();
		$this->session = $session;
		
	}

	
	public function addUser($pseudo, $password1, $password2, $mail)
	{
		
		$res = $this->userman->compareUsers('pseudo', $pseudo);
		$this->session->set('db_pseudo', $res['pseudo']);
		
		if ($pseudo == $res['pseudo']) {
		} elseif (empty($pseudo) || empty($password1) || empty($password2) || empty($mail)) {
		} else if ($password1 !== $password2) {
		} else {
			$activKey = $this->userman->insertUser($pseudo, $password1, $mail);
			$this->session->set('activation_key', $activKey);
			$this->sendMailInscr($pseudo, $mail, $activKey);
			return $activKey;
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
 
		<p><a href="http://www.b-log-lille.fr/activation/'.$pseudo.'/'.$activKey.'">Activez votre compte</a></p><br><br>
 
 
		---------------<br>
		<p>Ceci est un mail automatique, Merci de ne pas y répondre.</p>';
          
		//Send mail
		mail($to, $objet, $message, $header);
	}

}

