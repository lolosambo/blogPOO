<?php

namespace p5\controllers\frontend;
use p5\managers\PostsManager;
use p5\managers\CommentsManager;
use p5\entities\Posts;
use p5\entities\Users;
use p5\controllers\frontend\PaginationController;
use p5\controllers\frontend\CommentsController;



class PostsController
{


	public function allPosts(PostsManager $postman, PaginationController $pagincont)
	{
		
		$pagincont->postsPagination($postman);
		$res = $postman->getPosts($pagincont->getFirstEntry(), PaginationController::POST_PER_PAGE);

		require('../views/frontend/list_posts_view.php');

	}

	public function onePost(PostsManager $postman, CommentsController $commentcont, CommentsManager $commentman, $postId)
	{
		
		$res = $postman->getPost($postId);
		$post = new Posts($res);
		$author = new Users($res);
		$res2 = $commentcont->allComments($commentman, $_GET['postId']);
		require('../views/frontend/post_view.php');

	}




	


}