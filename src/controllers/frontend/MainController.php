<?php 

namespace p5\controllers\frontend;

class MainController
{

	const PATH = '../src/managers/';
	protected $model;


	public function getModel($model_name)
	{
		$this->model = require (self::PATH.ucfirst($model_name).'Manager.php');
		return $this->model;
	}

}













