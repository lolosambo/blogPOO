<?php
namespace p5\controllers\backend;

use P5\core\factories\ControllerFactory;

class AllUnvalidCommentsController
{
	const COMMENTS_PER_PAGE = 4;

	private $factory;
	private $commentman;
	private $twig;
	private $firstEntry;
	private $commentsNbr;
	private $pagesNbr;
	private $currentPage;
	private $request;
	
	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->commentman = $this->factory->getTable()->table('Comments');
		$this->request = $this->factory->getRequest();
		$this->twig = $this->factory->getTwig();
	}


	public function __invoke()
	{
		
		$this->pagination();
		
		// Show all non-validated comments from the database
		$comments = $this->commentman->getUnvalidComments($this->firstEntry, self::COMMENTS_PER_PAGE);

		// Render Twig
		echo $this->twig->render('/views/backend/comments.twig', 
			[
				'comments' => $comments,	
				'pagesNbr' => $this->pagesNbr,	
				'currentPage' => $this->currentPage,
			
			]
			);		
	}

	private function pagination()
	{	
		$url = $this->request->server->get('REQUEST_URI');

		// URL' Id recuperation
		preg_match('#([0-9]+)$#', $url, $page);

		//Pagination
		$this->commentsNbr = $this->commentman->getTotalComments();
		$this->pagesNbr = ceil($this->commentsNbr/self::COMMENTS_PER_PAGE);

		if(isset($page[1])) { 
    		$this->currentPage=intval($page[1]);
 				if($this->currentPage > $this->pagesNbr) {
        		  	$this->currentPage = $this->pagesNbr;
    			} elseif($this->currentPage < 1) {
        		  	$this->currentPage = 1;
    			}		
		} else {
     		$this->currentPage = 1;   
		}

		$this->firstEntry = ($this->currentPage-1) * self::COMMENTS_PER_PAGE;
	}
}

