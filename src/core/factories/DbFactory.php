<?php 

namespace P5\core\factories;
use P5\core\database\DbConfig;
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
      $db =  new PDO('mysql:host='.$this->config->getConfig()['host'].';dbname='.$this->config->getConfig()['dbname'], $this->config->getConfig()['user'], $this->config->getConfig()['pass']);

      $db->exec("SET CHARACTER SET utf8");
      return $db;
  }

}