<?php

namespace p5\managers;
use p5\database\DbFactory;


class UsersManager
{

	private $db;



	public function __construct()
	{
  	 	$this->db = new DbFactory();
	}


	public function getUser($pseudo, $password)
	{
  		$user = $this->db->getPdo()->prepare('SELECT * FROM Users WHERE pseudo = :pseudo AND password = :password');
  		$user->bindParam(':pseudo', htmlspecialchars($pseudo));
		$user->bindParam(':password', sha1($password));
		$user->execute();
		$user_data=$user->fetch();
	}


	public function getUsersList()
	{
		$req = $this->db->getPdo()->query('SELECT * FROM Users ORDER BY inscr_date DESC');
		return $req;

	}

	public function addUser($pseudo, $password, $mail)
	{
  		 
  		 // Creation of a Random Activation Key
		$activation_key = random_int(100000000, 999999999);

		$req = $this->db->getPdo()->prepare
		("
			INSERT INTO Users (pseudo, password, mail, activation_key, verified, id_role) 
			VALUES (:pseudo, :password, :mail, :activation_key, 0, 1)
		");

		$req->bindParam(':pseudo', htmlspecialchars($pseudo));
		$req->bindParam(':password', sha1($password));
		$req->bindParam(':mail', htmlspecialchars($mail));
		$req->bindParam(':activation_key', $activation_key);
		$req->execute();
		// $_SESSION['activation_key'] = $activation_key;
		return $req;
	}


	public function compareUsers($pseudo)
	{
		$req = $this->db->getPdo()->prepare('SELECT * FROM Users WHERE pseudo = :pseudo');
		$req->bindParam(':pseudo', $pseudo);
		$req->execute();
		$result=$req->fetch();
		return $result;
	
	}


	public function accActivation($pseudo, $key)
	{
		$req = $this->db->getPdo()->prepare("SELECT activation_key, verified FROM Users WHERE pseudo like :pseudo");
		$req->bindParam(':pseudo', $pseudo);
		$req->execute();
		$data = $req->fetch();
		return $data;
	}


	public function setValidated($login)
	{
		
		$req = $this->db->getPdo()->prepare("UPDATE Users SET verified = 1 WHERE pseudo like :login ");
   	 	$req->bindParam(':login', $login);
    	$req->execute();
	}

	


}