<?php

namespace P5\managers;
use P5\core\factories\DbFactory;
use \PDO;



abstract class MainManager
{

	protected $db;
	protected $validator;

	

	public function __construct()
	{
		$this->validator = new ManagerValidator();
	}

	public function getDb()
	{
  	 	$this->db = new DbFactory();
  	 	return $this->db;
	}
	

	

}


