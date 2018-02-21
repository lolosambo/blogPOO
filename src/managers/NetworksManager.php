<?php
namespace P5\managers;

use P5\core\factories\DbFactory;
use P5\managers\MainManager;
use \PDO;


class NetworksManager extends MainManager {

	protected $db;

	public function __construct() {
        $this->db = $this->getDb();
        parent::__construct();

	}

	public function networkList() {
		$req = $this->getDb()->getPdo()->query('SELECT * FROM Networks ORDER BY id');
		$res = $req->fetchAll();
		return $res;
	}

	public function createNetwork($name, $address, $img) {
	    $name = $this->validator->validateSQL($name);
        $address = $this->validator->validateSQL($address);
        $nameVal = $this->validator->validateJavascript($name);
        $addressVal = $this->validator->validateJavascript($address);

		$req = $this->db->getPdo()->prepare
		('
		
			INSERT INTO Networks (networkName, address, imgUrl) VALUES (:nameVal, :address, :img)
		
		');
		$req->bindParam(':address', $addressVal);
		$req->bindParam(':nameVal', $nameVal);
		$req->bindParam(':img', $img);
		$req->execute();
		return $req;

	}

	public function changeNetwork($networkId, $networkAddress) {

        $networkId = $this->validator->validateSQL($networkId);
        $networkAddress = $this->validator->validateSQL($networkAddress);
        $networkIdVal = $this->validator->validateJavascript($networkId);
        $networkAddressVal = $this->validator->validateJavascript($networkAddress);
		
		$req = $this->getDb()->getPdo()->prepare('UPDATE Networks SET address = :value WHERE id = :param');
		$req->bindParam(':value', $networkAddressVal);
		$req->bindParam(':param', $networkIdVal);
		$req->execute();
		return $req;
	}

	public function eraseNetwork($networkId) {
        $networkId = $this->validator->validateSQL($networkId);
        $networkIdVal = $this->validator->validateJavascript($networkId);

		$req = $this->getDb()->getPdo()->prepare('DELETE FROM Networks WHERE id = :param');
		$req->bindParam(':param', $networkIdVal);
		$req->execute();
	}
}

