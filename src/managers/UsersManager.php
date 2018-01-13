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
			INSERT INTO Users (pseudo, password, mail, activation_key, verified, id_role, inscr_date) 
			VALUES (:pseudo, :password, :mail, :activation_key, 0, 1, NOW())
		");

		$req->bindParam(':pseudo', $pseudo);
		$req->bindParam(':password', $password);
		$req->bindParam(':mail', $mail);
		$req->bindParam(':activation_key', $activation_key);
		$req->execute();
		// $_SESSION['activation_key'] = $activation_key;
		return $activation_key;
	}


	public function compareUsers($pseudo)
	{
		$req = $this->db->getPdo()->prepare('SELECT * FROM Users WHERE pseudo = :pseudo');
		$req->bindParam(':pseudo', $pseudo);
		$req->execute();
		$res=$req->fetch();
		return $res;
	
	}

	public function get5LastUsers()
	{

		$req = $this->db->getPdo()->query 
		('
			SELECT *, DATE_FORMAT(u.inscr_date, "%d/%m/%Y à %Hh%i") AS inscr_date  FROM Users AS u
			ORDER BY id
			DESC
			LIMIT 0, 5
		');

		return $req;
	}

	public function searchUser($pseudo)
	{

		$req = $this->db->getPdo()->prepare 
		('
			SELECT *, DATE_FORMAT(u.inscr_date, "%d/%m/%Y à %Hh%i") AS inscrDate  
			FROM Users AS u
			WHERE u.pseudo = :pseudo
	
		');

		$req->bindParam(':pseudo', $pseudo);
		$req->execute();
		$data=$req->fetch();

		return $data;

	}	


	public function updateToAdmin($pseudo)
	{
		$req = $this->db->getPdo()->prepare
		('
			UPDATE Users SET id_role = 2
			WHERE pseudo = :pseudo
	
		');

		$req->bindParam(':pseudo', $pseudo);
		$req->execute();

		return $req;

	}

	public function updateToUser($pseudo)
	{
		$req = $this->db->getPdo()->prepare
		('
			UPDATE Users SET id_role = 1
			WHERE pseudo = :pseudo
	
		');

		$req->bindParam(':pseudo', $pseudo);
		$req->execute();

		return $req;

	}


	public function eraseUser($pseudo)
	{

		$req = $this->db->getPdo()->prepare
		('
			DELETE FROM Users
			WHERE pseudo = :pseudo
	
		');

		$req->bindParam(':pseudo', $pseudo);
		$req->execute();

		return $req;
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