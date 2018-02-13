<?php

namespace P5\entities;

class Networks

{

	private $id;
	private $networkName;
	private $address; 


// GETTERS ------------------------------

	public function getId()
	{
		return $this->id;
	}

	public function getNetworkName()
	{
		return $this->networkName;
	}

	public function getAddress()
	{	
		return $this->address;
	}


// SETTERS -------------------------------

	public function setNetworkName($name)
	{
		if(is_string($name))
		{
			$this->networkName = $name;
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

