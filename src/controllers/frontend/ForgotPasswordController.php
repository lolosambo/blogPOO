<?php


namespace P5\controllers\frontend;

use P5\core\factories\ControllerFactory;
use P5\core\interfaces\PasswordMailerInterface;

class ForgotPasswordController implements PasswordMailerInterface {

    private $userman;
    private $factory;

    public function __construct() {
        $factory = new ControllerFactory();
        $this->factory = $factory;
        $manager = $factory->getTable()->Table('Users');
        $this->userman = $manager;
    }

    public function checkMail($mail) {

        $res = $this->userman->compareEmail($mail);

        if (empty($res['mail'])) {
        //*****//
        } else {
            $this->sendMailPassword($res['pseudo'], $res['activationKey'], $mail);
        }
        return $res['pseudo'];
    }

    public function updatePassword($password, $pseudo) {
        $this->userman->changePassword($password, $pseudo);
    }

    public function reinitializationForm($activationKey) {
        $user = $this->userman->compareActivationKey($activationKey);

        if ($activationKey == $user['activationKey']) {
            echo $this->factory->getTwig()->render('views/frontend/passwordReinitializeForm.twig', ['user' => $user]);

        } else {
            echo $this->factory->getTwig()->render('views/frontend/errorReinitialization.twig');
        }
    }

    public function sendMailPassword($pseudo, $activationKey, $mail_add) {

        $objet = 'Blog de Laurent BERTON : Réinitialisation de mot de passe' ;
        $to = $mail_add;
        $header =
            'Content-type: text/html; charset=utf-8' . "\r\n" .
            'From: contact@b-log-lille.fr' . "\r\n" .
            'Reply-To: contact@b-log-lille.fr' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $message =
            '<p>Bonjour '.ucfirst($pseudo).'. Vous êtes inscrit sur le blog professionnel de Laurent BERTON.</p>
 
		<p>Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien ci-dessous ou copier/coller dans votre navigateur.</p>
 
		<p><a href="http://www.tutoocr.fr/passwordReinitializeForm/'.$activationKey.'">Réinitialiser le mot de passe</a></p><br><br>
 
 
		---------------<br>
		<p>Ceci est un mail automatique, Merci de ne pas y répondre.</p>';

        //Send mail
        mail($to, $objet, $message, $header);
    }

}










