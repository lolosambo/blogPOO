<?php
namespace P5\controllers\frontend;

use P5\core\factories\ControllerFactory;

class LoginController {

	private $controller;
	private $session;
	private $request;
	private $twig;


	public function __construct() {
		$controller = new ControllerFactory();
		$this->controller = $controller; 
		$this->session = $controller->getSession(); 
		$this->twig = $controller->getTwig();
		$this->request = $controller->getRequest();
	}


	public function __invoke() {

        $url = $this->request->server->get('REQUEST_URI');
        preg_match('#^/passwordReinitializeForm/([0-9]+)$#', $url, $urlWithId);
        $connecter = $this->request->request->get('connecter');
        $inscrire = $this->request->request->get('inscrire');
        $compare = $this->request->request->get('compare');
        $reinitialize = $this->request->request->get('reinitialize');
        $pseudo = $this->request->request->get(htmlspecialchars('pseudo'));
        $password = $this->request->request->get(htmlspecialchars('password'));
        $password1 = $this->request->request->get(htmlspecialchars('password1'));
        $password2 = $this->request->request->get(htmlspecialchars('password2'));
        $mail = $this->request->request->get(htmlspecialchars('mail'));

        if ($url == '/inscriptionForm/') {
            echo $this->twig->render('views/frontend/inscription_view.twig');


        } elseif ($url == '/logout/') {
            $this->session->clear();
            echo $this->twig->render('views/frontend/connection_view.twig');


        } elseif (isset($connecter)) {
            $user = $this->controller->getFrontController('UserConnectionController');
            $user->login($pseudo, $password);
            if ($this->session->get('id_role') == 2) {
                $pseudo = $this->session->get('pseudo');
                echo $this->twig->render('views/frontend/loginAdmin.twig', ['pseudo' => $pseudo]);

            } elseif ($this->session->get('id_role') == 1) {
                $pseudo = $this->session->get('pseudo');
                echo $this->twig->render('views/frontend/loginMember.twig', ['pseudo' => $pseudo]);

            } elseif ($this->session->get('pseudo') == FALSE) {
                echo $this->twig->render('views/frontend/errorConnection.twig');
            }

        } elseif ($this->session->get('id_role') == 2) {
            $pseudo = $this->session->get('pseudo');
            echo $this->twig->render('views/frontend/loginAdmin.twig', ['pseudo' => $pseudo]);

        } elseif ($this->session->get('id_role') == 1) {
            $pseudo = $this->session->get('pseudo');
            echo $this->twig->render('views/frontend/loginMember.twig', ['pseudo' => $pseudo]);


        } elseif (isset($inscrire)) {
            $user = $this->controller->getFrontController('UserInscriptionController');
            $user->addUser($pseudo, $password1, $password2, $mail);

            if ($pseudo == $this->session->get('db_pseudo')) {
                echo $this->twig->render('views/frontend/pseudoAllreadyExist.twig');

            } elseif (empty($pseudo) || empty($password1) || empty($password2) || empty($mail)) {
                echo $this->twig->render('views/frontend/uncompletedForm.twig');

            } elseif ($password1 != $password2) {
                echo $this->twig->render('views/frontend/differentPasswords.twig');

            } else {
                $user = $this->controller->getFrontController('UserInscriptionController');
                $user->addUser($pseudo, $password, $password, $mail);
                echo $this->twig->render('views/frontend/inscriptionOk.twig');
            }


        } elseif ($url == '/activation/') {
            $account = $this->controller->getFrontController('AccountController');
            $account->account_activation($pseudo, $activKey);



        } elseif ($url == "/forgotPasswordForm/") {
            echo $this->twig->render('views/frontend/forgotPasswordForm.twig');


        } elseif (isset($compare) && empty($mail)) {
            echo $this->twig->render('views/frontend/PasswordFormUncomplete.twig');

        } elseif (isset($compare) && !empty($mail)) {
            $req = $this->controller->getFrontController('ForgotPasswordController');
            $user = $req->checkMail($mail);

                if (isset($compare) && empty($user)) {
                    echo $this->twig->render('views/frontend/forgotPasswordInvalidMail.twig');

                } elseif (isset($compare) && !empty($user)) {
                    echo $this->twig->render('views/frontend/confirmeMail.twig');

                } else {
                    echo $this->twig->render('views/frontend/forgotPasswordForm.twig');
                }


        } elseif ($url == $urlWithId[0]) {
            $req = $this->controller->getFrontController('ForgotPasswordController');
            $req->reinitializationForm($urlWithId[1]);

        }elseif (isset($reinitialize) && (empty($password1) || empty($password2))) {
            echo $this->twig->render('views/frontend/reinitializeFormUncomplete.twig');

        } elseif (isset($reinitialize) && ($password1 != $password2)) {
            echo $this->twig->render('views/frontend/reinitializeDifferentPasswords.twig');

        } elseif (isset($reinitialize)) {
            preg_match('#/passwordReinitialize/([a-zA-Z-_0-9]+)$#', $url, $match);
            $user = $this->controller->getFrontController('ForgotPasswordController');
            $user->updatePassword($password1, $match[1]);
            echo $this->twig->render('views/frontend/reinitializationOk.twig');


        } else {
            echo $this->twig->render('views/frontend/connection_view.twig');
        }


    }
}
