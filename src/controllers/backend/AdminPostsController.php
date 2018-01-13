<?php
namespace p5\controllers\backend;
use p5\managers\PostsManager;
use p5\entities\Posts;
use p5\app\Session;


class AdminPostsController
{

	public function showPosts()
	{
		$data = getAllPosts();
		require('../../views/backend/posts.php');
	}


	public function selectPost($postId)
	{
		$data = getPost($postId);

		require('../../views/backend/update_post.php');

	}

	public function addPostForm()
	{	
		require('../../views/backend/add_post_form.php');
	}

	public function verifyImg()
	{

		//Limit file size and location
		$folder = '../uploads/';
		$file = basename($_FILES['img']['name']);
		$size_max = 5000000;
		$size = filesize($_FILES['img']['tmp_name']);

		//Authorized file extensions in an array
		$extensions = array('.png', '.gif', '.jpg', '.jpeg');

		//Extension extraction from the file name
		$img_extension = strrchr($_FILES['img']['name'], '.'); 

		//Check the uploaded file's extension
		if(!in_array($img_extension, $extensions))
		{
   		 	$error = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg.';
		}

		if($size>$size_max)
		{
   		  	$error = 'Le fichier est trop gros...';
		}

		//If there's no error, begin upload
		if(!isset($error)) 
		{

    		//Formating file's name
     		$file = strtr($file, 
      	    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
      	    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    		$file = preg_replace('/([^.a-z0-9]+)/i', '-', $file);

    	
    		//Move uploaded file to the final destination folder
    		if(move_uploaded_file($_FILES['img']['tmp_name'], $folder. $file))
     		{    	
      		    $site_url = "http://www.b-log-lille.fr/p5/public/uploads/";
      		   	$img_url = $site_url.$file;   
     		}

     		return $img_url;

		}

	}

	public function img_message()
	{
		require('../../views/backend/err_post.php');
	}



	public function addPost($user_id, $title, $heading, $post_content, $img)
	{

		writePost($user_id, $title, $heading, $post_content, $img);
		require('../../views/backend/add_post.php');
	}





	public function updatePost($postId, $title, $heading, $content)
	{

		modifyPost($postId, $title, $heading, $content);
		require('../../views/backend/updated_post.php');

	}



	public function deletePost($postId)
	{
		erasePost($postId);
		require('../../views/backend/delete_post.php');
	}

}