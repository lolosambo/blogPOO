<?php 

require('../../model/backend/admin_model.php');


// DASCHBOARD SECTION -------------------------------------------

function showDaschboard()
{
	$users = get5LastUsers();

	$posts = get3LastPosts();

	$comments1 = get3LastValidComments();

	$comments0 = get3LastUnvalidComments();

	require('../../views/backend/daschboard.php');

}

// USERS SECTION--------------------------------------------------

function searchUserForm($pseudo)
{
	$data = searchUser($pseudo);
	$_SESSION['foundUser'] = $data['pseudo'];

	require('../../views/backend/searchUserForm.php');
}

function changeToAdmin($pseudo)
{
	updateToAdmin($pseudo);
	require('../../views/backend/updatedUsers.php');

}

function changeToUser($pseudo)
{
	updateToUser($pseudo);
	require('../../views/backend/updatedUsers.php');

}

function deleteUser($pseudo)
{

	eraseUser($pseudo);
	require('../../views/backend/updatedUsers.php');
}




// POSTS SECTION--------------------------------------------------

function showPosts()
{
	$data = getAllPosts();
	require('../../views/backend/posts.php');
}


function selectPost($postId)
{
	$data = getPost($postId);

	require('../../views/backend/update_post.php');

}

function addPostForm()
{
	require('../../views/backend/add_post_form.php');
}

function verifyImg()
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

function img_message()
{
	require('../../views/backend/err_post.php');
}



function addPost($user_id, $title, $heading, $post_content, $img)
{

	writePost($user_id, $title, $heading, $post_content, $img);
	require('../../views/backend/add_post.php');
}





function updatePost($postId, $title, $heading, $content)
{

	modifyPost($postId, $title, $heading, $content);
	require('../../views/backend/updated_post.php');

}



function deletePost($postId)
{
	erasePost($postId);
	require('../../views/backend/delete_post.php');
}


function postsPagination()
{

	$total = getTotalPosts();
	$postsNbr = $total['total'];

	$postsPerPage = 5; // Change the number of posts in the Admin list posts section

	$pagesNbr = ceil($postsNbr/$postsPerPage);


		if(isset($_GET['page'])) 
    	{ 
    		$currentPage=intval($_GET['page']);
 
     			if($currentPage>$pagesNbr)
     			{
        		  	$currentPage=$pagesNbr;
    			}
		}
		else
		{
     		$currentPage=1;   
		}

	$firstEntry = ($currentPage-1) * $postsPerPage;

	$posts = getAllPosts($firstEntry, $postsPerPage);

	require('../../views/backend/posts.php');	

}


// COMMENTS SECTION--------------------------------------------------

function commentsPagination()
{

	$total = getTotalComments();
	$commentsNbr = $total['total'];

	$commentsPerPage = 5; // Change the number of posts in the Admin list posts section

	$pagesNbr = ceil($commentsNbr/$commentsPerPage);


		if(isset($_GET['cpage'])) 
    	{ 
    		$currentPage=intval($_GET['cpage']);
 
     			if($currentPage>$pagesNbr)
     			{
        		  	$currentPage=$pagesNbr;
    			}
		}
		else
		{
     		$currentPage=1;   
		}

	$firstEntry = ($currentPage-1) * $commentsPerPage;

	$res = getUnvalidComments($firstEntry, $commentsPerPage);

	require('../../views/backend/comments.php');	

}


function validComment($commentId)
{
	
	publishComment($commentId);
	require('../../views/backend/published_comment.php');	

}

function refuseComment($commentId)
{
	
	deleteComment($commentId);
	require('../../views/backend/refused_comment.php');	

}


// CV SECTION--------------------------------------------------

function showCv()
{
	require('../../views/backend/cv.php');
}


// SOCIAL NETWORKS SECTION--------------------------------------------------

function showNetwork()
{
	$res = networkList();

	require('../../views/backend/networks.php');
}

function addNetwork()
{
	require('../../views/backend/add_network_form.php');
}

function addedNetwork($name, $address)
{
	createNetwork($name, $address);
	require('../../views/backend/added_network.php');
}

function updateNetwork($networkId, $networkAdress)
{
	changeNetwork($networkId, $networkAdress);

	require('../../views/backend/update_network.php');
}

function deleteNetwork($networkId)
{
	eraseNetwork($networkId);

	require('../../views/backend/delete_network.php');
}












