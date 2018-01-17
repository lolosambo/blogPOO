<?php
namespace p5\controllers\backend;

use p5\builders\Builder;
use p5\controllers\frontend\PaginationController;


class AdminPostsController
{

	public function showPosts(Builder $builder)
	{
		$postman = $builder->createManager('posts')->build();
		$pagincont = $builder->createFrontController('pagination')->build();
		$pagincont->postsPagination($builder);
		$res = $postman->getPosts($pagincont->getFirstEntry(), PaginationController::POST_PER_PAGE);
		
		
		require('../../views/backend/posts.php');
	}


	public function selectPost(Builder $builder, $postId)
	{
		$res = $builder->createManager('posts')->build()->getPost($postId);
		$post = $builder->createEntities('posts', $res)->build();

		require('../../views/backend/update_post.php');

	}

	public function addPostForm()
	{	
		require('../../views/backend/add_post_form.php');
	}


	public function addPost(Builder $builder, $user_id, $title, $heading, $post_content, $img)
	{

		$builder->createManager('posts')->build()->writePost($user_id, $title, $heading, $post_content, $img);
		require('../../views/backend/add_post.php');
	}

	public function updatePost(Builder $builder, $postId, $title, $heading, $content)
	{

		$builder->createManager('posts')->build()->modifyPost($postId, $title, $heading, $content);
		require('../../views/backend/updated_post.php');

	}

	public function deletePost(Builder $builder, $postId)
	{
		$builder->createManager('posts')->build()->erasePost($postId);
		require('../../views/backend/delete_post.php');
	}







}