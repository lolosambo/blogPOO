<?php
namespace p5\controllers\backend;
use p5\controllers\frontend\PaginationController;
use p5\controllers\backend\ImagesController;
use p5\managers\PostsManager;
use p5\entities\Posts;
use p5\app\Session;


class AdminPostsController
{

	public function showPosts(PostsManager $postman, PaginationController $pagincont)
	{
		$pagincont->postsPagination($postman);
		$res = $postman->getPosts($pagincont->getFirstEntry(), PaginationController::POST_PER_PAGE);
		
		
		require('../../views/backend/posts.php');
	}


	public function selectPost(PostsManager $postman, $postId)
	{
		$res = $postman->getPost($postId);
		$post = new Posts($res);

		require('../../views/backend/update_post.php');

	}

	public function addPostForm()
	{	
		require('../../views/backend/add_post_form.php');
	}


	public function addPost(PostsManager $postman, $user_id, $title, $heading, $post_content, $img)
	{

		$postman->writePost($user_id, $title, $heading, $post_content, $img);
		require('../../views/backend/add_post.php');
	}

	public function updatePost(PostsManager $postman, $postId, $title, $heading, $content)
	{

		$postman->modifyPost($postId, $title, $heading, $content);
		require('../../views/backend/updated_post.php');

	}

	public function deletePost(PostsManager $postman, $postId)
	{
		$postman->erasePost($postId);
		require('../../views/backend/delete_post.php');
	}







}