<?php
	
namespace p5\controllers\backend;
use p5\builders\Builder;


class AdminDaschboardController
{

	public function showDaschboard(Builder $builder)
	{
		$users = $builder->createManager('users')->build()->get5LastUsers();

		$posts = $builder->createManager('posts')->build()->get3LastPosts();

		$comments1 = $builder->createManager('comments')->build()->get3LastValidComments();

		$comments0 = $builder->createManager('comments')->build()->get3LastUnvalidComments();

		require('../../views/backend/daschboard.php');

	}
	
}