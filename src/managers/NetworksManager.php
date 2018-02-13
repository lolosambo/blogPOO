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
		$req = $this->getDb()->getPdo()->query('SELECT * FROM Networks ORDER BY id');
		$res = $req->fetchAll();
		return $res;
	}


	public function createNetwork($name, $address, $img)
	{
		$req = $this->db->getPdo()->prepare
		('
		
			INSERT INTO Networks (networkName, address, imgUrl) VALUES (:name, :address, :img)
		
		');
		$req->bindParam(':address', $address);
		$req->bindParam(':name', $name);
		$req->bindParam(':img', $img);
		$req->execute();
		return $req;

	}

	public function changeNetwork($networkId, $networkAddress)
	{
		
		$req = $this->getDb()->getPdo()->prepare('UPDATE Networks SET address = :value WHERE id = :param');
		$req->bindParam(':value', $networkAddress);
		$req->bindParam(':param', $networkId);
		$req->execute();
		return $req;
	}

	public function eraseNetwork($networkId)
	{
		return $this->erase('Networks', 'id', $networkId);
		$req = $this->getDb()->getPdo()->prepare('DELETE FROM Networks WHERE id = :param');
		$req->bindParam(':param', $param);
		$req->execute();
	}

}
