<?php

namespace P5\entities;

class Networks

{

	private $id;
	private $network_name;
	private $address; 


// GETTERS ------------------------------

	public function getId()
	{
		return $this->id;
	}

	public function getNetwork_name()
	{
		return $this->network_name;
	}

	public function getAddress()
	{	
		return $this->address;
	}


// SETTERS -------------------------------

	public function setNetwork_name($name)
	{
		if(is_string($name))
		{
			$this->network_name = $name;
		}
	}

	public function setAddress($address)
	{
		if(is_string($address))
		{
			$this->address = $address;
		}
	}






}