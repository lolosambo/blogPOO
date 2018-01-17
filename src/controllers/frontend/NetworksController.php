<?php
namespace p5\controllers\frontend;
use p5\builders\Builder;

class NetworksController
{
	
	public function showNetworks(Builder $builder)
	{
		$res = $builder->createManager('networks')->build()->networkList();

		require('../../views/backend/networks.php');
	}

	public function addNetwork()
	{
		require('../../views/backend/add_network_form.php');
	}

	public function addedNetwork(Builder $builder, $name, $address)
	{
		$builder->createManager('networks')->build()->createNetwork($name, $address);
		require('../../views/backend/added_network.php');
	}

	public function updateNetwork(Builder $builder, $networkId, $networkAdress)
	{
		$builder->createManager('networks')->build()->changeNetwork($networkId, $networkAdress);

		require('../../views/backend/update_network.php');
	}

	public function deleteNetwork(Builder $builder, $networkId)
	{
		$builder->createManager('networks')->build()->eraseNetwork($networkId);

		require('../../views/backend/delete_network.php');
	}


}