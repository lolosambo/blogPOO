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

		// show sidebar
		$sidebar = $this->factory->getFrontController('loginController');

		$networks = $this->factory->getFrontController('SocialNetworksController');

		$id_role = $this->session->get('id_role');

		// Render Twig
		echo $this->twig->render('views/frontend/list_posts_view.twig', 
			[
				'post' => $post,
				'sidebarContent' => $sidebar,
				'network' => $networks,
				'pagesNbr' => $this->pagesNbr,	
				'currentPage' => $this->currentPage,
				'role' => $id_role,
			]
			);
		
	}


}

