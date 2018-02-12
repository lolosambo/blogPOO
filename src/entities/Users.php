<?php

namespace P5\entities;
use P5\core\interfaces\hydrateInterface;

class Users implements hydrateInterface
{

	private $id;
	private $pseudo;
	private $mail;
	private $password;
	private $activation_key;
	private $verified = 0;
	private $id_role = 1;
	private $inscr_date;




// INTERFACE METHOD

public function hydrate(array $donnees)
{
   foreach ($donnees as $key => $value)
   {
       $method = 'set'.ucfirst($key);

       if (method_exists($this, $method))
       {
         $this->$method($value);
       }
   }
}


// CONSTRUCTOR & HYDRATATION

	public function __construct(array $data)
	{

		$this->hydrate($data);

	}

// GETTERS---------------------------------

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

	public function getActivation_key()
	{
		return $this->activation_key;
	}

	public function getVerified()
	{
		return $this->verified;
	}

	public function getId_role()
	{
		return $this->id_role;
	}

	public function getInscr_date()
	{
		return $this->inscr_date;
	}


// SETTERS-----------------------------------

	
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

	public function setActivation_key($activationKey)
	{
		if(intval($activationKey))
		{
			$this->activation_key = $activationKey;
		}
	}


	public function setVerified($verified)
	{
		if(($verified == 0) || ($verified == 1))
		{
			$this->verified = $verified;
		}
	}

	public function setId_role($idRole)
	{
		if(intval($idRole) && (($idRole == 1) || ($idRole == 2)))
		{
			$this->id_role = $idRole;
		}
	}

	public function setInscr_date($date)
	{
		if(is_string($date))
		{
			$this->inscr_date = $date;
		}
	}





}









