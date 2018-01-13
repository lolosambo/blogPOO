<?php
namespace p5\controllers\backend;
use p5\managers\UsersManager;
use p5\managers\PostsManager;
use p5\managers\CommentsManager;
use p5\entities\Users;
use p5\app\Session;


class AdminUsersController
{
	
	// DASCHBOARD SECTION -------------------------------------------

	public function showDaschboard(UsersManager $userman, PostsManager $postman, CommentsManager $commentman)
	{
		$users = $userman->get5LastUsers();

		$posts = $postman->get3LastPosts();

		$comments1 = $commentman->get3LastValidComments();

		$comments0 = $commentman->get3LastUnvalidComments();

		require('../../views/backend/daschboard.php');

	}

	// USERS SECTION--------------------------------------------------

	public function searchUserForm($pseudo)
	{
		$data = searchUser($pseudo);
		$_SESSION['foundUser'] = $data['pseudo'];

		require('../../views/backend/searchUserForm.php');
	}

	public function changeToAdmin($pseudo)
	{
		updateToAdmin($pseudo);
		require('../../views/backend/updatedUsers.php');

	}

	public function changeToUser($pseudo)
	{
		updateToUser($pseudo);
		require('../../views/backend/updatedUsers.php');

	}

	public function deleteUser($pseudo)
	{

		eraseUser($pseudo);
		require('../../views/backend/updatedUsers.php');
	}

	


}