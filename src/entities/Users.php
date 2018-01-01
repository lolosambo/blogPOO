<?php

namespace blog\entities;

class Users
{

	private $id;
	private $pseudo;
	private $mail;
	private $password;
	private $activation_key;
	private $verified = 0;
	private $id_role = 1;
	private $inscr_date;


// CONSTRUCTOR & HYDRATATION

	use blog\traits\hydrate; 

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

	public function getVerfified()
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
		if(is_int($activationKey))
		{
			$this->activation_key = $activationKey;
		}
	}


	public function setVerified($verified)
	{
		if(is_int($verified) && (($verified == 0) || ($verified == 1)))
		{
			$this->verified = $verified;
		}
	}

	public function setId_role($idRole)
	{
		if(is_int($idRole) && (($idRole == 1) || ($idRole == 2)))
		{
			$this->id_role = $idRole;
		}
	}






}









