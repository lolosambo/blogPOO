<?php

namespace blog\entities;


class Roles
{

	private $id;
	private $role;


// GETTERS -------------------

	public function getId()
	{
		return $this->id;
	}

	public function getRole()
	{
		return $this->role;
	}


// SETTERS ---------------------

	public function setRole($role)
	{
		if(is_string($role) && (($role =='Membre') || ($role == 'Administrateur')))
		{
			$this->role = $role;
		}
	}


}