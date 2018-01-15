<?php
namespace p5\controllers\frontend;
use p5\managers\NetworksManager;

class NetworksController
{
	
	public function showNetworks(NetworksManager $networkman)
	{
		$res = $networkman->networkList();

		require('../../views/backend/networks.php');
	}

	public function addNetwork()
	{
		require('../../views/backend/add_network_form.php');
	}

	public function addedNetwork(NetworksManager $networkman, $name, $address)
	{
		$networkman->createNetwork($name, $address);
		require('../../views/backend/added_network.php');
	}

	public function updateNetwork(NetworksManager $networkman, $networkId, $networkAdress)
	{
		$networkman->changeNetwork($networkId, $networkAdress);

		require('../../views/backend/update_network.php');
	}

	public function deleteNetwork(NetworksManager $networkman, $networkId)
	{
		$networkman->eraseNetwork($networkId);

		require('../../views/backend/delete_network.php');
	}


}