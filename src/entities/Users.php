<?php
namespace P5\entities;

use P5\core\interfaces\hydrateInterface;

class Users implements hydrateInterface
{
	private $id;
	private $pseudo;
	private $mail;
	private $password;
	private $activationKey;
	private $verified = 0;
	private $idRole = 1;
	private $inscrDate;

	public function hydrate(array $donnees)
	{
   		foreach ($donnees as $key => $value) {
      		$method = 'set'.ucfirst($key);

      		 if (method_exists($this, $method)) {
       		  $this->$method($value);
      		 }
  		 }
	}

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function getId()
	{
		return $this->id;
	}

	public function getPseudo()
	{
		return $this->pseudo;
	}

	public function getMail()
	{
		return $this->mail;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getActivationKey()
	{
		return $this->activationKey;
	}

	public function getVerified()
	{
		return $this->verified;
	}

	public function getIdRole()
	{
		return $this->idRole;
	}

	public function getInscrDate()
	{
		return $this->inscrDate;
	}

	
	public function setId($id)
	{
		if(intval($id))
		{
			$this->id = $id;
		}
	}

	public function setPseudo($pseudo)
	{
		if(is_string($pseudo))
		{
			$this->pseudo = $pseudo;
		}
	}

	public function setMail($mail)
	{
		if(is_string($mail))
		{
			$this->mail = $mail;
		}
	}

	public function setPassword($password)
	{
		if(is_string($password))
		{
			$this->password = $password;
		}
	}

	public function setActivationKey($activationKey)
	{
		if(intval($activationKey))
		{
			$this->activationKey = $activationKey;
		}
	}


	public function setVerified($verified)
	{
		if(($verified == 0) || ($verified == 1))
		{
			$this->verified = $verified;
		}
	}

	public function setIdRole($idRole)
	{
		if(intval($idRole) && (($idRole == 1) || ($idRole == 2)))
		{
			$this->idRole = $idRole;
		}
	}

	public function setInscrDate($date)
	{
		if(is_string($date))
		{
			$this->inscrDate = $date;
		}
	}
}













