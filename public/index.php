<?php
require '../vendor/autoload.php';

use P5\core\Router\Router;
$router = new Router();
$session = new \Symfony\Component\HttpFoundation\Session\Session();


if (preg_match('#^(/admin/)#', $_SERVER['REQUEST_URI'], $match))
{

	if($session->get('id_role') == 2)
	{
		$router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
	}
	else
	{
		echo '<p>Cette section n\'est pas accessible</p>';
		echo '<p><a href="/">Retour à l\'accueil</a></p>';
	}
}

else
{

$router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

}






