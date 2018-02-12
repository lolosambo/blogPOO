<?php
namespace P5\controllers\backend;
use P5\core\factories\ControllerFactory;

class ShowPostsController
{
	const POST_PER_PAGE = 4;

	private $factory;
	private $postman;
	private $twig;
	private $firstEntry;
	private $postsNbr;
	private $pagesNbr;
	private $currentPage;
	private $request;
	
	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->postman = $this->factory->getTable()->table('Posts');
		$this->request = $this->factory->getRequest();
		$this->twig = $this->factory->getTwig();
		$this->builder = $this->factory->getBuilder();
		$this->request = $this->factory->getRequest();
	}


	public function __invoke()
	{

		$url = $this->request->server->get('REQUEST_URI');

		// URL' Id recuperation
		preg_match('#([0-9]+)$#', $url, $page);

		//Pagination
		$this->postsNbr = $this->postman->countAllPosts();

		$this->pagesNbr = ceil($this->postsNbr/self::POST_PER_PAGE);


		if(isset($page[1]))
    	{ 
    		$this->currentPage=intval($page[1]);

 
     			if($this->currentPage > $this->pagesNbr)
     			{
        		  	$this->currentPage = $this->pagesNbr;
    			}
    			else if($this->currentPage < 1)
     			{
        		  	$this->currentPage = 1;
    			}
		}
		else
		{
     		$this->currentPage = 1;   
		}

		$this->firstEntry = ($this->currentPage-1) * self::POST_PER_PAGE;

		// Show all posts from the database
		$post = $this->postman->allPosts($this->firstEntry, self::POST_PER_PAGE);

		// Render Twig
		echo $this->twig->render('views/backend/posts.twig', 
			[
				'post' => $post,
					
				'pagesNbr' => $this->pagesNbr,	
				'currentPage' => $this->currentPage,
			
			]
			);
		
	}


	

}