<?php
namespace P5\controllers\frontend;
use P5\core\factories\ControllerFactory;

class ContactController 
{
	

	private $request;
	
	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->request = $factory->getRequest();
		
	}

	public function __invoke($name, $mail, $phone, $subject, $message)
	{
	
		$name = $this->request->request->get('name');
		$mail = $this->request->request->get('mail');
		$phone = $this->request->request->get('phone');
		$subject = $this->request->request->get('object');
		$message = $this->request->request->get('message');

		$objet = 'Message de B-LOG : '.$subject ;
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

}

