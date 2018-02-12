<?php

namespace P5\managers;
use P5\core\factories\DbFactory;
use P5\managers\MainManager;
use \PDO;


class NetworksManager extends MainManager
{

	protected $db;

	public function __construct()
	{
		$this->getDb(); 
  	 	return $this->db;
	}



	public function networkList()
	{
		return $this->getAllBy('Networks', 'id');
	}


	public function createNetwork($name, $address, $img)
	{
		$req = $this->db->getPdo()->prepare
		('
		
			INSERT INTO Networks (network_name, address, img_url) VALUES (:name, :address, :img)
		
		');
		$req->bindParam(':address', $address);
		$req->bindParam(':name', $name);
		$req->bindParam(':img', $img);
		$req->execute();
		return $req;

	}

	public function changeNetwork($networkId, $networkAddress)
	{
		return $this->update('Networks', 'address', $networkAddress, 'id', $networkId);
	}

	public function eraseNetwork($networkId)
	{
		return $this->erase('Networks', 'id', $networkId);
	}

}

 