<?php
require 'vendor/autoload.php';

use p5\builders\Builder;


$builder = new Builder();



$data = $builder->createManager('users')->build()->getUser('laurentb', '010377');
$data2 = $builder->createManager('posts')->build()->getPost(27);



$object = $builder->createEntities('users', $data)->build();
$object2 = $builder->createEntities('posts', $data2)->build();





var_dump($object).'<br>';

var_dump($object2).'<br>';


echo $object2->getPost_title();








