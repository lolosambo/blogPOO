<?php 

namespace blog\database;
use \PDO;

class Database
{

	// const DB_HOST : "localhost";
	// const DB_USER : "root";
	// const DB_PASS : "root";
	// const DB_NAME : "bloglilldqocrp5";

	private $dbHost;
	private $dbUser;
	private $dbPass;
	private $dbName;
	private $pdo;



	public function __construct($dbHost = "localhost", $dbName = "bloglilldqocrp5", $dbUser = "root", $dbPass = "root")
	{
		$this->dbHost = $dbHost;
		$this->dbName = $dbName;
		$this->dbUser = $dbUser;
		$this->dbPass = $dbPass;
	}

	public function getPdo()
	{

		if ($this->pdo === NULL)
		{
			$pdo = new PDO('mysql:host=localhost;dbname=bloglilldqocrp5', 'root', 'root');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo = $pdo;
		}
		return $this->pdo;
	}


	public function query($req)
	{
		$query = $this->getPdo()->query($req);
		// $data = $query->fetch();
		return $query;
	}


}