<?php

namespace p5\managers;
use p5\database\DbFactory;
use \PDO;


class UsersManager
{

	private $db;




	public function __construct()
	{
  	 	$this->db = new DbFactory();
	}


	public function getUser($pseudo, $password)
	{
  		$password = sha1($password);
  		$pseudo = htmlspecialchars($pseudo);
  		$user = $this->db->getPdo()->prepare('SELECT * FROM Users WHERE pseudo = :pseudo AND password = :password');
  		$user->bindParam(':pseudo', $pseudo);
		$user->bindParam(':password', $password);
		$user->execute();
		$user_data=$user->fetch();
		return $user_data;
	}


	public function getUsersList()
	{
		$req = $this->db->getPdo()->query('SELECT * FROM Users ORDER BY inscr_date DESC');
		$res = $req->fetchAll();
		return $res;

	}

	public function addUser($pseudo, $password, $mail)
	{
  		 
  		 // Creation of a Random Activation Key
		$activation_key = random_int(100000000, 999999999);
		$password = sha1($password);
  		$pseudo = htmlspecialchars($pseudo);
  		$mail = htmlspecialchars($mail);

		$req = $this->db->getPdo()->prepare
		("
			INSERT INTO Users (pseudo, password, mail, activation_key, verified, id_role) 
			VALUES (:pseudo, :password, :mail, :activation_key, 0, 1)
		");

		$req->bindParam(':pseudo', $pseudo);
		$req->bindParam(':password', $password);
		$req->bindParam(':mail', $mail);
		$req->bindParam(':activation_key', $activation_key);
		$req->execute();
		// $_SESSION['activation_key'] = $activation_key;

		$res = $req->fetch();
		return $res;
	}


	public function compareUsers($pseudo)
	{
		$req = $this->db->getPdo()->prepare('SELECT * FROM Users WHERE pseudo = :pseudo');
		$req->bindParam(':pseudo', $pseudo);
		$req->execute();
		$res=$req->fetch();
		return $res;
	
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