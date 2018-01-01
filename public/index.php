<?php

require '../vendor/autoload.php';
use p5\managers\SessionManager;
use p5\managers\UsersManager;


$sessionMan = new SessionManager();


?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" type="text/css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" type="text/css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js" type="text/css"/>
	<link rel="stylesheet" href="css/style.css" type="text/css"/>

</head>
<body>

<?php



// require('../src/controlers/frontend/main_controler.php');



$manager = new UsersManager;

// $data = $manager->getUser(113);


// echo $data->mail;

$sessionMan->setSession('pseudo', 'Autre exemple');

echo $sessionMan->getSession('pseudo');
?>

<form action='' method='POST'>
	<input type="text" name='name'/>
	<input type="text" name='password'/>
	<input type="text" name='mail'/>
	<button type="submit">Valider</button>

</form>




</body>
</html>