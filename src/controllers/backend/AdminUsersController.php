<?php
namespace p5\controllers\backend;
use p5\builders\Builder;


class AdminUsersController
{
	
	

	// USERS SECTION--------------------------------------------------

	public function searchUserForm(Builder $builder, $pseudo)
	{
		$data = $builder->createManager('users')->build()->searchUser($pseudo);
		
		if($data != FALSE)
		{
			$user = $builder->createEntities('users', $data)->build();
			$session = $builder->createApp('session')->build()->setSession('foundUser', $user->getPseudo());
		}
		else
		{
			$user = null;
		}

		require('../../views/backend/searchUserForm.php');
	}

	public function changeToAdmin(Builder $builder, $pseudo)
	{
		$builder->createManager('users')->build()->updateToAdmin($pseudo);
		require('../../views/backend/updatedUsers.php');

	}

	public function changeToUser(Builder $builder, $pseudo)
	{
		$builder->createManager('users')->build()->updateToUser($pseudo);
		require('../../views/backend/updatedUsers.php');

	}

	public function deleteUser(Builder $builder, $pseudo)
	{

		$builder->createManager('users')->build()->eraseUser($pseudo);
		require('../../views/backend/updatedUsers.php');
	}


}