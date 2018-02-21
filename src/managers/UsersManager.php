<?php
namespace P5\managers;

use P5\core\factories\DbFactory;
use P5\managers\MainManager;
use \PDO;


class UsersManager extends MainManager {
	protected $db;

	public function __construct() {
		$this->db = $this->getDb();
        parent::__construct();

	}

	public function usersList() {
		$req = $this->db->getPdo()->query('SELECT * FROM Users ORDER BY pseudo DESC');
		$res = $req->fetchAll();
		return $res;	 
	}


	public function compareUsers($pseudo) {
        $pseudo = $this->validator->validateSQL($pseudo);
        $pseudoVal = $this->validator->validateJavascript($pseudo);

		$req = $this->db->getPdo()->prepare('SELECT * FROM Users WHERE pseudo = :param');
		$req->bindParam(':param', $pseudoVal);
		$req->execute();
		$res = $req->fetch();
		return $res;
	}

    public function compareActivationKey($activationKey) {

        $activationKey = $this->validator->validateSQL($activationKey);
        $activationKeyVal = $this->validator->validateJavascript($activationKey);

        $req = $this->db->getPdo()->prepare('SELECT * FROM Users WHERE activationKey = :param');
        $req->bindParam(':param', $activationKeyVal);
        $req->execute();
        $res = $req->fetch();
        return $res;
    }

    public function compareEmail($mail) {
        $mail = $this->validator->validateSQL($mail);
        $mailVal = $this->validator->validateJavascript($mail);
        $req = $this->db->getPdo()->prepare('SELECT * FROM Users WHERE mail = :param');
        $req->bindParam(':param', $mailVal);
        $req->execute();
        $res = $req->fetch();
        return $res;
    }

    public function changePassword($password, $pseudo) {

        $pseudo = $this->validator->validateSQL($pseudo);
        $pseudoVal = $this->validator->validateJavascript($pseudo);
        $password = $this->validator->validateSQL($password);
        $passwordVal = $this->validator->validateJavascript($password);

        $passwordVal = sha1($password);
        $req = $this->getDb()->getPdo()->prepare('UPDATE Users SET password = :password WHERE pseudo = :pseudo');
        $req->bindParam(':pseudo', $pseudoVal);
        $req->bindParam(':password', $passwordVal);
        $req->execute();
        return $req;
    }

	public function deleteUser($pseudo) {

        $pseudo = $this->validator->validateSQL($pseudo);
        $pseudoVal = $this->validator->validateJavascript($pseudo);

		$req = $this->db->getPdo()->prepare('DELETE FROM Users WHERE pseudo = :param');
		$req->bindParam(':param', $pseudoVal);
		$req->execute();
	}

	public function login($pseudo, $password) {

        $pseudo = $this->validator->validateSQL($pseudo);
        $pseudoVal = $this->validator->validateJavascript($pseudo);
        $password = $this->validator->validateSQL($password);
        $passwordVal = $this->validator->validateJavascript($password);

  		$passwordVal = sha1($passwordVal);
  		$pseudoVal = htmlspecialchars($pseudoVal);

  		$user = $this->db->getPdo()->prepare('SELECT * FROM Users WHERE pseudo = :pseudo AND password = :password');

  		$user->bindParam(':pseudo', $pseudoVal);
		$user->bindParam(':password', $passwordVal);
		$user->execute();
		$user_data=$user->fetch();
		return $user_data;
	}

	public function insertUser($pseudo, $password, $mail) {

        $pseudo = $this->validator->validateSQL($pseudo);
        $pseudoVal = $this->validator->validateJavascript($pseudo);
        $password = $this->validator->validateSQL($password);
        $passwordVal = $this->validator->validateJavascript($password);
        $mail = $this->validator->validateSQL($mail);
        $mailVal = $this->validator->validateJavascript($mail);
  		 
  		 // Creation of a Random Activation Key
		$activation_key = random_int(100000000, 999999999);
		$passwordVal = sha1($passwordVal);
  		$pseudoVal = htmlspecialchars($pseudoVal);
  		$mailVal = htmlspecialchars($mailVal);

		$req = $this->db->getPdo()->prepare
		("
			INSERT INTO Users (pseudo, password, mail, activationKey, verified, idRole, inscrDate) 
			VALUES (:pseudo, :password, :mail, :activation_key, 0, 1, NOW())
		");

		$req->bindParam(':pseudo', $pseudoVal);
		$req->bindParam(':password', $passwordVal);
		$req->bindParam(':mail', $mailVal);
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

        $pseudo = $this->validator->validateSQL($pseudo);
        $pseudoVal = $this->validator->validateJavascript($pseudo);

		$req = $this->db->getPdo()->prepare 
		('
			SELECT *, DATE_FORMAT(u.inscrDate, "%d/%m/%Y à %Hh%i") AS inscrDate  
			FROM Users AS u
			WHERE u.pseudo = :pseudo
	
		');

		$req->bindParam(':pseudo', $pseudoVal);
		$req->execute();
		$data=$req->fetch();

		return $data;

	}	

	public function updateToAdmin($pseudo) {

        $pseudo = $this->validator->validateSQL($pseudo);
        $pseudoVal = $this->validator->validateJavascript($pseudo);

		$req = $this->getDb()->getPdo()->prepare('UPDATE Users SET idRole = 2 WHERE pseudo = :param');
		$req->bindParam(':param', $pseudoVal);
		$req->execute();
		return $req;
	}

	public function updateToUser($pseudo) {

        $pseudo = $this->validator->validateSQL($pseudo);
        $pseudoVal = $this->validator->validateJavascript($pseudo);


		$req = $this->getDb()->getPdo()->prepare('UPDATE Users SET idRole = 1 WHERE pseudo = :param');
		$req->bindParam(':param', $pseudoVal);
		$req->execute();
		return $req;
	}

	public function accActivation($activKey) {

        $activKey = $this->validator->validateSQL($activKey);
        $activKeyVal = $this->validator->validateJavascript($activKey);

		$req = $this->getDb()->getPdo()->prepare('SELECT * FROM Users WHERE activationKey = :param');
		$req->bindParam(':param', $activKeyVal);
		$req->execute();
		$res = $req->fetch();
		return $res;

	}

	public function setVerified($login) {

        $login = $this->validator->validateSQL($login);
        $loginVal = $this->validator->validateJavascript($login);

    	$req = $this->getDb()->getPdo()->prepare('UPDATE Users SET verified = 1 WHERE pseudo = :param');
		$req->bindParam(':param', $loginVal);
		$req->execute();
		return $req;
    	
	}
}

