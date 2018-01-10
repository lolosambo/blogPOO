<?php


require 'vendor/autoload.php';
use p5\managers\SessionManager;
use p5\managers\PostsManager;
use p5\managers\UsersManager;
use p5\controllers\frontend\PostsController;
use p5\entities\Posts;
use p5\entities\Users;




$test = new UsersManager();

$res = $test->getUser('laurentb', '010377');

var_dump($res);









