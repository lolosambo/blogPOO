<?php
namespace p5\controllers\frontend;

use p5\builders\Builder;

class PaginationController
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


	public function getFirstEntry()
	{
		return $this->firstEntry;

	}

		public function getCommentsFirstEntry()
	{
		return $this->commentsFirstEntry;

	}

	public function getPostsNbr()
	{	
		return $this->postsNbr;

	}

	public function getCommentsNbr()
	{	
		return $this->commentsNbr;

	}

	public function getPagesNbr()
	{
		return $this->pagesNbr;

	}

	public function getCommentsPagesNbr()
	{
		return $this->commentsPagesNbr;

	}

	public function getCurrentPage()
	{
		return $this->currentPage;

	}

	public function getCommentsCurrentPage()
	{
		return $this->commentsCurrentPage;

	}

	public function setFirstEntry($firstEntry)
	{
		if(intval($firstEntry))
		{
			$this->firstEntry = $firstEntry;
		}
	}

	public function setCommentsFirstEntry($CommentsFirstEntry)
	{
		if(intval($commentsFirstEntry))
		{
			$this->commentsFirstEntry = $commentsFirstEntry;
		}
	}

	public function setPostsNbr($postsNbr)
	{
		if(intval($postsNbr))
		{
			$this->postsNbr = $postsNbr;
		}
	}

	public function setCommentsNbr($commentsNbr)
	{
		if(intval($commentsNbr))
		{
			$this->commentsNbr = $commentsNbr;
		}
	}

	public function setPagesNbr($pagesNbr)
	{
		if(intval($pagesNbr))
		{
			$this->pagesNbr = $pagesNbr;
		}
	}

	public function setCommentPagesNbr($commentsPagesNbr)
	{
		if(intval($commentsPagesNbr))
		{
			$this->commentsPagesNbr = $commentsPagesNbr;
		}
	}

	public function setCurrentPage($currentPage)
	{
		if(intval($currentPage))
		{
			$this->currentPage = $currentPage;
		}
	}

	public function setCommentsCurrentPage($commentsCurrentPage)
	{
		if(intval($commentsCurrentPage))
		{
			$this->commentsCurrentPage = $commentsCurrentPage;
		}
	}


	public function postsPagination(Builder $builder)
	{

		$this->postsNbr = $builder->createManager('posts')->build()->countPosts();

		$this->pagesNbr = ceil($this->postsNbr/self::POST_PER_PAGE);

		if(isset($_GET['page'])) 
    	{ 
    		$this->currentPage=intval($_GET['page']);
 
     			if($this->currentPage > $this->pagesNbr)
     			{
        		  	$this->currentPage = $this->pagesNbr;
    			}
		}
		else
		{
     		$this->currentPage = 1;   
		}

		$this->firstEntry = ($this->currentPage-1) * self::POST_PER_PAGE;	

	}


	public function commentsPagination(Builder $builder)
	{

		$this->commentsNbr = $builder->createManager('comments')->build()->getTotalComments();
		
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

	public function showPagination()
	{

		for($i=1; $i<=$this->pagesNbr; $i++)
		{
    
     		if($i==$this->currentPage)
     		{
       		 	echo ' [ '.$i.' ] '; 
    		}	
    		 else
     		{
       		   	echo ' <a href="index.php?page='.$i.'">'.$i.'</a> ';
     		}
		}
		

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