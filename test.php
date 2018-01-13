<?php
require 'vendor/autoload.php';
use p5\app\Session;
$test = new Session();


$test->setSession('pseudo', 'trucmuche');
$test->setSession('id_role', 2);
$test->setSession('verified', 1);


echo $test->getSessionVar('pseudo').'<br>';
echo $test->getSessionVar('id_role').'<br>';
echo $test->getSessionVar('verified').'<br>';



var_dump($_SESSION).'<br>';











