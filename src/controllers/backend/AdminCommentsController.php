<?php
namespace p5\controllers\backend;
use p5\managers\CommentsManager;
use p5\entities\Comments;
use p5\app\Session;

class AdminCommentsController
{

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

}