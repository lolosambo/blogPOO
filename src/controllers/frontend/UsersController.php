<?php
namespace p5\controllers\frontend;
use Sendgrid\Email;
use Sendgrid\Content;
use Sendgrid\Mail;
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

	public function sendMail($pseudo, $mail_add, $activKey)
	{

		require "../vendor/autoload.php";

		$from = new Email('Laurent BERTON', "lolosambo2@gmail.com");
		$subject = "Confirmation de votre inscription sur le blog de Laurent BERTON";
		$to = new Email($pseudo, $mail_add);
		$content = new Content("text/plain", "<p>Bonjour '.ucfirst($pseudo).' et bienvenue sur le blog professionnel de Laurent BERTON,</p>
 
			<p>Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur.</p>
 
			<p><a href='index.php?action=activation&amp;log='.$pseudo.'&amp;key='.$activKey.''</a></p><br><br>
 
 
			---------------<br>
			<p>Ceci est un mail automatique, Merci de ne pas y répondre.</p>");
		$mail = new Mail($from, $subject, $to, $content);
		$apiKey = getenv('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');
		$sg = new \SendGrid($apiKey);
		$response = $sg->client->mail()->send()->post($mail);
		echo $response->statusCode();
		print_r($response->headers());
		echo $response->body();


		// $objet = 'Confirmation de votre inscription sur le blog de Laurent BERTON' ;
		// 	$to = $mail_add;
		// 	$header =
		// 	'Content-type: text/html; charset=utf-8' . "\r\n" .
		// 	'From: lolosambo2@gmail.com' . "\r\n" .
		// 	'Reply-To: lolosambo2@gmail.com' . "\r\n" .
		// 	'X-Mailer: PHP/' . phpversion();

		// 	$message = 
		// 	'<p>Bonjour '.ucfirst($pseudo).' et bienvenue sur le blog professionnel de Laurent BERTON,</p>
 
		// 	<p>Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur.</p>
 
		// 	<p><a href="index.php?action=activation&amp;log='.$pseudo.'&amp;key='.$activKey.'"</a></p><br><br>
 
 
		// 	---------------<br>
		// 	<p>Ceci est un mail automatique, Merci de ne pas y répondre.</p>';
          
		// 	//Send mail
		// 	mail($to, $objet, $message, $header);


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