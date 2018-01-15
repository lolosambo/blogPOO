<?php
namespace p5\managers;
use p5\database\DbFactory;
use \PDO;



class NetworksManager
{

	private $db;

	public function __construct()
	{
  	 	$this->db = new DbFactory();
	}


	public function networkList()
	{

		$req = $this->db->getPdo()->query('SELECT * FROM Networks');
		return $req;
	}


	public function createNetwork($name, $address)
	{
		$req = $this->db->getPdo()->prepare
		('
		
			INSERT INTO Networks (network_name, address) VALUES (:name, :address)
		
		');
		$req->bindParam(':address', $address);
		$req->bindParam(':name', $name);
		$req->execute();
		return $req;

	}

	public function changeNetwork($networkId, $networkAddress)
	{
		$req = $this->db->getPdo()->prepare
		('
		
			UPDATE Networks SET address = :address WHERE id = :id
	
		');
		$req->bindParam(':address', $networkAddress);
		$req->bindParam(':id', $networkId);
		$req->execute();
		return $req;

	}

	public function eraseNetwork($networkId)
	{

		$req = $this->db->getPdo()->prepare
		('
		
			DELETE FROM Networks WHERE id = :id
	
		');
		$req->bindParam(':id', $networkId);
		$req->execute();
		return $req;
	}

}