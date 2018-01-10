<?php

namespace p5\database;

class DbConfig
{
	
	private $dbConfig;

	public function __construct()
	{
		$this->loadConfigFile();
	}

	private function loadConfigFile()
	{
		$this->dbConfig = require __DIR__ . '/DbLogin.php';
			
	}

	public function getConfig()
	{
		return $this->dbConfig;
	}

}


