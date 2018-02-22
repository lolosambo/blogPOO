<?php
namespace P5\controllers\frontend;

use P5\core\factories\ControllerFactory;

class ContactController {
	
	private $factory;
	private $request;
	
	public function __construct() {
		$this->factory = new ControllerFactory();
		$this->request = $this->factory->getRequest();
		
	}

	public function __invoke() {
	
		$name = $this->request->request->get('name');
		$mail = $this->request->request->get('email');
		$phone = $this->request->request->get('phone');
		$message = $this->request->request->get('message');

		$objet = 'Message de B-LOG : ';
		$to = 'blogwattignies@gmail.com';
		$header =
		'Content-type: text/html; charset=utf-8' . "\r\n" .
		'From: blogwattignies@gmail.com' . "\r\n" .
		'Reply-To: '.$mail."\r\n" .
		'X-Mailer: PHP/' . phpversion();

		$message = 
		'<p>Message en provenance de '.$name.'.</p>
		<p>Numéro de téléphone : '.$phone.'</p>
		<p>Adresse mail : '.$mail.'</p>
		<p>Message : '.$message.'</p>';
          
		//Send mail
		mail($to, $objet, $message, $header);

		echo $this->factory->getTwig()->render('views/frontend/contactOk.twig');

	}

}

