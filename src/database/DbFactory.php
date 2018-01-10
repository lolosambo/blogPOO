<?php 

namespace p5\database;
use \p5\database\DbConfig;
use \PDO;


class DbFactory
{
	private $config;

	private $host;
  private $driver;
  private $db_name;
  private $user;
  private $pass;


  public function __construct()
  {
  	$this->config = new DbConfig;
  }
  	
  public function getPdo()
  {
      return new PDO('mysql:host='.$this->config->getConfig()['host'].';dbname='.$this->config->getConfig()['dbname'], $this->config->getConfig()['user'], $this->config->getConfig()['pass']);
  }

}