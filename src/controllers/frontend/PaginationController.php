<?php
namespace p5\controllers\frontend;
use p5\managers\PostsManager;


class PaginationController
{

const POST_PER_PAGE = 4;

private $firstEntry;
private $postsNbr;
private $pagesNbr;
private $currentPage;


public function getFirstEntry()
{
	return $this->firstEntry;

}

public function getPostsNbr()
{
	return $this->postsNbr;

}

public function getPagesNbr()
{
	return $this->pagesNbr;

}

public function getCurrentPage()
{
	return $this->currentPage;

}

public function setFirstEntry($firstEntry)
{
	if(intval($firstEntry))
	{
		$this->firstEntry = $firstEntry;
	}
}

public function setPostsNbr($postsNbr)
{
	if(intval($postsNbr))
	{
		$this->postsNbr = $postsNbr;
	}
}

public function setPagesNbr($pagesNbr)
{
	if(intval($pagesNbr))
	{
		$this->pagesNbr = $pagesNbr;
	}
}

public function setCurrentPage($currentPage)
{
	if(intval($currentPage))
	{
		$this->currentPage = $currentPage;
	}
}


public function postsPagination(PostsManager $postman)
	{

		$this->postsNbr = $postman->countPosts();

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
}