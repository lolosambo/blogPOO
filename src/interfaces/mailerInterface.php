<?php
namespace p5\interfaces;


interface MailerInterface
{
	public function sendMailInscr($pseudo, $mail_add, $activKey);
	
	public function sendMailContact($name, $mail, $phone, $object, $message);



}