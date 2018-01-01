<?php

namespace p5\database;

class DbConfig
{
	
	private $dbConfig;

	public function __contruct()
	{
		$this->loadConfigFile();
	}

	private function loadConfigFile()
	{
		$file = require __DIR__ . '/DbLogin.php';
		$this->dbConfig = $file;
		
	}

	public function getConfig()
	{
		return $this->dbConfig;
	}

	



}


