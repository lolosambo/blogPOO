<?php
namespace p5\pagination\controllers;
use p5\core\controllers\MainController;



class CommentsPaginationController extends MainController
{

	const POST_PER_PAGE = 4;
	const COMMENTS_PER_PAGE = 5;

	private $firstEntry;
	private $postsNbr;
	private $pagesNbr;
	private $currentPage;
	private $commentsFirstEntry;
	private $commentsNbr;
	private $commentsPagesNbr;
	private $commentsCurrentPage;


	protected $commentman;
	

	public function __construct()
	{
		$manager = parent::getTable('Comments');
		$this->commentman = $manager;
		return $this->commentman;
	}

	

	public function getCommentsFirstEntry()
	{
		return $this->commentsFirstEntry;

	}

	

	public function getCommentsNbr()
	{	
		return $this->commentsNbr;

	}


	public function getCommentsPagesNbr()
	{
		return $this->commentsPagesNbr;

	}


	public function getCommentsCurrentPage()
	{
		return $this->commentsCurrentPage;

	}

	
	public function setCommentsFirstEntry($CommentsFirstEntry)
	{
		if(intval($commentsFirstEntry))
		{
			$this->commentsFirstEntry = $commentsFirstEntry;
		}
	}


	public function setCommentsNbr($commentsNbr)
	{
		if(intval($commentsNbr))
		{
			$this->commentsNbr = $commentsNbr;
		}
	}



	public function setCommentPagesNbr($commentsPagesNbr)
	{
		if(intval($commentsPagesNbr))
		{
			$this->commentsPagesNbr = $commentsPagesNbr;
		}
	}



	public function setCommentsCurrentPage($commentsCurrentPage)
	{
		if(intval($commentsCurrentPage))
		{
			$this->commentsCurrentPage = $commentsCurrentPage;
		}
	}




	public function commentsPagination()
	{

		$this->commentsNbr = $this->commentman->getTotalComments();
		
		$this->commentsPagesNbr = ceil($this->commentsNbr/self::COMMENTS_PER_PAGE);


		if(isset($_GET['cpage'])) 
    	{ 
    		$this->commentsCurrentPage=intval($_GET['cpage']);
 
     			if($this->commentsCurrentPage>$this->commentsPagesNbr)
     			{
        		  	$this->commentsCurrentPage=$this->commentsPagesNbr;
    			}
		}
		else
		{
     		$this->commentsCurrentPage=1;   
		}

		$this->commentsFirstEntry = ($this->commentsCurrentPage-1) * self::COMMENTS_PER_PAGE;	


	}



	public function showCommentsPagination()
	{

		for($i=1; $i<=$this->commentsPagesNbr; $i++)
		{
    
     		if($i==$this->commentsCurrentPage)
     		{
       		 	echo ' [ '.$i.' ] '; 
    		}	
    		 else
     		{
       		   	echo ' <a href="index.php?cpage='.$i.'">'.$i.'</a> ';
     		}
		}
		

	}
}