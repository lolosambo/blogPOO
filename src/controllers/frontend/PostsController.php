<?php

namespace p5\controllers\frontend;
use p5\builders\Builder;


class PostsController
{


	public function allPosts(Builder $builder)
	{
		$postman = $builder->createManager('posts')->build();
		$pagincont = $builder->createFrontController('pagination')->build();
		$pagincont->postsPagination($builder);
		$res = $postman->getPosts($pagincont->getFirstEntry(), PaginationController::POST_PER_PAGE);

		require('../views/frontend/list_posts_view.php');

	}

	public function onePost(Builder $builder, $postId)
	{
		
		$res = $builder->createManager('posts')->build()->getPost($postId);
		$commentman = $builder->createManager('comments')->build();
		$post = $builder->createEntities('posts', $res)->build();
		$author = $builder->createEntities('users', $res)->build();
		$res2 = $builder->createFrontController('comments')->build()->allComments($builder, $_GET['postId']);
		require('../views/frontend/post_view.php');

	}




	


}