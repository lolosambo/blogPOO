<?php
namespace p5\controllers\backend;
use p5\builders\Builder;


class AdminUsersController
{
	
	// DASCHBOARD SECTION -------------------------------------------

	public function showDaschboard(Builder $builder)
	{
		$users = $builder->createManager('users')->build()->get5LastUsers();

		$posts = $builder->createManager('posts')->build()->get3LastPosts();

		$comments1 = $builder->createManager('comments')->build()->get3LastValidComments();

		$comments0 = $builder->createManager('comments')->build()->get3LastUnvalidComments();

		require('../../views/backend/daschboard.php');

	}

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