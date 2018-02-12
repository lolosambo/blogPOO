<?php
namespace P5\core\interfaces;


interface ContactMailerInterface
{

	public function sendMailContact($name, $mail, $phone, $object, $message);

}

