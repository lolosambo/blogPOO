<?php
namespace P5\controllers\frontend;
use P5\core\factories\ControllerFactory;

class PostsPaginationController
{

	const POST_PER_PAGE = 4;

	private $factory;
	private $session;
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
		$this->postman = $factory->getTable()->Table('posts');
		$this->twig = $factory->getTwig();
		$this->session = $factory->getSession();
		$this->request = $factory->getRequest();
	}


	public function __invoke()
	{
		// Instance of HttpFoundation for $_SERVER[] values from the URL
		$url = $this->request->server->get('REQUEST_URI');

		// URL' Id recuperation
		preg_match('#([0-9]+)$#', $url, $match);

		//Pagination
		$this->postsNbr = $this->postman->countAllPosts();


		$this->pagesNbr = ceil($this->postsNbr/self::POST_PER_PAGE);


		if(isset($match[1]))
    	{ 
    		$this->currentPage=intval($match[1]);

 
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

		// show sidebar
		$connection = $this->factory->getFrontController('loginController');

		$social = $this->factory->getFrontController('SocialNetworksController');

		$role = $this->session->get('id_role');

		// Render Twig
		echo $this->twig->render('views/frontend/list_posts_view.twig', 
			[
				'post' => $post,
				'sidebarContent' => $connection,
				'network' => $social,
				'pagesNbr' => $this->pagesNbr,	
				'currentPage' => $this->currentPage,
				'role' => $role,
			]
			);
		
	}


}

