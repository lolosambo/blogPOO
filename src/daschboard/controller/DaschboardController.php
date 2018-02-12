<?php

namespace p5\controllers\backend\daschboard;


class DaschboardController
{

	public function showDaschboard(UsersManager $userman, PostsManager $postman, CommentsManager $commentman)
	{
		$users = $userman->get5LastUsers();

		$posts = $postman->get3LastPosts();

		$comments1 = $commentman->get3LastValidComments();

		$comments0 = $commentman->get3LastUnvalidComments();

		require('../../views/backend/daschboard.php');

	}
}