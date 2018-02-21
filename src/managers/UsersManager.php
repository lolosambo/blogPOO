<?php
namespace P5\managers;

use P5\core\factories\DbFactory;
use P5\managers\MainManager;
use \PDO;


class UsersManager extends MainManager {
	protected $db;

	public function __construct() {
		$this->db = $this->getDb();

	}

	public function usersList() {
		$req = $this->db->getPdo()->query('SELECT * FROM Users ORDER BY pseudo DESC');
		$res = $req->fetchAll();
		return $res;	 
	}


	public function compareUsers($pseudo) {
		$req = $this->db->getPdo()->prepare('SELECT * FROM Users WHERE pseudo = :param');
		$req->bindParam(':param', $pseudo);
		$req->execute();
		$res = $req->fetch();
		return $res;
	}

    public function compareActivationKey($activationKey) {
        $req = $this->db->getPdo()->prepare('SELECT * FROM Users WHERE activationKey = :param');
        $req->bindParam(':param', $activationKey);
        $req->execute();
        $res = $req->fetch();
        return $res;
    }

    public function compareEmail($mail) {
        $req = $this->db->getPdo()->prepare('SELECT * FROM Users WHERE mail = :param');
        $req->bindParam(':param', $mail);
        $req->execute();
        $res = $req->fetch();
        return $res;
    }

    public function changePassword($password, $pseudo) {
        $password = sha1($password);
        $req = $this->getDb()->getPdo()->prepare('UPDATE Users SET password = :password WHERE pseudo = :pseudo');
        $req->bindParam(':pseudo', $pseudo);
        $req->bindParam(':password', $password);
        $req->execute();
        return $req;
    }

	public function deleteUser($pseudo) {
		$req = $this->db->getPdo()->prepare('DELETE FROM Users WHERE pseudo = :param');
		$req->bindParam(':param', $pseudo);
		$req->execute();
	}

	public function login($pseudo, $password) {

  		$password = sha1($password);
  		$pseudo = htmlspecialchars($pseudo);

  		$user = $this->db->getPdo()->prepare('SELECT * FROM Users WHERE pseudo = :pseudo AND password = :password');

  		$user->bindParam(':pseudo', $pseudo);
		$user->bindParam(':password', $password);
		$user->execute();
		$user_data=$user->fetch();
		return $user_data;
	}

	public function insertUser($pseudo, $password, $mail) {
  		 
  		 // Creation of a Random Activation Key
		$activation_key = random_int(100000000, 999999999);
		$password = sha1($password);
  		$pseudo = htmlspecialchars($pseudo);
  		$mail = htmlspecialchars($mail);

		$req = $this->db->getPdo()->prepare
		("
			INSERT INTO Users (pseudo, password, mail, activationKey, verified, idRole, inscrDate) 
			VALUES (:pseudo, :password, :mail, :activation_key, 0, 1, NOW())
		");

		$req->bindParam(':pseudo', $pseudo);
		$req->bindParam(':password', $password);
		$req->bindParam(':mail', $mail);
		$req->bindParam(':activation_key', $activation_key);
		$req->execute();
		return $activation_key;
	}

	public function get5LastUsers() {
		$req = $this->getDb()->getPdo()->query
			('
				SELECT *, DATE_FORMAT(inscrDate, "%d/%m/%Y à %Hh%i") AS inscrDate 
				FROM Users 
				ORDER BY inscrDate
				DESC LIMIT 0, 5
			');

			$res = $req->fetchAll();
			return $res;	
	}

	public function searchUser($pseudo) {

		$req = $this->db->getPdo()->prepare 
		('
			SELECT *, DATE_FORMAT(u.inscrDate, "%d/%m/%Y à %Hh%i") AS inscrDate  
			FROM Users AS u
			WHERE u.pseudo = :pseudo
	
		');

		$req->bindParam(':pseudo', $pseudo);
		$req->execute();
		$data=$req->fetch();

		return $data;

	}	

	public function updateToAdmin($pseudo) {
		$req = $this->getDb()->getPdo()->prepare('UPDATE Users SET idRole = 2 WHERE pseudo = :param');
		$req->bindParam(':param', $pseudo);
		$req->execute();
		return $req;
	}

	public function updateToUser($pseudo) {
		$req = $this->getDb()->getPdo()->prepare('UPDATE Users SET idRole = 1 WHERE pseudo = :param');
		$req->bindParam(':param', $pseudo);
		$req->execute();
		return $req;
	}

	public function accActivation($activKey) {

		$req = $this->getDb()->getPdo()->prepare('SELECT * FROM Users WHERE activationKey = :param');
		$req->bindParam(':param', $activKey);
		$req->execute();
		$res = $req->fetch();
		return $res;

	}

	public function setVerified($login) {

    	$req = $this->getDb()->getPdo()->prepare('UPDATE Users SET verified = 1 WHERE pseudo = :param');
		$req->bindParam(':param', $login);
		$req->execute();
		return $req;
    	
	}
}

