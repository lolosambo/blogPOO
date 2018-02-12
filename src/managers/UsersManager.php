<?php

namespace P5\managers;
use P5\core\factories\DbFactory;
use P5\managers\MainManager;
use \PDO;


class UsersManager extends MainManager
{

	protected $db;

	public function __construct()
	{
		$this->getDb(); 
  	 	return $this->db;
	}


	public function usersList()
	{
		return $this->getAllBy('Users', 'pseudo', 0, 100);	 
	}


	public function compareUsers($column, $pseudo)
	{
		return $this->getOne('Users', $column, $pseudo);
	}


	public function deleteUser($pseudo)
	{
		return $this->erase('Users', 'pseudo', $pseudo);
	}


	public function login($pseudo, $password)
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


	public function insertUser($pseudo, $password, $mail)
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
		return $activation_key;
	}


	

	public function get5LastUsers()
	{
		$req = $this->getAllByDate('inscr_date', 'Users', 'inscr_date', 0, 5);
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
		return $this->update('Users', 'id_role', 2, 'pseudo', $pseudo);	
	}

	public function updateToUser($pseudo)
	{
		return $this->update('Users', 'id_role', 1, 'pseudo', $pseudo);
	}


	


	public function accActivation($pseudo)
	{
		return $this->getOne('Users', 'pseudo', $pseudo);

	}


	public function setVerified($login)
	{
		
    	return $this->update('Users', 'verified', 1, 'pseudo', $login);
    	
	}

	


}

