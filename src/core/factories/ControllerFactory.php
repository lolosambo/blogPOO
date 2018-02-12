<?php

namespace P5\core\factories;
use P5\core\controllers\SessionController;
use P5\core\factories\TableFactory;
use P5\core\factories\BuilderFactory;


class ControllerFactory
{

	private $controller;
	private $session;
	private $twig;
	private $request;
	private $response;
	private $table;
	private $builder;

	public function __construct()
	{
		$loader = new \Twig_Loader_Filesystem('../');
		$twig = new \Twig_Environment($loader, ['cache' => false]);
		$req = new \Symfony\Component\HttpFoundation\Request();
		$request = $req::createFromGlobals();
		$response = new \Symfony\Component\HttpFoundation\Response();
		$session = new \Symfony\Component\HttpFoundation\Session\Session();
		$table = new TableFactory();
		$builder = new BuilderFactory();
		$this->twig = $twig;
		$this->request = $request;
		$this->response = $response;
		$this->session = $session;
		$this->table = $table;
		$this->builder = $builder;
	}


	public function getTwig() { return $this->twig; }
	public function getRequest() { return $this->request; }
	public function getResponse() { return $this->response; }
	public function getSession() { return $this->session; }
	public function getTable() { return $this->table; }
	public function getBuilder() { return $this->builder; }

	public function getFrontController($action)
	{	
		$action = ucfirst($action);
		$namespace = 'P5\\controllers\\frontend\\'.$action;
		$this->controller = new $namespace();
		return $this->controller;
		
	}

	public function getBackController($action)
	{	
		$action = ucfirst($action);
		$namespace = 'P5\\controllers\\backend\\'.$action;
		$this->controller = new $namespace();
		return $this->controller;
		
	}


}


