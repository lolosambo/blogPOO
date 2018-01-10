<?php
namespace p5\traits;

trait MailerTrait 
{


public function sendMail($pseudo, $mail, $activKey)
{
			$objet = 'Confirmation de votre inscription sur le blog de Laurent BERTON' ;
			$to = $mail;
			$header =
			'Content-type: text/html; charset=utf-8' . "\r\n" .
			'From: lolosambo2@gmail.com' . "\r\n" .
			'Reply-To: lolosambo2@gmail.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

			$message = 
			'<p>Bonjour '.ucfirst($pseudo).' et bienvenue sur le blog professionnel de Laurent BERTON,</p>
 
			<p>Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur.</p>
 
			<p><a href="index.php?action=activation&amp;log='.$pseudo.'&amp;key='.$activKey.'"</a></p><br><br>
 
 
			---------------<br>
			<p>Ceci est un mail automatique, Merci de ne pas y répondre.</p>';
          
			//Send mail
			mail($to, $objet, $message, $header);

}

}