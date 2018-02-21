<?php
namespace P5\core\interfaces;

interface PasswordMailerInterface {

	public function sendMailPassword($pseudo, $activationKey, $mail_add);

}

