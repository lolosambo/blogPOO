<?php
session_start();
require 'vendor/autoload.php';
use p5\app\Session;
$test = new Session();

echo $test->getSessionVar('pseudo');




var_dump($_SESSION);