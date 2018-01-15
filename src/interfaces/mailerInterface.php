<?php
namespace p5\interfaces;


interface MailerInterface
{
	public function sendMail($pseudo, $mail_add, $activKey);

}